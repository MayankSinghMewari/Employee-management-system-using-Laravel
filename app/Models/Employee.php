<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'email',
        'gender',
        'department_id',
        'image',
        'is_active',
        'is_deleted',
        'user_id',

    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
