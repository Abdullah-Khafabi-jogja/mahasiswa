<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100">

    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-gray-300">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">@yield('title')</h1>
                    @if(!in_array(request()->route()->getName(), ['mahasiswa.create', 'mahasiswa.edit']))
                        @if(request()->has('search'))
                            <a href="{{ route('mahasiswa.index') }}" class="text-gray-500 hover:text-gray-600">
                                <i class="fas fa-home"></i>
                            </a>
                        @else
                            <form class="flex" method="get" action="{{ route('mahasiswa.index') }}">
                                <div class="relative">
                                    <input type="text" name="search" class="form-input rounded-full py-2 px-4 pr-12" placeholder="Search...">
                                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center justify-center font-bold py-2 px-4 rounded-full">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endif
                </div>
                
            </div>
        </header>

        <div class="mt-3">
            @yield('content')
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
    <div id="alert" class="fixed inset-x-0 top-0 z-50 px-4 py-2 bg-green-500 text-white text-center">
        {{ session('success') }}
    </div>
    <script>
        // Script to remove the alert after 10 seconds
        setTimeout(function() {
            var alertElement = document.getElementById('alert');
            alertElement.remove();
        }, 10000); // 10 seconds
    </script>
    @endif

</body>

</html>
