<x-layouts::auth :title="__('Daftar Akun Baru')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Buat Akun Layanan')" :description="__('Silakan lengkapi data diri Anda di bawah ini untuk membuat akun baru.')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Nama Lengkap')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Nama Sesuai KTP')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Alamat Email')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="nama@email.com"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Kata Sandi')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Minimal 8 karakter')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Konfirmasi Kata Sandi')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Ulangi kata sandi')"
                viewable
            />

            <div class="flex items-center justify-end mt-2">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Daftar Sekarang') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-slate-600 dark:text-slate-400 mt-2">
            <span>{{ __('Sudah memiliki akun?') }}</span>
            <flux:link :href="route('login')" wire:navigate class="font-semibold text-blue-600">{{ __('Masuk di sini') }}</flux:link>
        </div>

        <div class="mt-2 text-center text-xs text-slate-500 flex flex-col gap-1">
            <p>Butuh bantuan pembuatan akun? Hubungi Admin Balai Desa</p>
            <p>Pelayanan pada jam kerja (08:00 - 15:00 WIB)</p>
        </div>
    </div>
</x-layouts::auth>
