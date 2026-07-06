<x-layouts::auth :title="__('Masuk Portal')">
    <div class="flex flex-col gap-6">
        <!-- Logo Desktop (Visible on LG screens to fill empty space) -->
        <div class="hidden lg:flex justify-center mb-6">
            <img src="{{ asset('assets/images/tatung_hebat.png') }}" alt="Tatung Hebat" class="h-32 w-auto object-contain" />
        </div>

        <x-auth-header :title="__('Akses Layanan Desa')" :description="__('Silakan masuk dengan NIK dan kata sandi Anda yang terdaftar pada sistem pemerintahan desa.')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- NIK -->
            <flux:input
                name="nik"
                :label="__('Nomor Induk Kependudukan (NIK)')"
                :value="old('nik')"
                type="number"
                inputmode="numeric"
                required
                autofocus
                autocomplete="nik"
                placeholder="Masukkan 16 Digit NIK"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Kata Sandi')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Masukkan kata sandi Anda')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                        {{ __('Lupa kata sandi?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Ingat saya')" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('Masuk Aplikasi') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-slate-600 dark:text-slate-400 mt-2">
                <span>{{ __('Belum memiliki akun?') }}</span>
                <flux:link :href="route('register')" wire:navigate class="font-semibold text-blue-600">{{ __('Daftar di sini') }}</flux:link>
            </div>
        @endif

        <div class="mt-2 text-center text-xs text-slate-500 flex flex-col gap-1">
            <p>Butuh bantuan akses? Hubungi Admin Balai Desa</p>
            <p>Pelayanan pada jam kerja (08:00 - 15:00 WIB)</p>
        </div>
    </div>
</x-layouts::auth>
