<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketsRequest;
use App\Http\Requests\UpdateTicketsRequest;
use App\Repositories\TicketsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\TicketTypes;
use App\Models\TicketLogs;
use App\Models\Customers;
use App\Models\CustomerTechnical;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 
use Flash;
use Response;

class TicketsController extends AppBaseController
{
    /** @var  TicketsRepository */
    private $ticketsRepository;

    public function __construct(TicketsRepository $ticketsRepo)
    {
        $this->middleware('auth');
        $this->ticketsRepository = $ticketsRepo;
    }

    /**
     * Display a listing of the Tickets.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $allTickets = DB::table('Tickets')
            ->leftJoin('TicketTypes', 'Tickets.Ticket', '=', 'TicketTypes.id')
            ->leftJoin('Towns', 'Tickets.Town', '=', 'Towns.id')
            ->leftJoin('Barangays', 'Tickets.Barangay', '=', 'Barangays.id')
            ->select(
                'Tickets.*',
                'Towns.Town as TownName',
                'Barangays.Barangay as BarangayName',
                'TicketTypes.TicketName',
            )
            ->orderByDesc('Tickets.created_at')
            ->paginate(30);

        $newTickets = DB::table('Tickets')
            ->leftJoin('TicketTypes', 'Tickets.Ticket', '=', 'TicketTypes.id')
            ->leftJoin('Towns', 'Tickets.Town', '=', 'Towns.id')
            ->leftJoin('Barangays', 'Tickets.Barangay', '=', 'Barangays.id')
            ->where('Status', 'Pending')
            ->select(
                'Tickets.*',
                'Towns.Town as TownName',
                'Barangays.Barangay as BarangayName',
                'TicketTypes.TicketName',
            )
            ->orderByDesc('Tickets.created_at')
            ->get();

        return view('tickets.index', [
            'allTickets' => $allTickets,
            'newTickets' => $newTickets,
        ]);
    }

    /**
     * Show the form for creating a new Tickets.
     *
     * @return Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created Tickets in storage.
     *
     * @param CreateTicketsRequest $request
     *
     * @return Response
     */
    public function store(CreateTicketsRequest $request)
    {
        $input = $request->all();

        $tickets = $this->ticketsRepository->create($input);

        Flash::success('Tickets saved successfully.');

        return redirect(route('tickets.index'));
    }

    /**
     * Display the specified Tickets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ticket = DB::table('Tickets')
            ->leftJoin('TicketTypes', 'Tickets.Ticket', '=', 'TicketTypes.id')
            ->where('Tickets.id', $id)
            ->select(
                'Tickets.*',
                'TicketTypes.TicketName',
            )
            ->first();

        $ticketLogs = TicketLogs::where('TicketId', $id)->orderByDesc('created_at')->get();

        $customers = DB::table('Customers')
            ->leftJoin('Towns', 'Customers.Town', '=', 'Towns.id')
            ->leftJoin('Barangays', 'Customers.Barangay', '=', 'Barangays.id')
            ->leftJoin('users', 'users.id', '=', 'Customers.UserId')
            ->select(
                'FullName',
                'Customers.id',
                'Towns.Town',
                'Barangays.Barangay',
                'Purok',
                'Customers.Email',
                'ContactNumber',
                'DateConnected',
                'Status',
                'CustomerTechnicalId',
                'users.name',
                'Latitude',
                'Longitude',
                'Customers.created_at',
            )
            ->where('Customers.id', $ticket->CustomerId)
            ->first();

        $customersTechnical = CustomerTechnical::find($customers->CustomerTechnicalId);
        $modemHistory = DB::table('CustomerTechnical')
                ->leftJoin('users', 'CustomerTechnical.UserId', '=', 'users.id')
                ->whereRaw("CustomerId='" . $ticket->CustomerId . "'")
                ->select('CustomerTechnical.*', 'users.name')
                ->orderByDesc('CustomerTechnical.created_at')
                // ->offset(1)
                ->get();

        if (empty($ticket)) {
            Flash::error('Tickets not found');

            return redirect(route('tickets.index'));
        }

        return view('tickets.show', [
            'ticket' => $ticket,
            'customer' => $customers,
            'customerTechnical' => $customersTechnical,
            'modemHistory' => $modemHistory,
            'ticketLogs' => $ticketLogs,
        ]);
    }

    /**
     * Show the form for editing the specified Tickets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tickets = $this->ticketsRepository->find($id);

        if (empty($tickets)) {
            Flash::error('Tickets not found');

            return redirect(route('tickets.index'));
        }

        return view('tickets.edit')->with('tickets', $tickets);
    }

    /**
     * Update the specified Tickets in storage.
     *
     * @param int $id
     * @param UpdateTicketsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTicketsRequest $request)
    {
        $tickets = $this->ticketsRepository->find($id);

        if (empty($tickets)) {
            Flash::error('Tickets not found');

            return redirect(route('tickets.index'));
        }

        $tickets = $this->ticketsRepository->update($request->all(), $id);

        Flash::success('Tickets updated successfully.');

        return redirect(route('tickets.index'));
    }

    /**
     * Remove the specified Tickets from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tickets = $this->ticketsRepository->find($id);

        if (empty($tickets)) {
            Flash::error('Tickets not found');

            return redirect(route('tickets.index'));
        }

        $this->ticketsRepository->delete($id);

        Flash::success('Tickets deleted successfully.');

        return redirect(route('tickets.index'));
    }

}
