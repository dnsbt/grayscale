<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $email
 */
class EmailSubscription extends Model
{
    protected $fillable = [
        'email'
    ];
}
