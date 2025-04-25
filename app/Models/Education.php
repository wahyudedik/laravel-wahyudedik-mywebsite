<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    protected $table = 'education';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false; 
    protected $fillable = [
        'resume_id',
        'degree',
        'institution',
        'start_date',
        'end_date',
        'description',
        'order'
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
