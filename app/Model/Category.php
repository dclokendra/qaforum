<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $fillable=['name','rank', 'slug', 'status', 'created_by', 'updated_by'];

    public function question()
    {
        return $this->hasMany(Question::class);
    }
}
