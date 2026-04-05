<x-layouts::auth :title="__('Autentikasi Dua Faktor')">
    <div class="flex flex-col gap-6">
        <div
            class="relative w-full h-auto"
            x-cloak
            x-data="{
                showRecoveryInput: @js($errors->has('recovery_code')),
                code: '',
                recovery_code: '',
                toggleInput() {
                    this.showRecoveryInput = !this.showRecoveryInput;

                    this.code = '';
                    this.recovery_code = '';

                    $dispatch('clear-2fa-auth-code');

                    $nextTick(() => {
                        this.showRecoveryInput
                            ? this.$refs.recovery_code?.focus()
                            : $dispatch('focus-2fa-auth-code');
                    });
                },
            }"
        >
            <div x-show="!showRecoveryInput">
                <x-auth-header
                    :title="__('Kode Autentikasi')"
                    :description="__('Masukkan kode autentikasi yang diberikan oleh aplikasi autentikator Anda.')"
                />
            </div>

            <div x-show="showRecoveryInput">
                <x-auth-header
                    :title="__('Kode Pemulihan')"
                    :description="__('Harap konfirmasi akses ke akun Anda dengan memasukkan salah satu kode pemulihan darurat Anda.')"
                />
            </div>

            <form method="POST" action="{{ route('two-factor.login.store') }}">
                @csrf

                <div class="space-y-5 text-center">
                    <div x-show="!showRecoveryInput">
                        <div class="flex items-center justify-center my-5">
                            <flux:otp
                                x-model="code"
                                length="6"
                                name="code"
                                label="Kode OTP"
                                label:sr-only
                                class="mx-auto"
                             />
                        </div>
                    </div>

                    <div x-show="showRecoveryInput">
                        <div class="my-5">
                            <flux:input
                                type="text"
                                name="recovery_code"
                                x-ref="recovery_code"
                                x-bind:required="showRecoveryInput"
                                autocomplete="one-time-code"
                                x-model="recovery_code"
                            />
                        </div>

                        @error('recovery_code')
                            <flux:text color="red">
                                {{ $message }}
                            </flux:text>
                        @enderror
                    </div>

                    <flux:button
                        variant="primary"
                        type="submit"
                        class="w-full mt-2"
                    >
                        {{ __('Lanjutkan') }}
                    </flux:button>
                </div>

                <div class="mt-5 space-x-0.5 text-sm leading-5 text-center">
                    <span class="text-slate-500">{{ __('atau Anda dapat') }}</span>
                    <div class="inline font-medium text-blue-600 cursor-pointer">
                        <span x-show="!showRecoveryInput" @click="toggleInput()">{{ __('masuk menggunakan kode pemulihan') }}</span>
                        <span x-show="showRecoveryInput" @click="toggleInput()">{{ __('masuk menggunakan kode autentikasi') }}</span>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-4 text-center text-xs text-slate-500 flex flex-col gap-1">
            <p>Butuh bantuan? Hubungi Admin Balai Desa</p>
            <p>Pelayanan pada jam kerja (08:00 - 15:00 WIB)</p>
        </div>
    </div>
</x-layouts::auth>
