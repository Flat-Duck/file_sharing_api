<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "groups";
    protected $primaryKey = 'g_no';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tr_id','g_name'
    ];
    protected $appends = [
        'teacher_name'
    ];

    /**
     * Get the students for the Group.
     */
    public function students()
    {
        return $this->belongsToMany('App\Student','student_group','g_no','stu_id','g_no','stu_id')->withPivot(["stu_group"]);
    }

    /**
     * Get the materails for the Group.
     */
    public function materials()
    {
        return $this->hasMany('App\Post','g_no','g_no');
    }
    /**
     * Get the materails for the Group.
     */
    public function announcements()
    {
        return $this->hasMany('App\Announcement','g_no','g_no');
    }

    
    /**
     * Get the teacher for the Group.
     */
    public function teacher()
    {
        return $this->belongsTo('App\Teacher','tr_id','tr_id');
    }

    function getTeacherNameAttribute(){
        return $this->teacher->user->full_name;

    }

    /**
     * Returns the paginated list of resources
     *
     * @return \Illuminate\Pagination\Paginator
     **/
    public static function getList()
    {
        return static::paginate(10);
    }
}
