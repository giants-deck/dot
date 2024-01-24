<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminUsersController extends Controller
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
        $css = [
            'administrator' => 'badge bg-success-gradient',
            'author' => 'badge bg-purple-gradient',
            'subscriber' => 'badge bg-orange-gradient',
            'no' => 'badge bg-danger-gradient',
        ];

        $users = collect(User::all())->map(function (object $users){
            return $users;
        })->reject(function ($users){
            return $users->id == Auth::user()->id;
        });
        return view('admin.users.index', compact('users', 'css'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $roles = $roles->pluck('role_name', 'id')->toArray();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->password == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
        }

//        if ($request->file('path')){
//            $photo_id = $this->mediaHandle($request, $from = 'store');
//            $input['photo_id'] = $photo_id;
//        }

        $user = User::create($input);
        if ($request->file('path')){
            $this->mediaHandle($request, $user, $from = 'store');
        }
        toast('User Created', 'success')->position('bottom-end');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $roles = $roles->pluck('role_name', 'id')->toArray();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->password == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
        }



        $user = User::findOrFail($id);
        $user->update($input);
        if ($request->file('path')){
            $this->mediaHandle($request, $user, $from = $id);
        }
        toast('User Info Updated', 'info')->position('bottom-end');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->isAdmin()){
            $user = User::findOrFail($id);
            if ($user->photo){
                unlink(public_path().$user->photo->path);
            }
            $user->delete();
            toast('User Deleted', 'info')->position('bottom-end');
        }else{
            toast('You dont\'t have permission', 'error')->position('bottom-end');
        }

        return redirect('admin/users');
    }

    public function notAdmin()
    {
        return view('admin/error/error100');
    }

    public function mediaHandle(Request $request,$user, $from)
    {
        $tz = 'Asia/Dhaka';
        $date = Carbon::now()->setTimezone($tz)->format('d_m_Y_h_i_s_a');

        $newName = $request->name;
        $newName = explode(' ', $newName);
        $count = count($newName);
        if ($count > 1){
            $newName = implode('_', $newName);
        }else{
            $newName = $request->name;
        }

        if ($from != 'store'){
            if ($user->photo){
                $file = $request->file('path');
                $fileName = $newName.'_'.$date.'.'.$file->extension();
                $file->move('images', $fileName);
                unlink(public_path().$user->photo()->first()->path);
                $user->photo()->whereImageableId($user->id)->update(['path'=>$fileName]);
            }else{
                $file = $request->file('path');
                $fileName = $newName.'_'.$date.'.'.$file->extension();
                $file->move('images', $fileName);
                $user->photo()->create(['path' => $fileName]);
            }
        }else{
            $file = $request->file('path');
            $fileName = $newName.'_'.$date.'.'.$file->extension();
            $file->move('images', $fileName);
            $user->photo()->create(['path'=>$fileName]);
        }
    }

    public function dashboard()
    {
        $cardColor = [
          'card-bg-info',
          'card-bg-primary',
          'card-bg-secondary',
          'card-bg-warning',
          'card-bg-danger',
          'card-bg-dark',
          'card-bg-success',
        ];
        $user = Auth::user();
        return view('customdash', compact('user', 'cardColor'));
    }
}
