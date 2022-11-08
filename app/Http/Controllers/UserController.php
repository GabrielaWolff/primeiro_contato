<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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

    /**
     *
     * @OA\Get(
     *     path="/api/users",
     *     operationId="userIndex",
     *     tags={"Comment"},
     *     description="Index of User",
     *     @OA\Response(
     *     response= "default",
     *     description="Success: Array of users",
     *     @OA\MediaType(
     *       mediaType="text/plain",
     *         @OA\Schema(
     *           type = "array",
     *              @OA\Items(ref="#/components/schemas/UserData"),
     *           
     *         )
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        return response()->json(User::all(), 200);
    }

    public function show($id)
    {
        $users = $this->model->find($id);
        return response()->json($users, 200);
    }

     /**
     *
     * @OA\Post(
     *     path="/api/users",
     *     operationId="userStore",
     *     tags={"User"},
     *     description="Store a User",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/UserStore")),
     *    
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *     @OA\JsonContent(ref="#/components/schemas/UserData"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity"
     *     )
     *     
     * )
     *
     * @param  \app\Http\Requests\Comment\StoreRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
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

     /**
     *
     * @OA\Put(
     *     path="/api/user/{id}",
     *     operationId="userUpdate",
     *     tags={"User"},
     *     description="Update a User",
     *     @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/UserUpdate")),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful created",
     *         @OA\JsonContent(ref="#/components/schemas/UserData"),
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable entity"
     *     )
     *     
     * )
     *
     * @param  \app\Http\Requests\Comment\StoreRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
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


    /**
     *
     * @OA\Delete(
     *     path="/api/user/{id}",
     *     operationId="userDelete",
     *     tags={"User"},
     *     description="Delete User",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content"
     *     ),
     * 
     * )
     * 
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */

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
