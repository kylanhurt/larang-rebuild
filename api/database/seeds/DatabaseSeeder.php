<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\User;

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


        //User::truncate();
        DB::table('users')->truncate();
        //$this->call(UserTableSeeder::class);
        $this->call('UsersTableSeeder');

        Model::reguard();
    }
}

class UsersTableSeeder extends Seeder {
    public function run() {
        $faker = Faker::create();
        foreach(range(1,10) as $index) {
            User:: create([
                'email'=> $faker->email(),
                'username'=> $faker->word(),
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
                ['username' => 'RyanChenkie', 'email' => 'ryanchenkie@gmail.com', 'password' => Hash::make('secret')],
                ['username' => 'ChrisSevilleja', 'email' => 'chris@scotch.io', 'password' => Hash::make('secret')],
                ['username' => 'HollyLloyd', 'email' => 'holly@scotch.io', 'password' => Hash::make('secret')],
                ['username' => 'AdnanKukic', 'email' => 'adnan@scotch.io', 'password' => Hash::make('secret')],
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
