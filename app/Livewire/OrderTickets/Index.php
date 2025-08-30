<?php

namespace App\Livewire\OrderTickets;

use App\Models\OrderTicket;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
        $orderTickets = OrderTicket::search($this->search)->with('ticket_process_admin','user','order')->paginate();

        return view('livewire.order-ticket.index', compact('orderTickets'))
            ->with('i', $this->getPage() * $orderTickets->perPage());
    }

    public function searchOrderTickets(){
        $this->search = '';
    }

    public function delete(OrderTicket $orderTicket)
    {
        $orderTicket->delete();

        return $this->redirectRoute('order-tickets.index', navigate: true);
    }
}
