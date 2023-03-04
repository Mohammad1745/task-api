<?php

namespace App\Http\Services;

use App\Models\Task;

class TaskService extends Service
{
    /**
     * @return array
     */
    public function getList (): array
    {
        try {
             $tasks = Task::all();
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
             $task = Task::findOrFail($id);
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
                'user_id' => 1,
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
            $task = Task::findOrFail($data['id']);
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
            $task = Task::findOrFail($id);
            $task->delete();
            return $this->responseSuccess('Task Deleted Successfully!');
        }
        catch (\Exception $exception) {
            return $this->responseError( $exception->getMessage());
        }
    }
}
