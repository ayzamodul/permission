<?php

namespace Modul\Permission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware("web");  // this will solve your problem
        $this->middleware("auth");
        $this->middleware('role:Admin', ['only' => ['index','create','store','edit','update','show','destroy','delete']]);




    }
    public function index()
    {
        $active ="yetki";
        $permissions = Permission::all(); //Get all permissions

        return view('permission::permissions.index',compact('permissions','active'));
    }


    public function create()
    {
        $active ="yetki";
        $roles = Role::where('deleted',0)->get(); //Get all roles

        return view('permission::permissions.create',compact('roles','active'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'Permission' . $permission->name . ' added!');

    }


    public function show($id)
    {
        return redirect('permissions');
    }


    public function edit($id)
    {
        $active ="yetki";
        $permission = Permission::findOrFail($id);

        return view('permission::permissions.edit', compact('permission','active'));
    }


    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'Permission' . $permission->name . ' updated!');

    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission
        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('flash_message',
                'Permission deleted!');

    }
}
