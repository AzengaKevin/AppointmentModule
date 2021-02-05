<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'completed'];


    /**
     * Task Employee Relationship M : N
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

}
