<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'work_experiences';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'resume_id',
        'position',
        'company',
        'start_date',
        'end_date',
        'current_job',
        'description',
        'responsibilities',
        'order'
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'current_job' => 'boolean',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
