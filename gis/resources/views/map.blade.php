<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ Vite::asset('resources/images/favicon.png') }}" type="image/png">
        <meta property="og:url" content="https://gis.cantagalo.it">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Cantagalo.it - GIS EXAMPLE">
        <meta property="og:description" content="Look at this GIS EXAMPLE I created for demonstration">
        <meta property="og:image" content="{{ Vite::asset('resources/images/OGbw.png') }}">
        <meta name="csrf-token" content="{{ csrf_token(); }}">
        <title>Cantagalo.it - GIS EXAMPLE</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header class="flex flex-wrap justify-between items-center px-6 py-4 bg-white shadow">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 max-w-[250px] sm:max-w-none">
                Michel Cantagalo
            </h1>
            <p class="text lg:mr-[35vw] text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 max-w-[250px] sm:max-w-none">
                <span class="text__first">
                    <span class="text__word">
                        - fullstack dev
                    </span>
                    <span class="text__first-bg"></span>
                </span>
                <br>
                <span class="text__second">
                    <span class="text__word">
                        - web project manager
                    </span>
                    <span class="text__second-bg"></span>
                </span>
            </p>
        </header>
        <main class="w-full min-h-screen bg-gray-50 flex items-start justify-center p-4">
            <div class="flex flex-col md:flex-row gap-4 w-full max-w-7xl">
                <!-- Mapa -->
                <div id="map"
                class="w-full md:w-2/3 h-[400px] md:h-[600px] border border-gray-300 rounded-2xl shadow-sm overflow-hidden">
                </div>

                <!-- Painel lateral -->
                <aside
                class="w-full md:w-1/3 bg-white border border-gray-200 rounded-2xl shadow-sm p-4 flex flex-col justify-start">
                <h3 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-1">Options</h3>

                <div class="flex items-center gap-2 mb-3">
                    <input type="checkbox" id="cluster" class="w-4 h-4 text-blue-600 rounded">
                    <label for="cluster" class="text-sm text-gray-700">Clustering</label>
                </div>

                <div class="flex gap-2 mb-5">
                    <button onclick="loadData()"
                    class="flex-1 bg-blue-600 text-white font-medium px-3 py-2 rounded-lg hover:bg-blue-700 transition">
                    Update
                    </button>
                    <button onclick="locateUser()"
                    class="flex-1 bg-green-600 text-white font-medium px-3 py-2 rounded-lg hover:bg-green-700 transition">
                    Where I am?
                    </button>
                </div>

                <h3 class="text-xl font-semibold text-gray-800 mb-3 border-b pb-1">Dashboard</h3>
                <p class="text-sm text-gray-600 mb-2">
                    Total: <span id="total-count" class="font-bold text-gray-900">—</span>
                </p>

                <ul id="categories-list" class="space-y-1 text-sm text-gray-700 cursor-pointer">
                    <!-- Itens são inseridos dinamicamente -->
                </ul>

                <!-- Rodapé opcional -->
                <div class="mt-auto pt-4 text-xs text-gray-500 border-t">
                    <p>Example GIS in Laravel + Leaflet</p>
                </div>
                </aside>
            </div>
        </main>
        <footer class="w-full py-4 bg-gray-100 text-center text-sm text-gray-600">
            <a href="https://cantagalo.it/legal" 
            class="hover:text-gray-800 hover:font-medium transition">
                'Terms of use and privacy policy'
            </a>
        </footer>
    </body>
</html>