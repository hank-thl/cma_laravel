<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackOfficeUser extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $primary = 'user_id';
}
