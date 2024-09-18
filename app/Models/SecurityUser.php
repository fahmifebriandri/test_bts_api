<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SecurityUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'cbts_user';

    protected $guarded = [];
}
