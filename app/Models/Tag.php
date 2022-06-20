<?php


namespace App\Models;

use App\Enums\TagTypeEnum;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $casts = [
        'type' => TagTypeEnum::class,
    ];
}
