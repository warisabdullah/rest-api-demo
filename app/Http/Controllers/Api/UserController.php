<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignUserToGroup;
use App\Http\Requests\CreateUserRequest;
use App\Repositories\UserRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UserController extends Controller
{
    use ApiResponser;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): JsonResponse
    {
        $users = $this->userRepository->withPaginate(5);
        return $this->success($users, "Available Users");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        dd(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->userRepository->store($request->all());
        return $this->success($user, 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = $this->userRepository->delete($request->user_id);
        if ($user == 1) {
            return $this->success(null, 'User deleted successfully');
        } else {
            return $this->error('User not found');
        }
    }

    public function assignGroup(AssignUserToGroup $request)
    {
        $userId = $request->user_id;
        $groupId = $request->group_id;
        $ifAssigned = $this->userRepository->assignUserToGroup($userId, $groupId);
        if ($ifAssigned) {
            return $this->success(null, 'Group assigned successfully');
        } else {
            return $this->error('Group already assigned');
        }
    }

    public function UnAssignGroup(AssignUserToGroup $request)
    {
        $userId = $request->user_id;
        $groupId = $request->group_id;
        $ifAssigned = $this->userRepository->UnAssignUserToGroup($userId, $groupId);
        if ($ifAssigned) {
            return $this->success(null, 'Group Un-assigned successfully');
        } else {
            return $this->error('Group not assigned');
        }
    }
}
