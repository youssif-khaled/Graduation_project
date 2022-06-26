<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;

class PersonalAccessToken extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $table = 'personal_access_tokens';
}
