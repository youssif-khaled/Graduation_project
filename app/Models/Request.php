<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable =['employee_id','status'];
    public function Employee(){
        return $this->belongsTo(Employee::class);
    }
}
