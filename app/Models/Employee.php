<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['rung', 'languages', 'availability', 'contact'];

    
    protected $casts = [
        'languages' => 'array',
        'availability' => 'array',
        'contact' => 'array'
    ];

    /**
     * An employee table extends the users table
     * 
     * @return Relationship
     */
    public function user()
    {
        return $this->morphOne(User::class, 'authenticable');

    }

    /**
     * Employee Task Relationship M : N
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    /**
     * 
     * Get all employee leves
     * 
     * @return array of available levels
     */
    public static function rungs() : array
    {
        return ['Junior', 'Middle', 'Senior'];
    }

}
