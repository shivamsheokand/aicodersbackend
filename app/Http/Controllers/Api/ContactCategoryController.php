<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactCategory;
use App\Http\Resources\ContactCategoryResource;
use Illuminate\Http\Request;

class ContactCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactCategory::query();
        
        if ($request->has('with_counts')) {
            $query->withCount('contacts');
        }

        $categories = $query->get();
        return ContactCategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:contact_categories,name',
            'slug' => 'nullable|string|max:255|unique:contact_categories,slug',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string'
        ]);

        $category = ContactCategory::create($validated);
        return new ContactCategoryResource($category);
    }

    public function show(ContactCategory $category)
    {
        $category->loadCount('contacts');
        return new ContactCategoryResource($category);
    }

    public function update(Request $request, ContactCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:contact_categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:contact_categories,slug,' . $category->id,
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string'
        ]);

        $category->update($validated);
        return new ContactCategoryResource($category);
    }

    public function destroy(ContactCategory $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }

    public function attachContact(Request $request, ContactCategory $category)
    {
        $validated = $request->validate([
            'contact_id' => 'required|exists:contacts,id'
        ]);

        $category->contacts()->attach($validated['contact_id']);
        return response()->json(['message' => 'Contact attached successfully']);
    }

    public function detachContact(Request $request, ContactCategory $category)
    {
        $validated = $request->validate([
            'contact_id' => 'required|exists:contacts,id'
        ]);

        $category->contacts()->detach($validated['contact_id']);
        return response()->json(['message' => 'Contact detached successfully']);
    }
}