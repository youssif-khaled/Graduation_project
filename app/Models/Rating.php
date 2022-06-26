<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['rating','comment','employee_id'];
    public function Employee(){
        return $this->belongsTo(Employee::class);
    }
}
