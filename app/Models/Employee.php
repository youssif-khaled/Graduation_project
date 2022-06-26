<?php

namespace App\Models;
use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, Rateable;
    protected $fillable =['id','name','department','meals'];
    public function Employee_Request(){
        return $this->hasOne(Request::class,'employee_id','id');
    }
    public function Employee_Ratings(){
        return $this->hasMany(Rating::class,'employee_id','id');
    }
    public function User(){
        return $this->hasOne(User::class,'employee_id','id');
    }
}
