<x-layouts::auth :title="__('Verifikasi Email')">
    <div class="mt-4 flex flex-col gap-6">
        <flux:text class="text-center">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan ulang.') }}
        </flux:text>

        @if (session('status') == 'verification-link-sent')
            <flux:text class="text-center font-medium !dark:text-blue-400 !text-blue-600">
                {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
            </flux:text>
        @endif

        <div class="flex flex-col items-center justify-between space-y-3 mt-2">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <flux:button type="submit" variant="primary" class="w-full">
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </flux:button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:button variant="ghost" type="submit" class="text-sm cursor-pointer w-full text-slate-500" data-test="logout-button">
                    {{ __('Keluar') }}
                </flux:button>
            </form>
        </div>

        <div class="mt-2 text-center text-xs text-slate-500 flex flex-col gap-1">
            <p>Butuh bantuan? Hubungi Admin Balai Desa</p>
            <p>Pelayanan pada jam kerja (08:00 - 15:00 WIB)</p>
        </div>
    </div>
</x-layouts::auth>
