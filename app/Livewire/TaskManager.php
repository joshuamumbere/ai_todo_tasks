<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Http;

class TaskManager extends Component
{

    public $title, $description, $priority = 'medium', $due_date;
    public $tasks;

    public function mount()
    {
        // $this->tasks = Task::all();
        $this->tasks = Task::orderBy('priority', 'desc')->get();
    }

    public function createTask()
    {
        $this->validate([
            'title' => 'required',
            'priority' => 'required'
        ]);

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'due_date' => $this->due_date
        ]);

        $this->reset();
        $this->tasks = Task::orderBy('priority', 'desc')->get();
    }

    public function markCompleted($taskId)
    {
        $task = Task::find($taskId);
        $task->update(['completed' => true]);
        $this->tasks = Task::orderBy('priority', 'desc')->get();
    }

    public function suggestPriority()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/completions', [
            'model' => 'text-davinci-003',
            'prompt' => "Based on this task description: '{$this->title} - {$this->description}', suggest a priority (low, medium, high).",
            'max_tokens' => 10
        ]);

        $data = $response->json(); // Convert response to array

        // ✅ Check if 'choices' key exists before accessing it
        if (isset($data['choices']) && count($data['choices']) > 0) {
            $this->priority = strtolower(trim($data['choices'][0]['text']));
        } else {
            // Log error and set a default priority if response is invalid
            \Log::error('OpenAI API response error', ['response' => $data]);
            $this->priority = 'medium'; // Default priority
        }
    }


    public function render()
    {
        return view('livewire.task-manager' ,['tasks'=> $this->tasks]);
    }
}
