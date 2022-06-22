<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function index(Request $request)
    {
        $users = $this->model
            ->getUsers(
                $request->search ?? ''
            );
        return response()->json($users, 200);
    }

    public function show($id)
    {
        $users = $this->model->find($id);
        return response()->json($users, 200);
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if ($request->image) {

            $data['image'] = $request->image->store('users');
        }

        $user = User::create($data);


        return $this->index($request);
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit($id)
    {
        if (!$user = $this->model->find($id))
            return redirect()->route('users.index');
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (!$user = $this->model->find($id)) {
            return redirect()->route('users.index');
        }
        $data = $request->only('name', 'email');
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->image) {
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $data['image'] = $request->image->store('users');
        }

        $user->update($data);

        return response()->json($user, 200);
    }

    public function delete($id)
    {

        if (!$user = $this->model->find($id)) {
            return response()->json([
                'error' => 'Não encontrado!'
            ], 404);
        }

        $user->delete();

        return response()->json([], 204);
    }
}
