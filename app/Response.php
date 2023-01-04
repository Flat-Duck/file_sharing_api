<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = "response";


        /**
     * Get the providers for the Service.
     */
    public function grpup()
    {
        return $this->belongsTo('App\Group','g_no','g_no');
    }
    
        /**
     * Get the providers for the Service.
     */
    public function enquiry()
    {
        return $this->belongsTo('App\Enquiry','e_no','e_no');
    }
}
