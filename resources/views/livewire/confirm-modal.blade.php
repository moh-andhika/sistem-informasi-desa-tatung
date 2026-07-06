<flux:modal :name="$modalId" class="w-full max-w-sm">
    <flux:heading>{{ $title }}</flux:heading>

    <flux:text class="mb-5">{{ $description }}</flux:text>

    <div class="flex space-x-2 mt-4">
        <flux:spacer />
        <flux:modal.close>
            <flux:button variant="ghost">Batal</flux:button>
        </flux:modal.close>
        <flux:button wire:click="confirm" variant="danger">Ya, Lanjutkan</flux:button>
    </div>
</flux:modal>
