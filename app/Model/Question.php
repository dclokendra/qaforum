<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table='questions';
    protected $fillable=['category_id', 'que_content', 'slug', 'que_date', 'que_time', 'status', 'created_by', 'updated_by'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
}
