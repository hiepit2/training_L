<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'address',
        'birthday',
        'phone',
        'gender',
        'email',
        'avatar',
        'faculty_id',
        'user_id',
        'code'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    
    public function subjects(){
        return $this->belongsToMany(Subject::class)->withPivot('point');
    }

}
