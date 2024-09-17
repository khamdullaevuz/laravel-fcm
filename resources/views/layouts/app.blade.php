<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script type="module">
            import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js";
            import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-messaging.js";

            const firebaseConfig = {
                apiKey: "{{ firebase_config()['apiKey'] }}",
                authDomain: "{{ firebase_config()['authDomain'] }}",
                projectId: "{{ firebase_config()['projectId'] }}",
                storageBucket: "{{ firebase_config()['storageBucket'] }}",
                messagingSenderId: "{{ firebase_config()['messagingSenderId'] }}",
                appId: "{{ firebase_config()['appId'] }}",
                measurementId: "{{ firebase_config()['measurementId'] }}"
            };

            const app = initializeApp(firebaseConfig);
            const messaging = getMessaging(app);

            navigator.serviceWorker.register("sw.js").then(registration => {
                getToken(messaging, {
                    serviceWorkerRegistration: registration,
                    vapidKey: "{{ firebase_config()['vapidKey'] }}"
                }).then((currentToken) => {
                    if (currentToken) {
                        const xhr = new XMLHttpRequest();
                        const url = '{{route('profile.fcm-update')}}'; // Replace with your server endpoint
                        xhr.open("PUT", url, true);
                        xhr.setRequestHeader("Content-Type", "application/json");
                        xhr.setRequestHeader("X-CSRF-Token", '{{ csrf_token() }}');

                        // Prepare the data
                        const data = JSON.stringify({
                            fcm_token: currentToken,
                        });

                        // Send the request
                        xhr.send(data);
                    } else {
                        // Show permission request UI
                        console.log('No registration token available. Request permission to generate one.');
                        // ...
                    }
                }).catch((err) => {
                    console.log('An error occurred while retrieving token. ', err);
                    // ...
                });
            })
        </script>
    </body>
</html>
