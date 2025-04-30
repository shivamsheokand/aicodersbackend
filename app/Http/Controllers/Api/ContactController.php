<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // Apply filters
        if ($request->has('purpose')) {
            $query->where('purpose', $request->purpose);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $sortField = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $contacts = $query->sortByField($sortField, $sortDirection)
                         ->paginate($request->input('per_page', 10));

        return ContactResource::collection($contacts);
    }

    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->validated());
        return new ContactResource($contact);
    }

    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(null, 204);
    }

    public function purposeOptions()
    {
        return response()->json(Contact::getPurposeOptions());
    }

    public function stats()
    {
        $stats = [
            'total' => Contact::count(),
            'by_purpose' => Contact::select('purpose')
                ->selectRaw('count(*) as count')
                ->groupBy('purpose')
                ->pluck('count', 'purpose')
                ->map(function($count, $purpose) {
                    return [
                        'count' => $count,
                        'label' => Contact::PURPOSE_OPTIONS[$purpose] ?? $purpose
                    ];
                }),
            'recent' => Contact::latest()
                ->take(5)
                ->get()
                ->map(function($contact) {
                    return [
                        'id' => $contact->id,
                        'name' => $contact->name,
                        'created_at' => $contact->created_at
                    ];
                })
        ];

        return response()->json($stats);
    }
}