<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Employee;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = Employee::all();
        foreach($employee as $value){
           User::create([ 'email' => $value->id,
           'email_verified_at' => now(),
           'password' => Hash::make('password'), // password
           'remember_token' => Str::random(10),
           'employee_id' => $value->id]);
    }
    }
}
