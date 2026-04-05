<x-layouts::auth :title="__('Konfirmasi Kata Sandi')">
    <div class="flex flex-col gap-6">
        <x-auth-header
            :title="__('Konfirmasi Kata Sandi')"
            :description="__('Ini adalah area aman dari aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.')"
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="password"
                :label="__('Kata Sandi')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Masukkan kata sandi Anda')"
                viewable
            />

            <flux:button variant="primary" type="submit" class="w-full mt-2" data-test="confirm-password-button">
                {{ __('Konfirmasi') }}
            </flux:button>
        </form>

        <div class="mt-2 text-center text-xs text-slate-500 flex flex-col gap-1">
            <p>Butuh bantuan? Hubungi Admin Balai Desa</p>
            <p>Pelayanan pada jam kerja (08:00 - 15:00 WIB)</p>
        </div>
    </div>
</x-layouts::auth>
