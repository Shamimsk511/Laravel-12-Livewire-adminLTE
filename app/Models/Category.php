<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'pcs_per_box',
        'sft_per_pcs',
    ];
}
