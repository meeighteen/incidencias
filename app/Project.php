<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    
    public static $rules = [
        'name'=> 'required',
       //'description'=> '',
       'start'=>'date'
    ];
    public static $messages = [
            'name.required'=>'Es necesario ingresar un nombre para la solicitud.',
            'start.date'=> 'La fecha no tiene un formato adecuado.'
    ];
    protected $fillable =[

        'name', 'description', 'start'
    ];
    //RELACIONES
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    //ACCESSORS
    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function levels()
    {
        return $this->hasMany('App\Level');
    }

    public function getFirstLevelIdAttribute()
    {
        return $this->levels->first()->id;
    }
}
