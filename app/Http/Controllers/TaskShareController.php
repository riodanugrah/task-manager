<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskShare;
use App\Models\User;
use App\Models\Task;

class TaskShareController extends Controller
{
    public function shared(Request $request, Task $task)
    {
        $emails = explode(',', $request->emails);
        $sharedBy = auth()->user(); // User yang membagikan task

        foreach ($emails as $email) {

            $user = User::where('email', trim($email))->first();

            if ($user) {
                // Email terdaftar, lakukan proses share task
                $taskShare = new TaskShare();
                $taskShare->task_id = $task->id;
                $taskShare->shared_by = $sharedBy->id;
                $taskShare->shared_with = $user->id;
                $taskShare->save();
            } else {
                // Email tidak terdaftar, berikan pesan error atau lakukan tindakan sesuai kebutuhan
                return response()->json(['error' => 'Email ' . $email . ' is not registered']);
            }
        }

        return redirect()->back()->with('success', 'Share berhasil ditambahkan.');
    }

    public function showShared(Task $task)
    {
        $shared = TaskShare::where('task_id', $task->id)
            ->join('users', 'task_shares.shared_with', '=', 'users.id')
            ->select('users.name', 'users.email')
            ->get();

        return view('task.shared_users', compact('shared'));
    }
}
