<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketMessageRequest;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
    public function index(int $id): Response
    {
        $messages = Ticket::query()->with(['messages.parent', 'messages.child'])
            ->where('id', $id)
            //->orderByDesc('id')
            ->first();

        return Inertia::render('Support/Message', [
            'tickets' => $messages,
        ]);
    }

    public function store(CreateTicketMessageRequest $request): RedirectResponse
    {
        TicketMessage::create($request->all());

        return to_route('support.ticket.message', [$request->ticket_id]);
    }
}
