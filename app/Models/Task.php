<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'due_date',
        'status',
    ];

    protected $dates = ['due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function taskShares()
    {
        return $this->hasMany(TaskShare::class, 'task_id', 'id');
    }
}
