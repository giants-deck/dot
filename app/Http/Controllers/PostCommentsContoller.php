<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentsContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $posts = collect(Post::all())->map(function (object $posts){
            return $posts;
        })->reject(function ($posts){
            if (!$posts->comments()->first()){
                return $posts;
            }
        });
        return view('admin.comments.index', compact('posts'));
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
        $user = Auth::user();

        $insertion = [
          'post_id' => $request->post_id,
          'author' => $user->name,
          'email' => $user->email,
          'photo' => $user->photo->path,
          'body' => $request->body,
        ];

        Comment::create($insertion);
        toast('Your Comment Submitted', 'success')->position('bottom-end');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments;
        return view('admin.comments.show', compact('comments'));
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

        //return $request->all();

        if (Auth::user()->isAdmin()){
            Comment::whereId($id)->update(['is_active' => $request->is_active]);
            $comment = Comment::findOrFail($id);
            $is_active = $comment->is_active;
            if ($is_active == 0){
                $post = Post::findOrFail($comment->post_id);
                $comments = $post->comments;
                toast('Disapproved', 'warning')->position('bottom-end');
                return view('admin.comments.show', compact('comments'));
            }else{
                $post = Post::findOrFail($comment->post_id);
                $comments = $post->comments;
                toast('Approved', 'info')->position('bottom-end');
                return view('admin.comments.show', compact('comments'));
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
        $comment = Comment::findOrFail($id);

        if(Auth::user()->isAdmin()){
            $comment->whereId($id)->delete();
            toast('Comment Deleted', 'success')->position('bottom-end');
            return redirect()->back();
        }
        toast('Not Permitted', 'error')->position('bottom-end');
        return redirect()->back();
    }

    public function singleComment($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.checkcomment', compact('comment'));
    }
}
