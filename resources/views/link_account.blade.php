<x-app-layout>
    <div class="container">
        <h1></h1>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Link to Todo API') }}
            </h2>

            {{-- if the account has been linked --}}
            @if (auth()->user()->todo_token)
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Already linked</span>
                    </div>
                </div>
            @else
                <x-secondary-button type="button" onclick="toggleModal()">Link Account</x-secondary-button>
            @endif


            {{-- if errors,  --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- if success --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <span class="font-medium">Success alert!</span> {{ session('success') }}
                </div>
            @endif
        </x-slot>




        <form action="{{ route('link_account.store') }}" method="POST">
            @csrf
            <div id="accountLinkModal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div
                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div
                                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">
                                            Enter Password </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Please enter your password to link your account.
                                            </p>
                                            <input type="password" name="password" id="password"
                                                autocomplete="current-password"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                required />
                                        </div>
                                    </div>


                                </div>
                                <div
                                    class="bg-gray-50 mt-4 px-4 py-3 sm:flex sm:flex-row-reverse flex justify-between sm:px-6">
                                    <x-primary-button type="submit">Link</x-primary-button>
                                    <x-secondary-button type="button"
                                        onclick="toggleModal()">Cancel</x-secondary-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

        <div class="linked-accounts">
            <!-- Display linked accounts here -->
            @if (auth()->user()->todo_token)
                <h2>Linked Accounts</h2>
                <p>Todoist</p>
                <p>Linked</p>
                <a href="#">Unlink</a>
            @else
                <h2>Linked Accounts</h2>
                <p>No linked accounts</p>
            @endif
        </div>

        <script>
            function toggleModal() {
                var modal = document.getElementById('accountLinkModal');
                if (modal.style.display === "none" || modal.style.display === "") {
                    modal.style.display = "block";
                } else {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>
</x-app-layout>
