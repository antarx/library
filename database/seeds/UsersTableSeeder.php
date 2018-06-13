<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'       => 'John Smith',
            'company'    => 'Private',
            'email'      => 'john@smith.com',
            'ip'         => [
                '192.0.0.1',
                '192.0.0.2',
                '192.0.0.3',
             ],
            'password'   => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
