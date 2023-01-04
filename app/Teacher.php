<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = "teacher";
    protected $primaryKey = 'tr_id';
    public $timestamps = false;

    // protected $appends = [
    //     'teacher_name'
    // ];

    /**
     * Get the user for the Teacher.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }

    // function getNameAttribute()
    // {
    //     return $this->user->full_name;
    // }

    /**
     * Get the groups for the Student.
     */
    public function groups()
    {
        return $this->hasMany('App\Group','tr_id','tr_id');
    }
}
