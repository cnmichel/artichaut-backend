<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $reservations = Reservation::all();

        return response()->json($reservations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date'   => 'required|date|after:start_date',
            'total_reservation'   => 'required|decimal:0,2',
            'status_id'   => 'required|exists:statuses,id',
            'payment_id'   => 'required|exists:payments,id',
            'customer_id'   => 'required|exists:customers,id',
            'address_id' => 'required|exists:addresses,id'
        ]);

        $newReservation = new Reservation([
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'total_reservation' => $request->get('total_reservation'),
            'status_id' => $request->get('status_id'),
            'payment_id' => $request->get('payment_id'),
            'customer_id' => $request->get('customer_id'),
            'address_id' => $request->get('address_id')
        ]);

        $newReservation->save();

        return response()->json($newReservation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);

        return response()->json($reservation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $start_date = $request->has('start_date') ? $request->get('start_date') : $reservation->start_date;
        $end_date = $request->has('end_date') ? $request->get('end_date') : $reservation->end_date;
        $total_reservation = $request->has('total_reservation') ? $request->get('total_reservation') : $reservation->total_reservation;
        $status_id = $request->has('$status_id') ? $request->get('$status_id') : $reservation->status_id;
        $payment_id = $request->has('payment_id') ? $request->get('payment_id') : $reservation->payment_id;
        $address_id = $request->has('address_id') ? $request->get('address_id') : $reservation->address_id;

        $request->validate([
            'start_date' => 'sometime|date|after:today',
            'end_date'   => 'sometime|date|after:start_date',
            'total_reservation'   => 'sometime|decimal:0,2',
            'status_id'   => 'sometime|required|exists:statuses,id',
            'payment_id'   => 'sometime|required|exists:payments,id',
            'address_id' => 'sometime|required|exists:addresses,id'
        ]);

        $reservation->start_date = $start_date;
        $reservation->end_date = $end_date;
        $reservation->total_reservation = $total_reservation;
        $reservation->status_id = $status_id;
        $reservation->payment_id = $payment_id;
        $reservation->address_id = $address_id;


        $reservation->save();

        return response()->json($reservation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json($reservation::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCustomerReservations()
    {
        $reservations = Auth::user()->customer?->reservations->load(['status', 'payment']);

        return response()->json($reservations);
    }

}
