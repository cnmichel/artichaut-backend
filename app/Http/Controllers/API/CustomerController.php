<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $customers = Customer::all();

        return response()->json($customers);
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
            'firstname'     => 'required|max:50',
            'lastname'      => 'required|max:50',
            'address'       => 'required|max:100',
            'tel_number'    => 'required|max:13',
            'promo_10'      => 'boolean',
            'promo_25'      => 'boolean'
        ]);

        $newCustomer = new Customer([
            'firstname'     => $request->get('firstname'),
            'lastname'      => $request->get('lastname'),
            'address'       => $request->get('address'),
            'tel_number'    => $request->get('tel_number'),
            'promo_10'      => $request->get('promo_10'),
            'promo_25'      => $request->get('promo_25'),
            'user_id'       => $request->get('user_id')
        ]);

        $newCustomer->save();

        return response()->json($newCustomer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return response()->json($customer);
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
        $customer = Customer::findOrFail($id);

        $request->validate([
            'firstname'     => 'required|max:50',
            'lastname'      => 'required|max:50',
            'address'       => 'required|max:100',
            'tel_number'    => 'required|max:13',
            'promo_10'      => 'boolean',
            'promo_25'      => 'boolean'
        ]);

        $customer->firstname = $request->get('firstname');
        $customer->lastname = $request->get('lastname');
        $customer->address = $request->get('address');
        $customer->tel_number = $request->get('tel_number');
        $customer->promo_10 = $request->get('promo_10');
        $customer->promo_25 = $request->get('promo_25');

        $customer->save();

        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json($customer::all());
    }
}
