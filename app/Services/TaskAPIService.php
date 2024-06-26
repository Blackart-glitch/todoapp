<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class TaskApiService
{
    protected $baseUrl;
    protected $httpClient;

    public function __construct()
    {
        $this->baseUrl = config('todo_api.url');
    }

    public function getTodos($id = null)
    {
        if ($id) {
            $response = Http::withOptions([
                'verify' => false,
            ])->withToken(auth()->user()->todo_token)
                ->get($this->baseUrl . "/todos/{$id}");

            return $response->object();
        }

        $response = Http::withOptions([
            'verify' => false,
        ])->withToken(auth()->user()->todo_token)
            ->get($this->baseUrl . '/todos');

        return $response->object();
    }

    public function createTodo($data)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->withToken(auth()->user()->todo_token)
            ->post($this->baseUrl . '/todos', $data);

        return $response->json();
    }

    public function updateTodo($id, $data)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->withToken(auth()->user()->todo_token)
            ->acceptJson()
            ->put($this->baseUrl . "/todos/{$id}", $data);

        return $response->json();
    }

    public function deleteTodo($id)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->withToken(auth()->user()->todo_token)
            ->acceptJson()
            ->delete($this->baseUrl . "/todos/{$id}");
        return $response->json();
    }

    public function addOrUpdateSubtask($id, $data)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->withToken(auth()->user()->todo_token)
            ->acceptJson()
            ->post($this->baseUrl . "/todos/{$id}/subtasks", $data);

        return $response->json();
    }

    public function markSubTaskAsComplete($taskId, $subTaskId)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->withToken(auth()->user()->todo_token)
            ->acceptJson()
            ->put($this->baseUrl . "/todos/{$taskId}/subtasks/{$subTaskId}");

        return $response->json();
    }
}
