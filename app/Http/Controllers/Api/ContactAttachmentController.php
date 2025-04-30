<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactAttachment;
use App\Http\Resources\ContactAttachmentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContactAttachmentController extends Controller
{
    public function store(Request $request, Contact $contact)
    {
        $request->validate([
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);

        $file = $request->file('file');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Store the file in the storage/app/public/attachments directory
        $path = $file->storeAs('public/attachments', $filename);

        $attachment = $contact->attachments()->create([
            'filename' => $filename,
            'original_filename' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize()
        ]);

        return new ContactAttachmentResource($attachment);
    }

    public function destroy(Contact $contact, ContactAttachment $attachment)
    {
        if ($attachment->contact_id !== $contact->id) {
            return response()->json(['message' => 'Not found'], 404);
        }

        // Delete the file from storage
        Storage::delete('public/attachments/' . $attachment->filename);
        
        $attachment->delete();

        return response()->json(null, 204);
    }

    public function download(Contact $contact, ContactAttachment $attachment)
    {
        if ($attachment->contact_id !== $contact->id) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $path = storage_path('app/public/attachments/' . $attachment->filename);
        
        return response()->download(
            $path,
            $attachment->original_filename,
            ['Content-Type' => $attachment->mime_type]
        );
    }
}