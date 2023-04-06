<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterSubCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = "master_sub_categories";


}
