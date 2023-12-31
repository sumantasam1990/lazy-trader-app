<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class TicketController extends Controller
{
    public function index(): Response
    {
        if (Auth::user()->user_type == 'user') {
            return Inertia::render('Support/Ticket', [
                'tickets' => Ticket::query()->with(['lazyfiles', 'user'])
                    ->where('user_id', Auth::user()->id)
                    ->orderByDesc('id')
                    ->cursorPaginate(5),
                'total_tickets' => Ticket::query()->where('user_id', Auth::user()->id)->count('id'),
            ]);
        } else {
            return Inertia::render('Support/Ticket', [
                'tickets' => Ticket::query()->with(['lazyfiles', 'user'])
                    ->orderByDesc('id')->cursorPaginate(5),
                'total_tickets' => Ticket::query()->count('id'),
            ]);
        }

    }

    public function create(): Response
    {
        return Inertia::render('Support/AddTicket');
    }

    public function store(CreateTicketRequest $request)
    {
        DB::transaction(function () use($request) {
            $ticket = Ticket::create($request->validated());
            foreach ($request->file('avatars') as $file) {
                $ticket->lazyfiles()->create([
                    'file' => $file->store('avatar', 'public'),
                    'ext' => $file->getClientOriginalExtension(),
                    'original_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                ]);
            }
        });

        return to_route('support.ticket');
    }
}
