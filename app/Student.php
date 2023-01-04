<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "student";

    /**
     * Get the groups for the Student.
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group','student_group','stu_id','g_no','stu_id','g_no')->withPivot(["stu_group"]);
    }
    /**
     * Get the user for the Student.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','user_id');
    }

}
