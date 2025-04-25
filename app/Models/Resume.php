<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'resumes';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'full_name',
        'title',
        'email',
        'phone',
        'location',
        'website',
        'about_me',
        'photo_path',
        'social_links',
        'skills',
        'languages',
        'is_active'
    ];

    protected $casts = [
        'social_links' => 'array',
        'skills' => 'array',
        'languages' => 'array',
        'is_active' => 'boolean',
    ];

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class)->orderBy('order');
    }

    public function education()
    {
        return $this->hasMany(Education::class)->orderBy('order');
    }

    public function projects()
    {
        return $this->hasMany(Project::class)->orderBy('order');
    }
}
