<?php

namespace App\Service;

use App\Mapper\TodoMap;
use App\Interfaces\Service\ITodoService;
use App\Repository\TodoRepository;
use Illuminate\Support\Collection;
use App\Http\Requests\UploadVideoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TodoService implements ITodoService
{

    private $todoRepository;

    function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    function addTodo($title, $recipient): string
    {
        $todo = new TodoMap();
        $todo->setTitle($title);
        $todo->setRecipient($recipient);
        $todo->setStatus('Not Completed');
        $todo->setVideoName('');
        $todo->setVideoWatched(false);

        return $this->todoRepository->addTodo($todo);
    }

    function getAll(): Collection
    {
        return $this->todoRepository->getAll();
    }

    function getTodo($id)
    {
        try{
            return $this->todoRepository->getTodo($id);
        } catch(ModelNotFoundException $e){
            throw new ModelNotFoundException('Resource not found');
        }
    }

    function deleteTodo($id)
    {
        return $this->todoRepository->deleteTodo($id);
    }

    function uploadVideo(UploadVideoRequest $request)
    {
        $filename = $this->getRandomString() . '.mp4';
        $request->file('video')->storeAs('public/videos', $filename);
        $this->todoRepository->updateTodo($request->route('id'), ['video_name' => $filename, 'status' => 'Completed']);
        return ['video_name' => $filename];
    }

    private function getRandomString($length = 8): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    function updateTodo(Request $request)
    {
        return $this->todoRepository->updateTodo($request->route('id'), json_decode($request->getContent(), true));
    }
}
