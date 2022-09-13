<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\CreateUserRequest;
use App\Repositories\GroupRepository;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    use ApiResponser;

    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): JsonResponse
    {
        $groups = $this->groupRepository->withPaginate(5);
        return $this->success($groups, "Group List");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CreateGroupRequest $request): JsonResponse
    {
        $group = $this->groupRepository->store($request->all());
        return $this->success($group, 'Group created successfully');
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
        $group = $this->groupRepository->delete($request->group_id);
        if ($group == 1)
        {
            return $this->success(null, 'Group deleted successfully');
        }
        else
        {
            return $this->error('Group not found');
        }
    }
}
