<?php

namespace Modul\Permission\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Models\Yonetici;
use Illuminate\Http\Request;

use Modul\Permission\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers; //Importing laravel-permission models
//use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
//Enables us to output flash messaging
use Session;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware("web");  // this will solve your problem
        $this->middleware("auth");
        $this->middleware('role:Admin', ['only' => ['index','create','store','edit','update','destroy','delete','show']]);




    }



    public function index()
    {
        //Get all users and pass it to the view
        $active ="yetki";
        $users = Yonetici::where('deleted',0)->get();
        return view('permission::users.index',compact('users','active'));
    }


    public function create()
    {

        $active ="yetki";
        $roles = Role::where('deleted',0)->get();
        return view('permission::users.create', compact('roles','active'));
    }


    public function store(Request $request)
    {
        //Validate name, email and password fields

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|unique:yonetici',

        ]);

        $data = request()->only('name', 'email');

        if (request()->filled('sifre')) {
            $data['sifre'] = Hash::make(request('sifre'));
        }


        $user = Yonetici::create($data); //Retrieving only the email and password data

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        //Redirect to the users.index view and display message
        if($user){
         return redirect()->route('users.index')
                    ->with('success',
                        'Kaydedildi.');
        }
        else{
          return redirect()->route('users.create')
                    ->with('error',
                        'Email zaten var.');
        }


    }


    public function show($id)
    {
        return redirect('permission::users');
    }


    public function edit($id)
    {
        $active ="yetki";
        $user = Yonetici::findOrFail($id); //Get user with specified id
        $roles = Role::where('deleted',0)->get(); //Get all roles

        return view('permission::users.edit', compact('user', 'roles','active')); //pass user and roles data to view

    }


    public function update(Request $request, $id)
    {
        $user = Yonetici::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|unique:yonetici,email,' . $id,

        ]);
        $input = $request->only(['name', 'email']); //Retreive the name, email and password fields
        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('users.index')
            ->with('flash_message',
                'User successfully edited.');
    }



        public function destroy(Request $request)
        {
            $tid = $request->input('tid');
          $user = Yonetici::findOrFail($tid);
               $user->deleted=1;
          $user->save();

            if ($user) {
                echo 1;
            } else {
                echo 0;
            }


        }
}
