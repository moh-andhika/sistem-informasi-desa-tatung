@props(['key' => 'error', 'timeout' => 4000])

@if(session($key))
    <div x-data x-init="
        Swal.fire({
            title: 'Gagal!',
            text: '{{ session($key) }}',
            icon: 'error',
            timer: {{ $timeout }},
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    "></div>
@endif
