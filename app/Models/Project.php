<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'resume_id',
        'name',
        'description',
        'url',
        'technologies',
        'order'
    ];

    protected $casts = [
        'technologies' => 'array',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
