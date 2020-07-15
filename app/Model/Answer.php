<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table='answers';
    protected $fillable=['question_id', 'ans_content', 'slug', 'ans_date', 'ans_time', 'status', 'created_by', 'updated_by'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
