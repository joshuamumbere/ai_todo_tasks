<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <h1 class="text-2xl font-bold mb-4">AI-Powered To-Do List</h1>

    <input type="text" wire:model="title" placeholder="Task title" class="p-2 border">
    <input type="text" wire:model="description" placeholder="Description" class="p-2 border">
    <select wire:model="priority" class="p-2 border">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
    </select>
    <input type="datetime-local" wire:model="due_date" class="p-2 border">
    <button wire:click="suggestPriority" class="bg-yellow-500 text-white px-4 py-2">Suggest Priority</button>
    <button wire:click="createTask" class="bg-blue-500 text-white px-4 py-2">Add Task</button>

    <ul>
        @foreach($tasks as $task)
            <li class="p-2 border-b">
                <span class="font-bold">{{ $task->title }}</span> - {{ $task->priority }}
                @if (!$task->completed)
                    <button wire:click="markCompleted({{ $task->id }})" class="bg-green-500 text-white px-2 py-1">✔ Done</button>
                @endif
            </li>
        @endforeach
    </ul>


</div>
