<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Traits\APIResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TodoController extends Controller
{
    use APIResponse;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $todoList = Todo::select('title', 'status', 'tuid', 'created_at')->latest()->simplePaginate(10);

            return $this->successResponse(['Todo list retrieve successfully done'], $todoList);

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return $this->invalidResponse(['Something went wrong! please try again later']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTodoRequest $request
     * @return JsonResponse
     */
    public function store(StoreTodoRequest $request): JsonResponse
    {
        try {
            $todo = Todo::create([
                'title' => $request->title,
                'tuid' => Str::uuid()->toString(),
                'status' => $request->status,
            ]);
            return $this->successResponse(['Todo store successfully done'], new TodoResource($todo));
        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return $this->exceptionResponse(['Unable to store todo! please try again later']);
        }
    }

    /**
     * show a todo from the todo list.
     *
     * @param string $tuid
     * @return JsonResponse
     */
    public function show(string $tuid): JsonResponse
    {
        try {
            $todo = Todo::where('tuid', $tuid)->first();
            return $this->successResponse(['Todo retrieve successfully done'], new TodoResource($todo));
        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return $this->exceptionResponse(['Unable to store todo! please try again later']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTodoRequest $request
     * @param string $tuid
     * @return JsonResponse
     */
    public function update(UpdateTodoRequest $request, string $tuid): JsonResponse
    {
        try {
            $todo = Todo::where('tuid', $tuid)->first();
            $todo->update([
                'title' => $request->title,
                'status' => $request->status,
            ]);
            return $this->successResponse(['Todo update successfully done'], new TodoResource($todo));
        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return $this->invalidResponse(['Unable to update todo! please try again later']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $tuid
     * @return JsonResponse
     */
    public function destroy(string $tuid): JsonResponse
    {
        try {
            $todo = Todo::where('tuid', $tuid)->firstOrFail();
            $todo->delete();
            return $this->successResponse(['Todo delete successfully done']);
        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return $this->exceptionResponse(['Unable to delete todo! please try again later']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $tuid
     * @return JsonResponse
     */
    public function updateStatus(string $tuid): JsonResponse
    {
        try {
            $todo = Todo::where('tuid', $tuid)->firstOrFail();
            $todo->update([
                'status' => !$todo->status,
            ]);
            return $this->successResponse(['Todo status update successfully done'], new TodoResource($todo));
        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return $this->exceptionResponse(['Unable to todo status update! please try again later']);
        }
    }
}
