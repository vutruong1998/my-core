<?php 

namespace MyCore\Core\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MyCore\Core\Http\Controllers\CoreController;
use MyCore\Core\Models\Permission;
use MyCore\Core\Models\Role;
use MyCore\Core\Repositories\RoleRepository;

class RoleController extends CoreController {
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository) 
    {
        $this->middleware('permission:roles.index');
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $title = trans('mc_core::role.heading.index');
        return view('mc_core::role.index', compact(
            'title'
        ));
    }

    public function datatable()
    {
        $roles = $this->roleRepository->datatable();
        $dataTables = datatables($roles);
        $dataTables->editColumn('created_at', function ($data) {
            return formatDate($data->created_at, PHP_DATE);
        });

        $dataTables->addColumn('action', function ($data) {
            return "<a class='btn btn-warning btn-sm' href=". route('roles.edit', $data->id) .">Sửa</a>";
        });

        $dataTables->escapeColumns([]);
        return $dataTables->toJson();
    }

    public function create()
    {
        $title = trans('mc_core::role.heading.create');
        $permissions = Permission::where('guard_name', 'web')->get();
        return view('mc_core::role.create_edit', compact(
            'title',
            'permissions'
        ));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->except(['_token']);
            $this->parseDataForForm($input);
            $role = $this->roleRepository->create($input);
            $role->syncPermissions($input['permissions'], true);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
        return redirect()->route('roles.index')->with([
            'success_message' => 'Done'
        ]);
    }

    public function edit($id)
    {
        $title = trans('mc_core::role.heading.edit');
        $data = $this->roleRepository->find($id);
        $permissions = Permission::where('guard_name', 'web')->get();
        return view('mc_core::role.create_edit', compact(
            'title',
            'data',
            'permissions'
        ));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $input = $request->except(['_token']);
            $this->parseDataForForm($input);
            $role = $this->roleRepository->find($id);
            $role->update($input);
            $role->syncPermissions($input['permissions'], true);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
        
        return back()->with([
            'success_message' => 'Done'
        ]);
    }

    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);
        $role->delete();
        return redirect()->route('roles.index')->with([
            'success_message' => 'Done'
        ]);
    }

    public function parseDataForForm(array &$input = [])
    {
        if (!array_key_exists('permissions', $input)) {
            $input['permissions'] = [];
        }
    }
}