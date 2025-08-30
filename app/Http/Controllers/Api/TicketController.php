<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    // Create Ticket and First Reply
    public function createTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
//            'language' => 'nullable|in:EN,AR',
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'status' => 'open',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_user' => 'CUSTOMER',
//            'language' => $request->language ?? 'EN',
        ]);

        return response()->json(['message' => 'Ticket created successfully', 'ticket' => $ticket], 201);
    }

    //Get All Tickets for User
    public function getUserTickets()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
        return response()->json($tickets);
    }

    // Get Messages for a Ticket
    public function getTicketMessages($ticketId)
    {
        $ticket = Ticket::with('ticketReplies')->where('id', $ticketId)->first();

        if (!$ticket || $ticket->user_id !== Auth::id()) {
            return response()->json(['status'=>0,'message' => 'Ticket not found or unauthorized']);
        }

        return response()->json(
            ['status'=>1,'message' => 'success','ticket_replies' => $ticket->replies]
        );
    }

    // Add Message to Ticket
    public function addTicketMessage(Request $request, $ticketId)
    {
        $request->validate([
            'message' => 'required|string',
//            'language' => 'nullable|in:EN,AR',
        ]);

        $ticket = Ticket::find($ticketId);

        if (!$ticket || $ticket->user_id !== Auth::id()) {
            return response()->json(['status'=>0,'message' => 'Ticket not found or unauthorized'], 404);
        }

        $reply = TicketReply::create([
            'ticket_id' => $ticketId,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_user' => 'CUSTOMER',
//            'language' => $request->language ?? 'EN',
        ]);

        return response()->json(['status'=>1,'message' => 'success', 'ticket_replies' => $reply]);
    }
}
