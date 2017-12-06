<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Permission\PermissionInterface;
use App\Models\Permission;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    protected $permissionRepository;
    protected $source;
    protected $source_rpl;
    protected $id;

    public function __construct(PermissionInterface $permissionRepository, Request $request)
    {
        $this->permissionRepository = $permissionRepository;
        $this->source = $request->source;
        $this->source_rpl = str_replace('-', '_', $request->source);
        $this->id = $request->permission;
        $this->middleware("permission:$this->source_rpl,read permission")->only('index');
        $this->middleware("permission:$this->source_rpl,store permission")->only(['create', 'store']);
        $this->middleware("permission:$this->source_rpl,update permission")->only(['edit', 'update']);
        $this->middleware("permission:$this->source_rpl,destroy permission")->only('destroy');
    }

    public function index()
    {
        $permissions = Permission::where('source', $this->source_rpl)->paginate(10);
        return view('management.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('management.permission.create');
    }

    public function store(PermissionRequest $request)
    {
        $this->permissionRepository->insert([
            'source' => $this->source_rpl,
            'name' => $request->name
        ]);
        return redirect()->route('permissions.index', ['source' => $this->source])->with('message', 'Bạn đã thêm permission thành công');
    }

    public function edit()
    {
        $permission = $this->permissionRepository->find($this->id);
        return view('management.permission.edit', compact('permission'));
    }

    public function update(PermissionRequest $request)
    {
        $updateData = ['name' => $request->name, 'source' => $this->source_rpl];
        if ($this->permissionRepository->update($this->id, $updateData)) {
            return redirect()->back()->with('message', 'Bạn đã sửa permission thành công');
        }
    }

    public function destroy()
    {
        if ($this->permissionRepository->delete($this->id)) {
            return response()->json([
                'error' => false,
                'data' => null
            ]);
        }
    }
}