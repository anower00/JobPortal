<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    public function jobs(){
        return $this->belongsTo('App\Job');
    }

}
