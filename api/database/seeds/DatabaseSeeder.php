<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\User;
use App\Criteria;
use App\Entity;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        //delete rows from some tables
        DB::table('criterion')->truncate();   
        DB::table('reviews')->truncate();         
        DB::table('entities')->truncate();        
        DB::table('users')->truncate();

        //seed the tables
        $this->call('UsersTableSeeder');
        $this->call('CriterionTableSeeder');
        $this->call('EntitiesTableSeeder');
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
        Model::reguard();
    }
}

class UsersTableSeeder extends Seeder {
    public function run() {
        
        DB::table('users')->insert(['email' => 'a@a.a', 'name' => 'a', 'password' => Hash::make('a')]);  
        
        $faker = Faker::create();
        foreach(range(1,10) as $index) {
            User:: create([
                'email'=> $faker->email(),
                'name'=> $faker->word(),
                'password'=> $faker->password()
            ]);
        }
    }
}

class SampleUsersDbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('users')->delete();

        $users = array(
                ['name' => 'RyanChenkie', 'email' => 'ryanchenkie@gmail.com', 'password' => Hash::make('secret')],
                ['name' => 'ChrisSevilleja', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret')],
                ['name' => 'HollyLloyd', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret')],
                ['name' => 'AdnanKukic', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret')],
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }
        Model::reguard();
    }
}

class FakeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}


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

class EntitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entity::create([
            'title' => 'Sample Company', 
            'pretty_url' => 'sample-company',
            'description' => 'This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz. This is the sample company. The sample company does xyz.',
            'website' => 'www.samplecompany.com',
            'year_founded' => '2016',
            'industry' => 'Sample Industry',
            'created_by' => 1,
            'location' => 'UA' //I am not certain if this abbreviation is correct
        ]); 
    }
}