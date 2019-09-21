<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      =>  'admin',
            'email'     =>  'admin@gmail.com',
            'password'  =>  bcrypt(123456)
        ]);
        //tambahkan assign role untuk user diatas
        $user->assignRole('admin');
    }
}
