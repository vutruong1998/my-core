<?php

namespace MyCore\Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MyCore\Core\Http\Controllers\BaseController;
use MyCore\Core\Models\Role;
use MyCore\Core\Models\User;
use MyCore\Core\Repositories\UserRepository;

class UserController extends BaseController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('permission:users.index');
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $title = trans('mc_core::user.heading.index');
        return view('mc_core::user.index', compact(
            'title'
        ));
    }

    public function datatable()
    {
        $users = $this->userRepository->datatable();
        $dataTables = datatables($users);
        $dataTables->editColumn('created_at', function ($data) {
            return formatDate($data->created_at, PHP_DATE);
        });

        $dataTables->addColumn('action', function ($data) {
            return "<a class='btn btn-warning btn-sm' href=". route('users.edit', $data->id) .">Sửa</a>";
        });

        $dataTables->escapeColumns([]);
        return $dataTables->toJson();
    }

    public function create()
    {
        $title = trans('mc_core::user.heading.create');
        $roles = Role::where('guard_name', 'web')->get();
        return view('mc_core::user.create_edit', compact(
            'title',
            'roles'
        ));
    }

    public function store(Request $request)
    {
        try {
            $input = $request->except(['_token']);
            $this->parseDataForForm($input);
            $input['password'] = Hash::make($input['password']);
            $user = $this->userRepository->create($input);
            $user->roles()->sync($input['roles']);
            return redirect()->route('users.index')->with([
                'success_message' => 'Done'
            ]);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $title = trans('mc_core::user.heading.edit');
        $data = $this->userRepository->find($id);
        $roles = Role::where('guard_name', 'web')->get();
        return view('mc_core::user.create_edit', compact(
            'title',
            'data',
            'roles'
        ));
    }

    public function update(Request $request, $id)
    {
        try {
            $input = $request->except(['_token']);
            $this->parseDataForForm($input);
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                unset($input['password']);
            }
            $user = $this->userRepository->find($id);
            $user->update($input);
            $user->roles()->sync($input['roles']);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        return back()->with([
            'success_message' => 'Done'
        ]);
    }

    public function destroy($id)
    {
        $user = $this->userRepository->find($id);
        $user->delete();
        return redirect()->route('users.index')->with([
            'success_message' => 'Done'
        ]);
    }

    public function parseDataForForm(array &$input = [])
    {
        if (!array_key_exists('roles', $input)) {
            $input['roles'] = [];
        }
    }

    public function sortable(Request $request)
    {
        DB::beginTransaction();
        try {
            $array = $request->orders;
            $this->userRepository->massUpdate($array);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e, 404);
        }
        return response()->json(['code' => 200]);
    }
}
