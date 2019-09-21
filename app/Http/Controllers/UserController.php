<?php

namespace App\Http\Controllers;

use \App\User;
use \App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Redirect, Response;
use Alert;

class UserController extends Controller
{
    public function index()
    {
        return view('user.listuser');
    }
    public function daftaruser()
    {
        // Alert::error('Error Message', 'Optional Title');
        return view('user.listuser');
    }

    public function getRoles()
    {
        $allRole = Role::all();
        $cats = array();
        foreach ($allRole as $role) {
            $cats[$role->id] = $role->name;
        }
        $cats2  = User::find(100);
        return Response::json(['rolek' => $cats]);
    }

    public function getUser()
    {


        return DataTables::of(User::query())
            ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
            ->setRowId('id')
            ->setRowData([
                'data-id' => 'row-{{$id}}',

                'data-roles' => 'row-{{$id}}',
            ])
            ->editColumn('role', function (User $user) {
                return collect($user->roles->pluck('name'))->implode('[]');
            })
            ->addIndexColumn()
            ->addColumn('action', 'button.action_button')
            ->make(true);
        // return Datatables::of(User::query())->make(true);
    }

    public function store(Request $request)
    {
        $userId = $request->user_id;
        $roleId = [
            'rolek' => $request->roleh
        ];
        if ($request->password) {
            $user   =   User::updateOrCreate(
                ['id' => $userId],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]
            );
        } else {
            $user   =   User::updateOrCreate(
                ['id' => $userId],
                [
                    'name' => $request->name,
                    'email' => $request->email
                ]
            );
        }

        $data = User::find($user['id']);
        $data->syncRoles($roleId['rolek']);
        return Response::json([
            'user' => $user,
            'message' => '<strong>Success!!!</strong> data user berhasil diubah',
            'class_name'    =>  'alert alert-success'
        ]);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = User::where($where)->first();

        $roll = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->where('model_has_roles.model_id', $where)
            ->select('roles.name', 'model_has_roles.role_id')
            ->get();

        foreach ($roll as $rol) {
            $rolid = $rol->role_id;
        }

        $allRole = Role::all();
        $cats = array();
        foreach ($allRole as $role) {
            $cats[$role->id] = $role->name;
        }
        return Response::json(array('user' => $user, 'rolid' => $rolid, 'cats' => $cats));
    }

    public function insert(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string'],
        ]);

        $user = new User;
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();
        $data = User::find($user->id);
        $data->syncRoles($request->input('role'));
        return redirect('daftaruser');
    }

    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //     ]);
    //     $data = User::findOrFail($id);
    //     $data->name     =   $request->input('name');
    //     $data->email    =   $request->input('email');
    //     if ($request->input('password')) {
    //         $data->password =   Hash::make($request->input('password'));
    //     }

    //     $data->syncRoles($request->input('role'));
    //     $data->save();
    //     return redirect('daftaruser');
    // }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return Response::json($user);
    }
}
