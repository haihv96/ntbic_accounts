<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Permission\PermissionInterface;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserInterface $userRepository, RoleInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->middleware('permission:accounts,read users')->only('index');
        $this->middleware('permission:accounts,store users')->only(['create', 'store']);
        $this->middleware('permission:accounts,update users')->only(['edit', 'update']);
        $this->middleware('permission:accounts,destroy users')->only('destroy');
    }

    public function index()
    {
        $users = $this->userRepository->paginate(10);
        return view('management.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleRepository->all();
        return view('management.user.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $this->validate($request, ['email' => 'unique:users,email']);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $image = str_random(4) . "_" . $name;
            while (file_exists("assets/upload/users" . $image)) {
                $image = str_random(4) . "_" . $name;
            }
            $file->move("assets/upload/users", $image);
        } else {
            $image = "";
        }
        $user = $this->userRepository->create([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'image' => $image,
            'password' => bcrypt('123456')
        ]);

        return redirect()->route('users.index')->with('message', 'Bạn đã thêm user thành công');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        return view('management.user.edit', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $this->validate($request, ['email' => 'unique:users,email,' . $id]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $image = str_random(4) . "_" . $name;
            while (file_exists("assets/upload/users" . $image)) {
                $image = str_random(4) . "_" . $name;
            }
            $file->move("assets/upload/users", $image);
        } else {
            $image = "";
        }

        $updateData = [
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'image' => $image,
        ];

        $this->userRepository->update($id, $updateData);
        return redirect()->back()->with('message', 'Bạn đã sửa user thành công');
    }

    public function destroy($id)
    {
        if ($this->userRepository->delete($id)) {
            return response()->json([
                'error' => false,
                'data' => null
            ]);
        }
    }
}