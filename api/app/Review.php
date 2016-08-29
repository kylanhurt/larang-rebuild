<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    //
    public function entity () {
        return $this->hasOne('App\Entity');
        
        
    }
    
    public function user () {
        return $this->hasOne('App\User');
    }
}
