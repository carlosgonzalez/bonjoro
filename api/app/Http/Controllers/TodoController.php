<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Http\Requests\UploadVideoRequest;
use App\Service\TodoService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TodoController extends Controller
{
    private $todoService;
    public function __construct(TodoService $todoService) {
        $this->todoService = $todoService;
    }

    public function add(TodoRequest $request){
        $id = $this->todoService->addTodo($request->title, $request->recipient);
        return response()->json(compact('id'));
    }

    public function getAll(){
        $data = $this->todoService->getAll();
        return response()->json(compact('data'));
    }

    public function get(Request $request){
        try {
            $data = $this->todoService->getTodo($request->route('id'));
        }catch (ModelNotFoundException $e){
            throw new NotFoundHttpException();
        }
        return response()->json(compact('data'));
    }

    public function delete(Request $request){
        $success = (boolean)$this->todoService->deleteTodo($request->route('id'));
        return response()->json(compact('success'));
    }

    public function uploadVideo(UploadVideoRequest $request){
        $data = $this->todoService->uploadVideo($request);
        return response()->json(compact('data'));
    }

    public function update(Request $request){
        $data = $this->todoService->updateTodo($request);
        return response()->json(compact('data'));
    }
}
