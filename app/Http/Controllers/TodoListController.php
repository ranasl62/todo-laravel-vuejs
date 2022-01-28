<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoListRequest;
use App\Http\Requests\UpdateTodoListRequest;
use App\Models\Todo;
use App\Traits\APIResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoListController extends Controller
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

            return $this->successResponse(['Todo list retrieve successfully done'], Todo::paginate(10));

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
     * @param StoreTodoListRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoListRequest $request)
    {
        try {

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Todo $todoList
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
     * @param \App\Models\Todo $todoList
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
     * @param \App\Http\Requests\UpdateTodoListRequest $request
     * @param \App\Models\Todo $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoListRequest $request, Todo $todoList)
    {
        try {

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Todo $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todoList)
    {
        try {

        } catch (\Exception $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
        }
    }
}
