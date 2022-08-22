<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'birthday',
        'phone',
        'gender',
        'email',
        'avatar',
        'faculty_id'
    ];
}
