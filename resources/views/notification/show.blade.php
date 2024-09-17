<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('notification.send') }}" method="POST">
                        @csrf
                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter the title"
                                required>
                        </div>

                        <!-- Body Field -->
                        <div class="mb-4">
                            <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
                            <textarea
                                id="body"
                                name="body"
                                rows="5"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter the body text"
                                required></textarea>
                        </div>

                        <!-- Click action -->
                        <div class="mb-4">
                            <label for="click_action" class="block text-gray-700 text-sm font-bold mb-2">Click
                                action</label>
                            <input
                                type="text"
                                id="click_action"
                                name="click_action"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter the click action"
                            >
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
