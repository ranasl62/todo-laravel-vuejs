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

            return $this->successResponse(['Todo list retrieve successfully done'], Todo::select('title', 'status', 'tuid')->paginate(10));

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return $this->invalidResponse(['Something went wrong! please try again later']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTodoRequest $request
     * @return JsonResponse
     */
    public function store(StoreTodoRequest $request)
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
     * Display the specified resource.
     *
     * @param Todo $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todoList)
    {
        try {

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Todo $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todoList)
    {
        try {

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTodoRequest $request
     * @param Todo $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, Todo $todoList)
    {
        try {

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todoList
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $todoList = Todo::findOrFail($id);
            $todoList->delete();
            return $this->successResponse(['Todo delete successfully done']);
        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return $this->exceptionResponse(['Unable to delete todo! please try again later']);
        }
    }
}
