<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Permission\PermissionInterface;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\RoleRequest;

class RolePermissionController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;
    protected $source_rpl;
    protected $source;
    protected $id;

    public function __construct(RoleInterface $roleRepository, PermissionInterface $permissionRepository, Request $request)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->source = $request->source;
        $this->source_rpl = str_replace('-', '_', $request->source);
        $this->id = $request->role;
        $this->middleware("permission:$this->source_rpl,read role_permissions")->only('index');
        $this->middleware("permission:$this->source_rpl,store role_permissions")->only(['create', 'store']);
        $this->middleware("permission:$this->source_rpl,update role_permissions")->only(['edit', 'update']);
        $this->middleware("permission:$this->source_rpl,destroy role_permissions")->only('destroy');
    }
    
    public function index()
    {
        $roles = $this->roleRepository->where('source', $this->source_rpl)->paginate(10);
        return view('management.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::where('source', $this->source_rpl)->get();
        return view('management.role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $insertData = ['name' => $request->name, 'source' => $this->source_rpl];
        $role = $this->roleRepository->create($insertData);
        $role->givePermissionsTo($this->source_rpl, $request->permissions);

        return redirect()->route('roles.index', ['source' => $this->source])->with('message', 'Bạn đã thêm role thành công');
    }

    public function edit()
    {
        $role = $this->roleRepository->find($this->id);
        $permissions = Permission::where('source', $this->source_rpl)->get();

        return view('management.role.edit', compact('role', 'permissions'));
    }

    public function update(RoleRequest $request)
    {
        $updateData = ['name' => $request->name, 'source' => $this->source_rpl];
        $this->roleRepository->update($this->id, $updateData);
        
        $role = $this->roleRepository->find($this->id);
        $role->permissions()->detach();
        $role->givePermissionsTo($this->source_rpl, $request->permissions);

        return redirect()->back()->with('message','Bạn đã sửa role thành công');
    }
    public function destroy()
    {
        if($this->roleRepository->delete($this->id)) {
            return response()->json([
                'error' => false,
                'data' => null
            ]);
        }
    }
}