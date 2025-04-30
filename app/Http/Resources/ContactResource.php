<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'purpose' => $this->purpose,
            'purpose_label' => $this->getPurposeLabel(),
            'message' => $this->message,
            'attachments' => ContactAttachmentResource::collection($this->whenLoaded('attachments')),
            'categories' => ContactCategoryResource::collection($this->whenLoaded('categories')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}