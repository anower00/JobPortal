<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function apply_jobs(){
        return $this->hasMany('App\ApplyJob');
    }
}
