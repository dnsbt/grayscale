<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 * @property string $path
 */
class File extends Model
{
    protected $fillable = [
        'name',
        'path',
    ];
}
