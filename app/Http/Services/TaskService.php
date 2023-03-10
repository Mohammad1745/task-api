<?php

namespace App\Http\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService extends Service
{
    /**
     * @return array
     */
    public function getList (): array
    {
        try {
             $tasks = Task::where('user_id', Auth::id())->get();
             return $this->responseSuccess('', ["tasks" => $tasks]);
        }
        catch (\Exception $exception) {
            return $this->responseError( $exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function getTask (int $id): array
    {
        try {
             $task = Task::where('user_id', Auth::id())->findOrFail($id);
             return $this->responseSuccess('', ["task" => $task]);
        }
        catch (\Exception $exception) {
            return $this->responseError( $exception->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function storeTask (array $data): array
    {
        try {
            Task::create([
                'user_id' => Auth::id(),
                'title' => $data['title'],
                'description' => $data['description']
            ]);
            return $this->responseSuccess('Task Created Successfully!');
        }
        catch (\Exception $exception) {
            return $this->responseError( $exception->getMessage());
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function updateTask (array $data): array
    {
        try {
            $task = Task::where('user_id', Auth::id())->findOrFail($data['id']);
            $task->update([
                'title' => $data['title'],
                'description' => $data['description']
            ]);
            return $this->responseSuccess('Task Updated Successfully!');
        }
        catch (\Exception $exception) {
            return $this->responseError( $exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function destroyTask (int $id): array
    {
        try {
            $task = Task::where('user_id', Auth::id())->findOrFail($id);
            $task->delete();
            return $this->responseSuccess('Task Deleted Successfully!');
        }
        catch (\Exception $exception) {
            return $this->responseError( $exception->getMessage());
        }
    }
}
