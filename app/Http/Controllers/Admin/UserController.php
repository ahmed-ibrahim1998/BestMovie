<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:view_user', ['only' => ['index']]);
        $this->middleware('permission:add_user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_user', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();
        return view('admin.adminapp.users.list', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'roles_name' => 'required',
                'age' => 'numeric|min:18|max:70',
            ]);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            if ($request->roles_name == ["owner"]) {
                $input['role_id'] = 1;
            } elseif ($request->roles_name == ["Drivers"]) {
                $input['role_id'] = 2;
            } elseif ($request->roles_name == ["Logistics"]) {
                $input['role_id'] = 3;
            } elseif ($request->roles_name == ["Warehouses"]) {
                $input['role_id'] = 4;
            } elseif ($request->roles_name == ["Balances"]) {
                $input['role_id'] = 5;
            }

            $user = User::create($input);
            $user->assignRole($request->input('roles_name'));
            return redirect()->route('users.index')
                ->with('success', trans('validation.success_user_created'));
        }catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);
        }

    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.adminapp.users.list', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'age' => 'numeric|min:18|max:70',
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input,array('password'));
        }

        if ($request->input('roles')[0] == ["owner"]) {
            $input['role_id'] = 1;
        } elseif ($request->input('roles')[0] == ["Drivers"]) {
            $input['role_id'] = 2;
        } elseif ($request->input('roles')[0] == ["Logistics"]) {
            $input['role_id'] = 3;
        } elseif ($request->input('roles')[0] == ["Warehouses"]) {
            $input['role_id'] = 4;
        } elseif ($request->input('roles')[0] == ["Balances"]) {
            $input['role_id'] = 5;
        }
        $user = User::find($input['id']);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles')[0]);
        return redirect()->route('users.index')
            ->with('success', trans('validation.success_user_updated'));
    }

    public function destroy(Request $request)
    {
        User::find($request->id)->delete();
        return redirect()->route('users.index')->with('success', trans('validation.success_user_deleted'));
    }

    public function AuthRouteAPI(Request $request)
    {
        return $request->user();
    }

    public function changeStatus($id)
    {
        $record = User::find($id);
        $record->update(['Status' => $record->Status ? 0 : 1]);
    }
}
