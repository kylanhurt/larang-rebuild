<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Criteria;

class CriterionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        //initial non-submitted 'general' criterion
        Criteria::create(['name' => 'general', 'user_id' => 1]);    
        
    }
}
