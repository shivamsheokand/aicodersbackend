<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'filename',
        'original_filename',
        'mime_type',
        'size'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function getUrlAttribute()
    {
        return url('storage/attachments/' . $this->filename);
    }
}