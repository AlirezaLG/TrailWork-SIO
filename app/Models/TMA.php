<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tma extends Model
{

    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }




    protected $fillable = ['user_id', 'date', 'start_time', 'end_time', 'work_time', 'project_id'];
}
