<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Pemerintah Desa Tatung') : config('app.name', 'Desa Tatung') }}
</title>

<link rel="icon" href="{{ asset('assets/ponorogo__sid__60A13U2.svg') }}" sizes="any">
<link rel="icon" href="{{ asset('assets/ponorogo__sid__60A13U2.svg') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ asset('assets/ponorogo__sid__60A13U2.svg') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
