<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lang;
use Illuminate\Http\Request;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $langs = Lang::all();
        return response()->json($langs);
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
            'code' => 'required|max:5',
        ]);

        $newLang = new Lang([
            'code' => $request->get('code'),
        ]);

        $newLang->save();

        return response()->json($newLang, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $lang = Lang::findOrFail($id);
        return response()->json($lang);
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
        $lang = Lang::findOrFail($id);

        $request->validate([
            'code' => 'required|max:5',
        ]);

        $lang->code = $request->get('code');

        $lang->save();

        return response()->json($lang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $lang = Lang::findOrFail($id);
        $lang->delete();

        return response()->json($lang::all());
    }
}
