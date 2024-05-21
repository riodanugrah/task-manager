<?php

namespace App\Http\Controllers;

use App\Models\TaskComment;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskCommentController extends Controller
{
    public function store(Request $request, $task)
    {
        $comment = new TaskComment();
        $comment->user_id = auth()->user()->id;
        $comment->task_id = $task; // Mengisi task_id dengan nilai yang diperlukan
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }

    // public function update(Request $request, $task, $comment)
    // {
    //     $taskComment = TaskComment::find($comment);
    //     $taskComment->comment = $request->comment;
    //     $taskComment->save();

    //     return response()->json(['message' => 'Komentar berhasil diperbarui']);
    // }

    public function destroy($task, $comment)
    {
        $taskComment = TaskComment::find($comment);
        $taskComment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus');
    }
}
