@props(['key' => 'success', 'timeout' => 3000])

@if(session($key))
    <div x-data x-init="
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session($key) }}',
            icon: 'success',
            timer: {{ $timeout }},
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    "></div>
@endif
