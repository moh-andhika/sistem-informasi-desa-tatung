<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-slate-50 antialiased dark:bg-slate-900">
    <div class="relative grid h-dvh flex-col items-center justify-center lg:max-w-none lg:grid-cols-2 lg:px-0">
        <!-- Left Side - Government Branding -->
        <div
            class="relative hidden h-full flex-col bg-blue-900 p-10 text-white lg:flex justify-between overflow-hidden">
            <!-- Background Pattern / Overlay -->
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
            </div>
            <div class="absolute inset-0 bg-linear-to-b from-blue-900/80 to-blue-950/90 mix-blend-multiply"></div>

            <div class="relative z-20 flex items-center text-lg font-bold tracking-wider">
                <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo Ponorogo"
                    class="h-12 w-auto me-4" />
                <div class="flex flex-col leading-tight">
                    <span>PEMERINTAH KABUPATEN PONOROGO</span>
                    <span class="text-blue-300 text-sm font-medium">KECAMATAN BALONG - DESA TATUNG</span>
                </div>
            </div>
            <div class="">
                <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo Ponorogo"
                    class="h-56 w-auto me-4" />

            </div>
            <div class="relative z-20 mt-auto">
                <h1 class="text-4xl font-extrabold tracking-tight mb-4">
                    Sistem Informasi <br />
                    <span class="text-blue-400">Desa Tatung</span>
                </h1>
                <p class="text-lg text-blue-200 max-w-md">
                    Portal resmi layanan administrasi dan informasi Desa Tatung. Wujudkan pelayanan publik yang cepat,
                    transparan, dan akuntabel.
                </p>
            </div>

            <div class="relative z-20 mt-12 text-sm text-blue-300/80">
                &copy; {{ date('Y') }} Pemerintah Desa Tatung. Hak Cipta Dilindungi.
            </div>
        </div>

        <!-- Right Side - Auth Form -->
        <div class="w-full p-8 lg:p-12 flex flex-col justify-center h-full bg-white dark:bg-slate-950">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[400px]">
                <!-- Mobile Logo -->
                <div class="flex flex-col items-center gap-3 lg:hidden mb-4 text-center">
                    <img src="{{ asset('assets/ponorogo__sid__60A13U2.png') }}" alt="Logo Ponorogo"
                        class="h-16 w-auto" />
                    <div>
                        <div class="font-bold text-lg text-slate-800 dark:text-slate-200">PEMERINTAH DESA TATUNG</div>
                        <div class="text-sm text-slate-500 dark:text-slate-400">KABUPATEN PONOROGO</div>
                    </div>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>