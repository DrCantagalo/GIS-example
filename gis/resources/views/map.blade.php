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
        <main>
            <div style="display:flex; gap:16px;">
                <div id="map" style="width:70%; height:600px; border:1px solid #ccc;"></div>
                <aside style="width:30%;">
                    <h3>Options</h3>
                    <input type="checkbox" id="cluster"><label for="cluster">Clustering?</label>
                    <button onclick="loadData()">Run</button>
                    <button onclick="locateUser()">Where I am?</button>
                    <h3>Dashboard</h3>
                    <p>Total: <span id="total-count">—</span></p>
                    <ul id="categories-list"></ul>
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