<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'potential_dangerous_point' => 'array',
        'most_danger_point' => 'array',
        'keyword' => 'array',
        'attendant' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instructors()
    {
        return $this->hasMany(ReportInstructor::class);
    }
}
