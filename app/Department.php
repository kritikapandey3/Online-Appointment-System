<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department_name','department_slug', 'department_information'
    ];

    public function doctors() {
        return $this->hasMany('App\Doctor');
    }
}
