<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'jobTitle',
        'jobDescription',
        'jobResponsibilities',
        'jobQualifications',
        'keywords'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
