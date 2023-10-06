<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TicketController extends Controller
{
    public function index(): Response
    {
        if (Auth::user()->user_type == 'user') {
            return Inertia::render('Support/Ticket', [
                'tickets' => Ticket::query()->with(['user' => function($query) {
                    $query->select('id', 'name');
                }])->where('user_id', Auth::user()->id)->select('id', 'title', 'user_id', 'created_at', 'ticket_no', 'status')->orderByDesc('id')->cursorPaginate(5),
                'total_tickets' => Ticket::query()->where('user_id', Auth::user()->id)->count('id'),
            ]);
        } else {
            return Inertia::render('Support/Ticket', [
                'tickets' => Ticket::query()->with(['user' => function($query) {
                    $query->select('id', 'name');
                }])->select('id', 'title', 'user_id', 'created_at', 'ticket_no', 'status')->orderByDesc('id')->cursorPaginate(5),
                'total_tickets' => Ticket::query()->count('id'),
            ]);
        }

    }

    public function create(): Response
    {
        return Inertia::render('Support/AddTicket');
    }

    public function store(CreateTicketRequest $request): RedirectResponse
    {
        Ticket::create($request->all());

        return to_route('support.ticket');
    }
}
