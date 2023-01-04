<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = "announcement";
    protected $primaryKey = 'an_no';
    public $timestamps = false;
}
