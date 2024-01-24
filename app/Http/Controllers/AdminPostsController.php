<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all()->sortBy('cat_name');
        $category = $category->pluck('cat_name', 'id')->toArray();
        return view('admin.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        $post = Post::create($input);
        if ($request->file('path')){
            $this->mediaHandle($request, $post, $from = 'store');
        }
        toast('Post Created', 'success')->position('bottom-end');
        return redirect('admin/posts');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        $comments = collect($post->comments)->map(function (object $comments){
           return $comments;
        })->reject(function ($comments){
            if ($comments->is_active == 0){
                return $comments;
            }
        });

        return view('admin.posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->owner()){
            $category = Category::all()->sortBy('cat_name');
            $category = $category->pluck('cat_name', 'id')->toArray();
            $post = Post::findOrFail($id);
            return view('admin.posts.edit', compact('post', 'category'));
        }

        toast('Not Permitted', 'error')->position('bottom-end');
        return redirect('admin/posts');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();

        $post = Post::findOrFail($id);
        if (Auth::user()->id == $post->user_id){
            $post->update($input);
            if ($request->file('path')){
                $this->mediaHandle($request, $post, $from = 'update');
            }
            toast('Post Updated' , 'success')->position('bottom-end');
            return redirect('admin/posts');
        }else{
            toast('This is not your Post !' , 'error')->position('bottom-end');
            return redirect('admin/posts');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->owner()){
            if ($post->photo){
                unlink(public_path().$post->photo->path);
            }
            $post->delete();
            toast('Your post is DELETED!', 'success')->position('bottom-end');
            return redirect('admin/posts');
        }
        toast('This i\'snt your post!', 'error')->position('bottom-end');
        return redirect('admin/posts');
    }

    public function mediaHandle(Request $request, $post, $from)
    {
        $tz = 'Asia/Dhaka';
        $date = Carbon::now()->setTimezone($tz)->format('d_m_Y_h_i_s_a');

        $newName = $request->file('path')->hashName();
        $newName = explode('.', $newName);
        $newName = $newName[0];

        if ($from != 'store'){
            if ($post->photo()->first()){
                $file = $request->file('path');
                $fileName = $newName.'_'.$date.'.'.$file->extension();
                unlink(public_path().$post->photo()->first()->path);
                $file->move('images', $fileName);
                $post->photo()->update(['path'=>$fileName]);
            }else{
                $file = $request->file('path');
                $fileName = $newName.'_'.$date.'.'.$file->extension();
                $file->move('images', $fileName);
                $post->photo()->create(['path'=>$fileName]);
            }
        }else{
            $file = $request->file('path');
            $fileName = $newName.'_'.$date.'.'.$file->extension();
            $file->move('images', $fileName);
            $post->photo()->create(['path'=>$fileName]);
        }
    }

    public function singlePost($id)
    {
        $post = Post::findOrFail($id);
        $comments = collect($post->comments)->map(function (object $comments){
            return $comments;
        })->reject(function ($comments){
           if ($comments->is_active == 0){
               return $comments;
           }
        });
        return view('post', compact('post', 'comments'));
    }
}
