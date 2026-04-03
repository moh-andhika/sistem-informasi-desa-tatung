<?php

use function Livewire\Volt\{state, on};
use Flux\Flux;


state(['id' => 'global-confirm-modal', 'title' => 'Konfirmasi', 'description' => 'Apakah Anda yakin ingin melanjutkan tindakan ini?', 'action' => '', 'params' => null]);

on(['show-confirm-modal' => function ($payload) {
    $this->title = $payload['title'] ?? 'Konfirmasi';
    $this->description = $payload['description'] ?? 'Apakah Anda yakin ingin melanjutkan tindakan ini?';
    $this->action = $payload['action'] ?? '';
    $this->params = $payload['params'] ?? null;
    
    // Show the modal via Flux UI
    Flux::modal($this->id)->show();
}]);

$confirm = function () {
    if ($this->action) {
        if ($this->params !== null) {
            $this->dispatch($this->action, $this->params);
        } else {
            $this->dispatch($this->action);
        }
    }
    
    Flux::modal($this->id)->close();
};

?>

<flux:modal :name="$id" class="w-full max-w-sm">
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
