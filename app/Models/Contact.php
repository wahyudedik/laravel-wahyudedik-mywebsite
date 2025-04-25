<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use \Illuminate\Database\Eloquent\Concerns\HasUuids;
    
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'newsletter',
        'is_read',
    ];

    protected $casts = [
        'newsletter' => 'boolean',
        'is_read' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
