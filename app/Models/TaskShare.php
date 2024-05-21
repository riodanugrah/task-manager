<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'shared_from',
        'shared_with'
    ];

    public function share(Request $request, $taskId)
    {
        $request->validate([
            'shared_with' => 'required|exists:users,id',
        ]);

        TaskShare::create([
            'task_id' => $taskId,
            'shared_with' => $request->shared_with,
        ]);

        return back()->with('success', 'Task shared successfully.');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function sharedWith()
    {
        return $this->belongsTo(User::class, 'shared_with');
    }

    // public function sharedFrom()
    // {
    //     return $this->belongsTo(User::class, 'shared_from');
    // }
}
