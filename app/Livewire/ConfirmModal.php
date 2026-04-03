<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\View\View;
use Livewire\Component;

class ConfirmModal extends Component
{
    public string $modalId = 'global-confirm-modal';

    public string $title = 'Konfirmasi';

    public string $description = 'Apakah Anda yakin ingin melanjutkan tindakan ini?';

    public string $action = '';

    public mixed $params = null;

    protected $listeners = ['show-confirm-modal' => 'open'];

    /**
     * Open the modal and populate its content.
     *
     * @param  array<string, mixed>  $payload
     */
    public function open(array $payload): void
    {
        $this->title = $payload['title'] ?? 'Konfirmasi';
        $this->description = $payload['description'] ?? 'Apakah Anda yakin ingin melanjutkan tindakan ini?';
        $this->action = $payload['action'] ?? '';
        $this->params = $payload['params'] ?? null;

        Flux::modal($this->modalId)->show();
    }

    /**
     * Confirmed by the user — dispatch the target action then close.
     */
    public function confirm(): void
    {
        if ($this->action) {
            if ($this->params !== null) {
                $this->dispatch($this->action, $this->params);
            } else {
                $this->dispatch($this->action);
            }
        }

        Flux::modal($this->modalId)->close();
    }

    public function render(): View
    {
        return view('livewire.confirm-modal');
    }
}
