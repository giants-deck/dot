<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
class AdminMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = collect(Photo::all())->map(function (object $photos){
            return $photos;
        })->reject(function ($photos){
            if ($photos->imageable_type != 'App\Models\Media'){
                return $photos;
            }
        });
        return view('admin.media.index', compact('photos'));
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
        $tz = 'Asia/Dhaka';
        $date = Carbon::now()->setTimezone($tz)->format('d_m_y_h_i_s_a');
        $newName = $request->file('path')->hashName();
        $newName = explode('.', $newName);
        $newName = $newName[0];
        $file = $request->file('path');
        $fileName = $newName.'_'.$date.'.'.$file->extension();
        $file->move('images', $fileName);
        $media = new Media();
        $media->photo()->create(['path'=>$fileName, 'imageable_id' => Auth::user()->id]);
        toast('Media Uploaded', 'success')->position('bottom-end');
        return redirect('admin/media');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->isAdmin()){
            $media = Photo::findOrFail($id);
            unlink(public_path().$media->path);
            $media->whereId($id)->delete();
            toast('Media Deleted', 'success')->position('bottom-end');
            return redirect('admin/media');
        }

        toast('Not Permitted!', 'error')->position('bottom-end');
        return redirect('admin/media');

    }
}
