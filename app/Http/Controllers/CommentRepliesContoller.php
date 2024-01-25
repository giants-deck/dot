<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $replies = Comment::all();

        return view('admin.comments.replies.index', compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $insertion = [
          'comment_id' => $request->comment_id,
          'author' => Auth::user()->name,
          'email' => Auth::user()->email,
          'photo' => Auth::user()->photo->path,
          'body' => $request->reply,
          'user_id' => Auth::user()->id
        ];

        CommentReply::create($insertion);
        toast('Your Reply Submitted', 'success')->position('bottom-end');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $replies = CommentReply::whereCommentId($id)->get();
        return view('admin.comments.replies.show', compact('replies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->isAdmin()){
            CommentReply::whereId($id)->update(['is_active' => $request->is_active]);
            $reply = CommentReply::findOrFail($id);
            $is_active = $reply->is_active;
            if ($is_active == 0){
                $replies = CommentReply::whereCommentId($id)->get();
                toast('Disapproved', 'warning')->position('bottom-end');
                return redirect()->route('replies.show', $reply->comment_id);
            }else{
                $replies = CommentReply::whereCommentId($id)->get();
                toast('Approved', 'success')->position('bottom-end');
                return redirect()->route('replies.show', $reply->comment_id);
            }
        }
        toast('Not Permitted', 'error')->position('bottom-end');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reply = CommentReply::findOrFail($id);
        if (Auth::user()->isAdmin()){
            $reply->delete();
            toast('Reply Deleted', 'success')->position('bottom-end');
            return redirect()->route('replies.show', $reply->comment->id);
        }else{
            toast('Un-Authorized Action', 'error')->position('bottom-end');
            return redirect()->route('replies.show', $reply->comment->id);
        }
    }
}
