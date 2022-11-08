<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::whereNotIn('id',[1])->where('user_id', Auth::user()->id)->get();

        // dd($user);
        return view('home',compact('user'));
    }

    public function create(){
        return view('users.create');

    }

    public function store(Request $request){
      $request['user_id'] = Auth::user()->id;
      $user = $request->all();
      User::create($user);
      return redirect('home')->with('status','user created Successfully');


    }


    public function edit($id){

        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    public function update(request $request,$id){

        $item = User::find($id);
        $item->name = $request->input('name');
        $item->lastname = $request->input('lastname');
        $item->phone = $request->input('phone');
        $item->email = $request->input('email');
        $item->update();
       return redirect('home')->with('status','user Updated Successfully'); 

    }

    public function delete($id){

        $users = User::find($id);
        $users->delete();

        return redirect('home')->with('status','user deleted Successfully');

    }

}
