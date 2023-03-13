<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();

        return response()->json($addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'street' => 'required|max:50',
            'city' => 'required|max:50',
            'zip_code' =>'required|',
            'country' => 'required|max:50',
            'customer_id' => 'required|exists:customers,id'
        ]);

        $newAddress = new Address([
            'name' => $request->get('name'),
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'zip_code' => $request->get('zip_code'),
            'country' => $request->get('country'),
            'customer_id' => $request->get('customer_id')
        ]);

        $newAddress->save();

        return response()->json($newAddress, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::findOrFail($id);

        return response()->json($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $name = $request->has('name') ? $request->get('name') : $address->name;
        $street = $request->has('street') ? $request->get('street') : $address->street;
        $city = $request->has('city') ? $request->get('city') : $address->city;
        $zip_code = $request->has('zip_code') ? $request->get('zip_code') : $address->zip_code;
        $country = $request->has('country') ? $request->get('country') : $address->country;

        $request->validate([
            'name' => 'sometimes|required|max:50',
            'street' => 'sometimes|required|max:50',
            'city' => 'sometimes|required|max:50',
            'zip_code' =>'sometimes|required|',
            'country' => 'sometimes|required|max:50'
        ]);

        $address->name = $name;
        $address->street = $street;
        $address->city = $city;
        $address->zip_code = $zip_code;
        $address->country = $country;

        $address->save();

        return response()->json($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address= Address::findOrFail($id);
        $address->delete();

        return response()->json($address::all());
    }
}
