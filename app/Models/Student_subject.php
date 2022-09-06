<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_subject extends Model
{
    use HasFactory;
    public function sub(){
        return $this->belongsTo(Subject::class);
    }
}

