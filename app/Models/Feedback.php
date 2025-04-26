<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Feedback extends Model
{
    use HasUuids;

    protected $table = 'feedbacks';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'position',
        'content',
        'rating',
        'token',
        'is_published',
    ];

    public static function generateToken()
    {
        $token = Str::random(32);

        // Make sure token is unique
        while (self::where('token', $token)->exists()) {
            $token = Str::random(32);
        }

        return $token;
    }

    public static function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return strlen($initials) > 2 ? substr($initials, 0, 2) : $initials;
    }
}
