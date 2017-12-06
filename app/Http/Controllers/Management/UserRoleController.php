<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Repositories\Role\RoleInterface;
use App\Models\Role;

class UserRoleController extends Controller
{
    protected $userRepository;
    protected $roleRepository;
    protected $source_rpl;
    protected $id;
    protected $source;

    public function __construct(UserInterface $userRepository, RoleInterface $roleRepository, Request $request)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->source_rpl = str_replace('-', '_', $request->source);
        $this->id = $request->user_role;
        $this->source = $request->source;
        $this->middleware("permission:$this->source_rpl,read user_roles")->only('index');
        $this->middleware("permission:$this->source_rpl,update user_roles")->only(['edit', 'update']);
    }

    public function index()
    {
        $users = $this->userRepository->paginate(10);
        $source_rpl = $this->source_rpl;

        return view('management.user_role.index', compact('users', 'source_rpl'));
    }

    public function edit()
    {
        $source_rpl = $this->source_rpl;
        $user = $this->userRepository->find($this->id);
        $roles = Role::where('source', $source_rpl)->get();

        return view('management.user_role.edit', compact('user', 'roles', 'source_rpl'));
    }

    public function update(Request $request)
    {
        $user = $this->userRepository->find($this->id);
        $user->roles()->detach();
        $user->assignRoles($this->source_rpl, $request->roles);

        return redirect()->route('user-roles.index', ['source' => $this->source])->with('message','Update succefully');
    }
}
