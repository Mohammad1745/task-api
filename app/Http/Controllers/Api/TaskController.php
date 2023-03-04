<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Http\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * @param TaskService $service
     */
    function __construct (private readonly TaskService $service) {}

    /**
     * @return JsonResponse
     */
    public function list (): JsonResponse
    {
        return response()->json( $this->service->getList());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function single (int $id): JsonResponse
    {
        return response()->json( $this->service->getTask( $id));
    }

    /**
     * @param TaskStoreRequest $request
     * @return JsonResponse
     */
    public function store (TaskStoreRequest $request): JsonResponse
    {
        return response()->json( $this->service->storeTask( $request->all()));
    }

    /**
     * @param TaskUpdateRequest $request
     * @return JsonResponse
     */
    public function update (TaskUpdateRequest $request): JsonResponse
    {
        return response()->json( $this->service->updateTask( $request->all()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy (int $id): JsonResponse
    {
        return response()->json( $this->service->destroyTask( $id));
    }
}
