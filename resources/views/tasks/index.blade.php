<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-4">To-Do List</h1>

        <!-- Success Messages -->
        @if (session('success'))
            <div class="bg-green-100 p-4 mb-4 rounded">{{ session('success') }}</div>
        @endif

        <!-- Task Creation Form -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="text" name="title" placeholder="Task title" class="p-2 w-full border rounded mb-2" required>
            <textarea name="description" placeholder="Task description" class="p-2 w-full border rounded mb-2"></textarea>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add Task</button>
        </form>
        @if ($errors->any())
            <div class="bg-red-100 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Task List -->
        <ul class="space-y-2">
            @foreach ($tasks as $task)
                <li class="flex items-center justify-between bg-white p-4 rounded shadow">
                    <div>
                        <input type="checkbox" onchange="event.preventDefault(); document.getElementById('complete-form-{{ $task->id }}').submit();" {{ $task->is_completed ? 'checked' : '' }}>
                        <span class="{{ $task->is_completed ? 'line-through' : '' }}">{{ $task->title }}</span>
                    </div>
                    <form id="complete-form-{{ $task->id }}" action="{{ route('tasks.update', $task) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PATCH')
                    </form>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
