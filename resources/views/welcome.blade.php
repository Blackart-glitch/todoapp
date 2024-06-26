<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasker Bot</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        .dark-mode {
            background-color: #1a202c;
            color: #cbd5e0;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 dark-mode">
    <header class="bg-blue-600 text-white py-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">Tasker Bot</h1>
            <nav>
                <a href="#features" class="text-white px-4">Features</a>
                <a href="#about" class="text-white px-4">About</a>
                <a href="#contact" class="text-white px-4">Contact</a>
                <a href="{{ route('login') }}" class="text-white px-4">Login</a>
                <a href="{{ route('register') }}" class="text-white px-4">Sign Up</a>
                <button id="dark-mode-toggle" class="text-white px-4">Toggle Dark Mode</button>
            </nav>
        </div>
    </header>

    <main class="container mx-auto my-10">
        <section class="text-center mb-10">
            <h2 class="text-4xl font-bold mb-4">Welcome to Tasker Bot</h2>
            <p class="text-xl">Your ultimate task management solution.</p>
        </section>

        <section id="features" class="mb-10">
            <h3 class="text-3xl font-bold mb-6">Features</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg dark-mode">
                    <h4 class="text-xl font-bold mb-2">Easy Task Management</h4>
                    <p>Manage your tasks effortlessly with an intuitive and user-friendly interface.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg dark-mode">
                    <h4 class="text-xl font-bold mb-2">Sub-task Support</h4>
                    <p>Break down your tasks into smaller, manageable sub-tasks.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg dark-mode">
                    <h4 class="text-xl font-bold mb-2">Priority Levels</h4>
                    <p>Set priority levels to ensure important tasks get the attention they deserve.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg dark-mode">
                    <h4 class="text-xl font-bold mb-2">Due Date Tracking</h4>
                    <p>Keep track of your deadlines with due date reminders.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg dark-mode">
                    <h4 class="text-xl font-bold mb-2">Collaboration</h4>
                    <p>Collaborate with others by sharing tasks and tracking progress together.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg dark-mode">
                    <h4 class="text-xl font-bold mb-2">Open Source</h4>
                    <p>Tasker Bot is open-sourced and available for everyone to contribute on GitHub.</p>
                </div>
            </div>
        </section>

        <section id="about" class="mb-10">
            <h3 class="text-3xl font-bold mb-6">About Tasker Bot</h3>
            <p>Tasker Bot is an implementation of the Tasker Bot API found on the GitHub profile of <a
                    href="https://github.com/Blackart-glitch" class="text-blue-600">Blackart-glitch</a>. It is a
                comprehensive task management solution designed to help you stay organized and productive. The project
                is open source, and everyone is welcome to contribute. Check out the project repository <a
                    href="https://github.com/Blackart-glitch/taskapi" class="text-blue-600">here</a>.</p>
            <img src="https://via.placeholder.com/600x400" alt="Illustration" class="my-6 mx-auto">
        </section>

        <section id="contact" class="mb-10">
            <h3 class="text-3xl font-bold mb-6">Contact Us</h3>
            <p>If you have any questions or feedback, feel free to reach out!</p>
            <form class="bg-white p-6 rounded-lg shadow-lg mt-6 dark-mode">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" id="name" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" id="email" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 dark:text-gray-300">Message</label>
                    <textarea id="message" class="w-full px-4 py-2 border rounded-lg"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Send</button>
            </form>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Tasker Bot. All rights reserved. | Created by <a href="https://github.com/Blackart-glitch"
                    class="text-blue-400">Blackart-glitch</a></p>
        </div>
    </footer>

    <script>
        const toggleButton = document.getElementById('dark-mode-toggle');
        const body = document.body;

        toggleButton.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
        });
    </script>
</body>

</html>
