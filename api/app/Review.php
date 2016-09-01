<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
 
    protected $fillable = ['score', 'entity_id', 'user_id', 'criteria_id'];    
    
    //
    public function entity () {
        return $this->hasOne('App\Entity');
        
        
    }
    
    public function user () {
        return $this->hasOne('App\User');
    }
}
