<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketTypesRequest;
use App\Http\Requests\UpdateTicketTypesRequest;
use App\Repositories\TicketTypesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TicketTypesController extends AppBaseController
{
    /** @var  TicketTypesRepository */
    private $ticketTypesRepository;

    public function __construct(TicketTypesRepository $ticketTypesRepo)
    {
        $this->middleware('auth');
        $this->ticketTypesRepository = $ticketTypesRepo;
    }

    /**
     * Display a listing of the TicketTypes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $ticketTypes = $this->ticketTypesRepository->all();

        return view('ticket_types.index')
            ->with('ticketTypes', $ticketTypes);
    }

    /**
     * Show the form for creating a new TicketTypes.
     *
     * @return Response
     */
    public function create()
    {
        return view('ticket_types.create');
    }

    /**
     * Store a newly created TicketTypes in storage.
     *
     * @param CreateTicketTypesRequest $request
     *
     * @return Response
     */
    public function store(CreateTicketTypesRequest $request)
    {
        $input = $request->all();

        $ticketTypes = $this->ticketTypesRepository->create($input);

        Flash::success('Ticket Types saved successfully.');

        return redirect(route('ticketTypes.index'));
    }

    /**
     * Display the specified TicketTypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ticketTypes = $this->ticketTypesRepository->find($id);

        if (empty($ticketTypes)) {
            Flash::error('Ticket Types not found');

            return redirect(route('ticketTypes.index'));
        }

        return view('ticket_types.show')->with('ticketTypes', $ticketTypes);
    }

    /**
     * Show the form for editing the specified TicketTypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ticketTypes = $this->ticketTypesRepository->find($id);

        if (empty($ticketTypes)) {
            Flash::error('Ticket Types not found');

            return redirect(route('ticketTypes.index'));
        }

        return view('ticket_types.edit')->with('ticketTypes', $ticketTypes);
    }

    /**
     * Update the specified TicketTypes in storage.
     *
     * @param int $id
     * @param UpdateTicketTypesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTicketTypesRequest $request)
    {
        $ticketTypes = $this->ticketTypesRepository->find($id);

        if (empty($ticketTypes)) {
            Flash::error('Ticket Types not found');

            return redirect(route('ticketTypes.index'));
        }

        $ticketTypes = $this->ticketTypesRepository->update($request->all(), $id);

        Flash::success('Ticket Types updated successfully.');

        return redirect(route('ticketTypes.index'));
    }

    /**
     * Remove the specified TicketTypes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ticketTypes = $this->ticketTypesRepository->find($id);

        if (empty($ticketTypes)) {
            Flash::error('Ticket Types not found');

            return redirect(route('ticketTypes.index'));
        }

        $this->ticketTypesRepository->delete($id);

        Flash::success('Ticket Types deleted successfully.');

        return redirect(route('ticketTypes.index'));
    }
}
