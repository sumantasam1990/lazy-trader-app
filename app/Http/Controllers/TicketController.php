<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TicketController extends Controller
{
    public function index(Ticket $ticket): Response
    {
        $ticket->with(['user']);
        return Inertia::render('Support/Ticket', [
            'tickets' => Ticket::query()->with(['user' => function($query) {
                $query->select('id', 'name');
            }])->select('id', 'title', 'user_id', 'created_at')->orderByDesc('id')->get(),
        ]);
    }
}
