<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
    //

    public function storeComment(Request $request)
    {
        Comment::insert([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Comment Added Successfully Admin will approved',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function allComment()
    {
        $data = Comment::latest()->get();
        return view('backend.comment.all_comment', compact('data'));
    }

    public function updateStatus(Request $request)
    {
        $comment = Comment::find($request->id);
        if ($comment) {
            $comment->status = $request->status;
            $comment->save();

            $notification = array(
                'message' => 'Status updated successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Failed to update status',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    }
}
