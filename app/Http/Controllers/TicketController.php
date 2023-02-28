<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\TicketFile;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::with('user' /* , 'categories', 'labels', 'assignedToUser' */)
        /* ->when($request->has('status'), function (Builder $query) use ($request) {
        return $query->where('status', $request->input('status'));
        })
        ->when($request->has('priority'), function (Builder $query) use ($request) {
        return $query->withPriority($request->input('priority'));
        })
        ->when($request->has('category'), function (Builder $query) use ($request) {
        return $query->whereRelation('categories', 'id', $request->input('category'));
        })
        ->when(auth()->user()->hasRole('agent'), function (Builder $query) {
        $query->where('assigned_to', auth()->user()->id);
        })
        ->when(auth()->user()->hasRole('user'), function (Builder $query) {
        $query->where('user_id', auth()->user()->id);
        })
        ->latest() */
            ->get();

        return response()->json($tickets);
    }
    public function store(TicketRequest $request)
    {
        $ticket = auth()->user()->tickets()->create($request->only('title', 'message', 'status', 'priority'));

        $ticket->attachCategories($request->input('categories'));

        $ticket->attachLabels($request->input('labels'));

        /* if ($request->input('assigned_to')) {
        $ticket->assignTo($request->input('assigned_to'));
        User::find($request->input('assigned_to'))->notify(new AssignedTicketNotification($ticket));
        } else {
        User::role('admin')
        ->each(fn ($user) => $user->notify(new NewTicketCreatedNotification($ticket)));
        } */

        if (!is_null($request->input('attachments'))) {
            foreach ($request->input('attachments') as $file) {
            TicketFile::create(['file' => $file, 'ticket_id' => $ticket->id]);
            }
        }
        activity()
        ->causedBy(auth()->user())
        ->performedOn($ticket)
        ->withProperties(['attributes' => $ticket])
        ->event('created')
        ->log('Ticket has been created');


        return response()->json($ticket);
    }

    public function show(Ticket $ticket)
    {
        //$this->authorize('view', $ticket);
        //$ticketfile = TicketFile::with('ticket')->get();
        $ticketwithfiles = $ticket->with(['ticketFile'])->where('id',$ticket->id)->get();

        return response()->json($ticketwithfiles);
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        //$this->authorize('update', $ticket);#
        //activity()->disableLogging();
        
        $ticket->update($request->only('title', 'message', 'status', 'priority'));
       /*  activity()
        ->causedBy(auth()->user())
        ->performedOn($ticket)
        ->withProperties(['attributes' =>$ticket,'old'=>$old])
        ->event('updated')
        ->log('Ticket has been updated'); */
        $ticket->syncCategories($request->input('categories'));

        $ticket->syncLabels($request->input('labels'));

        /* if ($ticket->wasChanged('assigned_to')) {
        User::find($request->input('assigned_to'))->notify(new AssignedTicketNotification($ticket));
        } */
        
        return response()->json($ticket);

    }

    public function destroy(Ticket $ticket)
    {
        //$this->authorize('delete', $ticket);
        $ticket->ticketfile()->delete();
        $ticket->delete();

        return response()->json("deleted");
    }

    public function upload(Request $request)
    {
        $path = [];
        if ($request->file('attachments')) {
            foreach ($request->file('attachments') as $file) {
            $path[] = $file->store('tmp', 'public');
            }
        }

        return response()->json($path);
    }

    public function close(Ticket $ticket)
    {
        //$this->authorize('update', $ticket);

        $ticket->close();

        return response()->json("closed");
    }

    public function reopen(Ticket $ticket)
    {
        //$this->authorize('update', $ticket);

        $ticket->reopen();

        return response()->json("reopened");
    }

    public function archive(Ticket $ticket)
    {
        //$this->authorize('update', $ticket);

        $ticket->archive();

        return response()->json("archived");
    }

}
