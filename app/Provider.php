<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'location', 'user_name', 'password','fbID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Validation rules
     *
     * @return array
     **/
    public static function validationRules()
    {
        return [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'location' => 'required|string',
            'fbID' => 'nullable|string',
            'user_name' => 'required|string',
            'password' => 'string|confirmed',
            'services' => 'array',
            'services.*' => 'numeric|exists:services,id',
        ];
    }

    /**
     * Get the services for the Provider.
     */
    public function services()
    {
        return $this->belongsToMany('App\Service');
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
