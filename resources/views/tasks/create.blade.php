<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Tasks') }}
        </h2>
    </x-slot>
    <div class="flex align-center justify-center">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                {{-- Step 1: Task Details --}}
                <div class="step" id="step1">
                    <div class="border border-blue-500 p-4 rounded mb-4">
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                required />
                        </div>

                        <div class="mt-4 flex center justify-between">
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker datepicker-buttons datepicker-autoselect-today type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" name="due_date" id="date">
                            </div>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="time"
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    min="09:00" max="18:00" value="00:00" name="time" required />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <x-secondary-button type="button" onclick="nextStep(2)">
                            Next
                        </x-secondary-button>
                    </div>
                </div>

                {{-- Step 2: Add Sub-tasks --}}
                <div class="step" id="step2" style="display: none;">
                    <div class="border border-green-500 p-4 rounded mb-4">
                        <div>
                            <x-input-label for="priority" :value="__('Priority')" />
                            <select id="priority" name="priority"
                                class="bg-gray-100 focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal">
                                <option value="" disabled selected>Select a priority</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="sub_tasks" :value="__('Would you like to add sub tasks?')" />
                            <select id="sub_tasks" name="sub_tasks"
                                class="bg-gray-100 focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal">
                                <option value="" disabled selected>Select an option</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <x-secondary-button type="button" onclick="prevStep(1)">
                            Back
                        </x-secondary-button>
                        <x-secondary-button type="button" id="nextToSubtasks" style="display: none;"
                            onclick="nextStep(3)">
                            Next
                        </x-secondary-button>
                        <x-primary-button type="submit" id="submitBtn" style="display: none;">
                            Submit
                        </x-primary-button>
                    </div>
                </div>

                {{-- Step 3: Sub-tasks --}}
                <div class="step" id="step3" style="display: none;">
                    <div class="border border-yellow-500 p-4 rounded mb-4">
                        <div class="flex justify-between items-center mb-4">
                            <div>Add more sub tasks</div>
                            <div class="add_more_subs cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="20px" height="20px"
                                    viewBox="0 0 38.342 38.342">
                                    <path
                                        d="M19.171,0C8.6,0,0,8.6,0,19.171C0,29.74,8.6,38.342,19.171,38.342c10.569,0,19.171-8.602,19.171-19.171C38.342,8.6,29.74,0,19.171,0z M19.171,34.341C10.806,34.341,4,27.533,4,19.17c0-8.365,6.806-15.171,15.171-15.171s15.171,6.806,15.171,15.171C34.342,27.533,27.536,34.341,19.171,34.341z M30.855,19.171c0,1.656-1.344,3-3,3h-5.685v5.685c0,1.655-1.345,3-3,3c-1.657,0-3-1.345-3-3v-5.685h-5.684c-1.657,0-3-1.344-3-3c0-1.657,1.343-3,3-3h5.684v-5.683c0-1.657,1.343-3,3-3c1.655,0,3,1.343,3,3v5.683h5.685C29.512,16.171,30.855,17.514,30.855,19.171z" />
                                </svg>
                            </div>
                        </div>

                        <div class="subtasks">
                            <div class="mb-4 border-dotted border-2 border-gray-300 p-3">
                                <span>Task 1</span>
                                <x-text-input class="block mt-1 w-full" type="text" name="subtasks[]"
                                    placeholder="Enter a short description" />
                                <span class="task-input-del cursor-pointer text-red-500 mt-2 inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12C21 17.5228 16.5228 22 11 22C5.47715 22 1 17.5228 1 12C1 6.47715 5.47715 2 11 2C16.5228 2 21 6.47715 21 12Z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <x-secondary-button type="button" onclick="prevStep(2)">
                            Back
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            Submit
                        </x-primary-button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Restrict past dates
            const dateInput = document.getElementById('date');
            if (dateInput) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.setAttribute('min', today);
            }

            // Handle subtask visibility
            const subTasksSelect = document.getElementById('sub_tasks');
            const nextToSubtasks = document.getElementById('nextToSubtasks');
            const submitBtn = document.getElementById('submitBtn');

            subTasksSelect.addEventListener('change', function() {
                if (this.value === 'yes') {
                    nextToSubtasks.style.display = 'inline-block';
                    submitBtn.style.display = 'none';
                } else if (this.value === 'no') {
                    nextToSubtasks.style.display = 'none';
                    submitBtn.style.display = 'inline-block';
                }
            });

            // Add more sub tasks
            document.querySelector('.add_more_subs').addEventListener('click', function() {
                const subtasks = document.querySelector('.subtasks');
                const subtask = subtasks.firstElementChild.cloneNode(true);
                const count = subtasks.children.length + 1;
                subtask.querySelector('span').innerText = 'Task ' + count;
                subtask.querySelector('input').value = '';
                subtasks.appendChild(subtask);

                // Re-bind delete event to new delete buttons
                bindDeleteButtons();
            });

            // Bind delete button events
            function bindDeleteButtons() {
                document.querySelectorAll('.task-input-del').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('.mb-4').remove();
                    });
                });
            }

            // Initial binding of delete buttons
            bindDeleteButtons();
        });

        function nextStep(step) {
            document.querySelectorAll('.step').forEach(function(stepDiv) {
                stepDiv.style.display = 'none';
            });
            document.getElementById('step' + step).style.display = 'block';
        }

        function prevStep(step) {
            document.querySelectorAll('.step').forEach(function(stepDiv) {
                stepDiv.style.display = 'none';
            });
            document.getElementById('step' + step).style.display = 'block';
        }
    </script>
</x-app-layout>
