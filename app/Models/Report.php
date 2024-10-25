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

    public function getStatusBadgeAttribute()
    {
        if ( $this->status == 'Submit') {
           $status = '<span class="badge bg-secondary text-white">Submit</span>';
        } elseif ( $this->status == 'Reviewed') {
            $status = '<span class="badge bg-success text-white">Reviewed</span>';
        } elseif ( $this->status == 'Approved') {
            $status = '<span class="badge badge-outline text-green">Approved</span>';
        } elseif ( $this->status == 'Rejected') {
            $status = '<span class="badge bg-danger text-white">Rejected</span>';
        }else {
           $status = '<span class="status-dot status-orange">'.$this->status.'</span>';
        }
        return $status;
    }

    public function scopeFilter($query, array $filters){
        if($filters['department_id'] ?? false) {
            $query->where('department_id', request('department_id'));
        }
        if($filters['section_id'] ?? false) {
            $query->where('section_id', request('section_id'));
        }
        if($filters['status'] ?? false) {
            $query->where('status', request('status'));
        }
    }
}
