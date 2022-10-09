<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'resume_id'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
