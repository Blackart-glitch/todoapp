<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white   overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white   border-b border-gray-200 dark:border-gray-700">
                    <a href="{{ route('tasks.create') }}">
                        <x-primary-button type="button"> Create a new Task </x-primary-button>
                    </a>
                </div>
                {{-- alert  --}}
                @if (session('message'))
                    <div class="p-6 bg-white   border-b border-gray-200 dark:border-gray-700">

                        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Info alert!</span> {{ session('message') }}
                            </div>
                        </div>

                    </div>
                @endif
                {{-- Due today --}}
                <div class="">
                    @if ($today_tasks)
                        @foreach ($today_tasks as $title)
                            <div class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                                role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">Warning alert!</span> "{{ $title }}" is due today,
                                    you better get it done!
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        {{-- tasks list --}}
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="   overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="grid grid-cols-1 bg-gray-400 md:grid-cols-2 lg:grid-cols-3 gap-4 p-6">

                        @if (!empty($tasks))
                            @foreach ($tasks as $task)
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg max-w-xs mx-auto">
                                    <div class="p-6 bg-white">
                                        <div class="flex justify-between items-center mb-4">
                                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                                <span class="text-blue-800">{{ $task->title }}</span>
                                            </h2>
                                            <div class="flex center">
                                                <span onclick="deleteTask('{{ $task->_id }}')">
                                                    <svg class="w-6 h-6 hover:text-red-500 text-gray-800 dark:text-white cursor-pointer"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                    </svg>
                                                </span>
                                                <span
                                                    class="edit_task cursor-pointer text-blue-700 hover:text-blue-800 dark:text-blue-600 dark:hover:text-blue-700 cursor-pointer"
                                                    onclick="openModal('{{ $task->_id }}')">
                                                    <svg class="w-6 h-6" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 flex items-center">
                                            <svg class="w-6 h-6 mr-2" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M7.556 8.5h8m-8 3.5H12m7.111-7H4.89a.896.896 0 0 0-.629.256.868.868 0 0 0-.26.619v9.25c0 .232.094.455.26.619A.896.896 0 0 0 4.89 16H9l3 4 3-4h4.111a.896.896 0 0 0 .629-.256.868.868 0 0 0 .26-.619v-9.25a.868.868 0 0 0-.26-.619.896.896 0 0 0-.63-.256Z" />
                                            </svg>
                                            Descr:
                                        </p>
                                        <span
                                            class="text-grey-300 border-1 border-grey-100">{{ $task->description }}</span>

                                        <p class="text-gray-500 dark:text-gray-400">Due: <span
                                                class="text-red-600">{{ $task->due_date }}</span></p>
                                        <p class="">Priority: <span
                                                class="
                                            @if ($task->priority == 'low') text-white-500 bg-green-500 hover:bg-green-700

                                            @elseif($task->priority == 'medium')
                                                text-white-500 bg-yellow-500 hover:bg-yellow-700
                                            @elseif($task->priority == 'high')
                                                text-white-500 bg-red-500 hover:bg-red-700
                                            @else
                                                text-white-500 bg-gray-500 hover:bg-gray-700 @endif
                                            p-y-3 p-x-3 ">{{ $task->priority }}</span>
                                        </p>
                                        <div class="flex center justify-between">
                                            <p class="text-orange-800 dark:text-gray-400">Sub-tasks:</p>

                                            <div class="flex center">
                                                <span class="subtasks_edit"
                                                    onclick="openSubtaskModal('{{ $task->_id }}')">
                                                    <svg class="w-6 h-6 text-gray-800 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <ul class="list-disc list-inside">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @if ($task->subtasks)
                                                @foreach ($task->subtasks as $subtask)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <li class="flex items-center justify-between">
                                                        <span class="flex items-center">
                                                            <svg class="w-6 h-6 mr-2" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" fill="none" viewBox="0 0 24 24">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M16.153 19 21 12l-4.847-7H3l4.848 7L3 19h13.153Z" />
                                                            </svg>
                                                            <span class="text-grey-800">{{ $subtask->title }}</span>
                                                        </span>
                                                        <span
                                                            class="edit_subtask hover:text-blue-800 dark:text-blue-600 dark:hover:text-blue-700 ml-auto cursor-pointer"
                                                            style="cursor: pointer;"{{ $subtask->completed ? 'onclick="openSubtaskModal(\'' . $subtask->_id . '\')"' : '' }}>
                                                            @if ($subtask->completed)
                                                                <svg class="w-6 h-6 text-green-600 dark:text-white"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" fill="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path fill-rule="evenodd"
                                                                        d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            @else
                                                                <svg class="w-6 h-6 edit_subtask hover:text-blue-800 dark:text-blue-600 text-gray-800 dark:text-white"
                                                                    onclick="markAsCompleted('{{ $task->_id }}', '{{ $subtask->_id }}')"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M12 21a9 9 0 1 1 0-18c1.052 0 2.062.18 3 .512M7 9.577l3.923 3.923 8.5-8.5M17 14v6m-3-3h6" />
                                                                </svg>
                                                            @endif
                                                        </span>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="flex items center justify-between">
                                                    <span class="text-grey-800">No subtasks found</span>
                                                </li>
                                            @endif
                                        </ul>
                                        <div class="flex center justify-between mt-4">
                                            @if ($task->completed == false)
                                                <button onclick="markAsCompleted('{{ $task->_id }}')"
                                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                    Mark as Completed
                                                </button>
                                            @else
                                                <button
                                                    class="bg-green-500 flex center hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                                    disabled>
                                                    <svg class="w-[23px] h-[23px] text-gray-800 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="1.6"
                                                            d="m8.032 12 1.984 1.984 4.96-4.96m4.55 5.272.893-.893a1.984 1.984 0 0 0 0-2.806l-.893-.893a1.984 1.984 0 0 1-.581-1.403V7.04a1.984 1.984 0 0 0-1.984-1.984h-1.262a1.983 1.983 0 0 1-1.403-.581l-.893-.893a1.984 1.984 0 0 0-2.806 0l-.893.893a1.984 1.984 0 0 1-1.403.581H7.04A1.984 1.984 0 0 0 5.055 7.04v1.262c0 .527-.209 1.031-.581 1.403l-.893.893a1.984 1.984 0 0 0 0 2.806l.893.893c.372.372.581.876.581 1.403v1.262a1.984 1.984 0 0 0 1.984 1.984h1.262c.527 0 1.031.209 1.403.581l.893.893a1.984 1.984 0 0 0 2.806 0l.893-.893a1.985 1.985 0 0 1 1.403-.581h1.262a1.984 1.984 0 0 0 1.984-1.984V15.7c0-.527.209-1.031.581-1.403Z" />
                                                    </svg>

                                                    Completed
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Task Edit Modal -->
                                <div id="taskEditModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                    <div
                                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                        <div
                                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit
                                                            Task
                                                        </h3>
                                                        <div class="mt-2">
                                                            <form id="taskEditForm">
                                                                @csrf
                                                                <input type="hidden" name="task_id" id="task_id">
                                                                <div>
                                                                    <label for="task_title"
                                                                        class="block text-sm font-medium text-gray-700">Title</label>
                                                                    <input type="text" name="task_title"
                                                                        id="task_title"
                                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                                                </div>
                                                                <div class="mt-4">
                                                                    <label for="task_description"
                                                                        class="block text-sm font-medium text-gray-700">Description</label>
                                                                    <textarea name="task_description" id="task_description"
                                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm"></textarea>
                                                                </div>
                                                                <div class="mt-4 flex center justify-between">
                                                                    <div class="relative max-w-sm">
                                                                        <div
                                                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                                                aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="currentColor"
                                                                                viewBox="0 0 20 20">
                                                                                <path
                                                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                                            </svg>
                                                                        </div>
                                                                        <input datepicker datepicker-buttons
                                                                            datepicker-autoselect-today type="text"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            placeholder="Select date"
                                                                            name="task_due_date" id="task_due_date">
                                                                    </div>
                                                                    <div class="relative">
                                                                        <div
                                                                            class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                                                aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="currentColor"
                                                                                viewBox="0 0 24 24">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </div>
                                                                        <input type="time" id="task_due_time"
                                                                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            min="09:00" max="18:00"
                                                                            value="00:00" name="task_due_time"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-4">
                                                                    <x-input-label for="priority" :value="__('Priority')" />
                                                                    <select name="task_priority" id="task_priority"
                                                                        class="bg-gray-100 focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal">
                                                                        <option value="" disabled selected>Select
                                                                            a
                                                                            priority
                                                                        </option>
                                                                        <option value="low">Low</option>
                                                                        <option value="medium">Medium</option>
                                                                        <option value="high">High</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mt-4">
                                                                    <x-primary-button> Save </x-primary-button>
                                                                    <x-secondary-button
                                                                        onclick="closeModal('taskEditModal')">
                                                                        Cancel
                                                                    </x-secondary-button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Subtask Edit Modal -->
                                <div id="subtaskEditModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                    <div
                                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                        <div
                                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit
                                                            Subtask</h3>
                                                        <div class="mt-2">
                                                            <form id="subtaskEditForm" method="POST"
                                                                action="{{ route('subtasks.push', ['task' => $task->_id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="taskid" id="task">

                                                                <div class="border border-yellow-500 p-4 rounded mb-4">
                                                                    <div
                                                                        class="mb-4 border-dotted border-2 border-gray-300 p-3">
                                                                        <span>Task </span>
                                                                        <x-text-input class="block mt-1 w-full"
                                                                            type="text" name="title"
                                                                            id="subtask_title"
                                                                            placeholder="Lets keep it short" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-4">
                                                                    <button type="submit"
                                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                                        Save
                                                                    </button>
                                                                    <button type="button"
                                                                        onclick="closeModal('subtaskEditModal')"
                                                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <a href="#"
                                class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                    src="https://flowbite.com/docs/images/blog/image-4.jpg" alt="">
                                <div class="flex flex-col justify-between p-4 leading-normal">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Uh Oh</h5>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Looks like your task
                                        list is as empty as a desert. Time to get cracking and add some tasks!</p>
                                </div>
                            </a>

                    </div>
                    @endif
                </div>
            </div>
        </div>
        <script>
            function formatDate(dateString) {
                const date = new Date(dateString);
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); // months are zero-indexed
                const day = String(date.getDate()).padStart(2, '0');

                return `${year}-${month}-${day}`;
            }

            function openModal(taskId) {
                fetch(`/tasks/${taskId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('task_title').value = data.title;
                        document.getElementById('task_id').value = data._id;
                        document.getElementById('task_description').value = data.description;
                        document.getElementById('task_due_date').value = formatDate(data.due_date);
                        document.getElementById('task_priority').value = data.priority;
                        document.getElementById('taskEditModal').classList.remove('hidden');
                    });
            }

            function openSubtaskModal(todoId) {
                fetch(`/tasks/${todoId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('subtask_title').value = data.title;
                        document.getElementById('subtaskEditModal').classList.remove('hidden');
                    });
            }

            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
            }

            document.getElementById('taskEditForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const taskId = document.getElementById('task_id').value;
                const taskData = {
                    title: document.getElementById('task_title').value,
                    description: document.getElementById('task_description').value,
                    due_date: document.getElementById('task_due_date').value,
                    time: document.getElementById('task_due_time').value,
                    priority: document.getElementById('task_priority').value
                };
                fetch(`/tasks/${taskId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(taskData),
                }).then(response => {
                    console.log(response);
                    if (response.ok) {
                        closeModal('taskEditModal');
                        location.reload(); // Reload the page or update the task list dynamically
                    }
                });
            });

            function markAsCompleted(taskId, subtaskId = null) {
                let url = ''; // Use let for block scope
                if (subtaskId) {
                    url =
                        `/tasks/subtasks/${taskId}`; // Corrected endpoint, assuming you meant to use both taskId and subtaskId
                } else {
                    url = `/tasks/${taskId}`;
                }
                fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        completed: true,
                        subtask: subtaskId
                    })
                }).then(response => {
                    if (response.ok) {
                        location.reload(); // Reload the page or update the task list dynamically
                    }
                });
            }

            function deleteTask(taskId) {
                fetch(`/tasks/${taskId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload(); // Reload the page or update the task list dynamically
                    }
                });
            }
        </script>
    </div>
</x-app-layout>
