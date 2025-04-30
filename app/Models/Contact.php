<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'purpose',
        'message'
    ];

    public const PURPOSE_OPTIONS = [
        'general' => 'General Inquiry',
        'support' => 'Technical Support',
        'feedback' => 'Feedback',
        'business' => 'Business Opportunity',
        'other' => 'Other'
    ];

    public function getPurposeLabel(): string
    {
        return self::PURPOSE_OPTIONS[$this->purpose] ?? $this->purpose;
    }

    public static function getPurposeOptions(): array
    {
        return self::PURPOSE_OPTIONS;
    }

    public function scopeSortByField($query, $field = 'created_at', $direction = 'desc')
    {
        $allowedFields = ['name', 'email', 'purpose', 'created_at'];
        $field = in_array($field, $allowedFields) ? $field : 'created_at';
        $direction = in_array(strtolower($direction), ['asc', 'desc']) ? $direction : 'desc';
        
        return $query->orderBy($field, $direction);
    }

    public function attachments()
    {
        return $this->hasMany(ContactAttachment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ContactCategory::class);
    }
}
