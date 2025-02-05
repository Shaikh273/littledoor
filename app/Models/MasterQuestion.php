<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = "master_questions";

    public function subCategoryQuestionOption(){
        return $this->hasMany(SubCategoryQuestionOptionMapping::class,'master_question_id','id');
    }
}
