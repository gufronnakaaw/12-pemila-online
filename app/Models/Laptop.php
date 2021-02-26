<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laptop extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name_laptop', 'brand_laptop', 'img_laptop', 'created_by', 'updated_at', 'status'];
}
