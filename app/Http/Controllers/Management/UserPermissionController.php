<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Repositories\Permission\PermissionInterface;
use App\Models\Permission;

class UserPermissionController extends Controller
{
    protected $userRepository;
    protected $permissionRepository;
    protected $source_rpl;
    protected $id;
    protected $source;

    public function __construct(UserInterface $userRepository, PermissionInterface $permissionRepository, Request $request)
    {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
        $this->source_rpl = str_replace('-', '_', $request->source);
        $this->id = $request->user_permission;
        $this->source = $request->source;
        $this->middleware("permission:$this->source_rpl,read user_permissions")->only('index');
        $this->middleware("permission:$this->source_rpl,update user_permissions")->only(['edit', 'update']);
    }

    public function index()
    {
        $users = $this->userRepository->paginate(10);
        $source_rpl = $this->source_rpl;

        return view('management.user_permission.index', compact('users', 'source_rpl'));
    }

    public function edit()
    {
        $source_rpl = $this->source_rpl;
        $user = $this->userRepository->find($this->id);
        $permissions = Permission::where('source', $source_rpl)->get();

        return view('management.user_permission.edit', compact('user', 'permissions', 'source_rpl'));
    }

    public function update(Request $request)
    {
        $user = $this->userRepository->find($this->id);
        $user->permissions()->detach();
        $user->givePermissionsTo($this->source_rpl, $request->permissions);

        return redirect()->route('user-permissions.index', ['source' => $this->source])->with('message', 'Update succefully');
    }
}
