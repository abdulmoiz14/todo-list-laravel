<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('To-Do List') }}
        </h2>
    </x-slot>

    <!-- <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold mb-4">To-Do List</h1>
                </div>
            </div>
        </div>
    </div> -->

    <div class="py-1 pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 pb-0"><h1 class="text-2xl font-bold text-black dark:text-white">Create New Task</h1></div>
                <div class="text-red-400 dark:text-gray-400 p-2 pb-0 text-right">Text with asterisks (*) are important</div>
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="p-4 mr-80 ml-80">
                         <!-- Success Messages -->
                         @if (session('success'))
                            <div x-data="{ show: true }" x-show="show" class="bg-green-100 text-green-700 p-4 mb-4 rounded relative">
                                <button @click="show = false" class="absolute top-1 right-2 text-green-700 font-bold">
                                    &times;
                                </button>
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Handler message -->
                        @if (session('error'))
                            <div x-data="{ show: true }" x-show="show" class="bg-red-200 text-red-600 p-4 mb-4 rounded relative">
                                <button @click="show = false" class="absolute top-1 right-2 text-red-600 font-bold">
                                    &times;
                                </button>
                                {{ session('error') }}
                            </div>
                        @endif


                         <!-- Error Messages -->
                         @if ($errors->any())
                            <div x-data="{ show: true }" x-show="show" class="bg-red-200 text-red-600 p-4 mb-4 rounded relative">
                                <button @click="show = false" class="absolute top-1 right-2 text-red-600 font-bold">
                                    &times;
                                </button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Task Creation Form -->
                        <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
                            @csrf
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Task title *" class="p-2 w-full border rounded mb-2 dark:text-gray-800">
                            <textarea name="description" placeholder="Task description *" class="p-2 w-full border rounded mb-2 dark:text-gray-800">{{ old('description') }}</textarea>
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add Task</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="py-1 pb-6 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6"><h1 class="text-2xl font-bold text-black dark:text-white">List of all task</h1></div>
                <hr />
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Task Listing -->
                        @if(count($tasks) > 0)
                            @foreach ($tasks as $task)
                                <table class="hover:table-fixed">
                                    <tbody>
                                        <tr>
                                            <td class="w-full text-left py-2 px-2">
                                                <div class="content-left">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 border-gray-300 rounded" onchange="event.preventDefault(); document.getElementById('complete-form-{{ $task->id }}').submit();" {{ $task->is_completed ? 'checked' : '' }}>
                                                    <span class="{{ $task->is_completed ? 'line-through' : '' }} text-xl font-bold p-2 text-black dark:text-white">{!! $task->title !!}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="content-right">
                                                    <form id="complete-form-{{ $task->id }}" action="{{ route('tasks.update', $task) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                    <button onclick="openModal(this)" data-id="{{ $task->id  }}"  class="bg-red-500 text-white px-4 py-2 rounded">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            <table class="hover:table-fixed">
                                <tbody>
                                    <tr>
                                        <td class="w-full py-2 px-2 text-center text-red-500">
                                            No Record Found !
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Modal For Delete -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-auto">
            <!-- Modal Header -->
            <h2 class="text-lg font-semibold text-gray-800">Confirm Deletion</h2>
            <p class="text-gray-600 mt-2">Are you sure you want to delete this item? This action cannot be undone.</p>

            <!-- Modal Actions -->
            <div class="flex justify-end mt-4 space-x-2">
                <button onclick="closeModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                    Cancel
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<!-- Tailwind JavaScript for Modal Toggle -->
<script>
    function openModal(button) {
        // Get task ID from data attribute
        const taskId = button.getAttribute('data-id');

        // Construct the route URL using the task ID
        const actionUrl = `/tasks/${taskId}`;

        // Set the action attribute of the form
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = actionUrl;

        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
    }
</script>
