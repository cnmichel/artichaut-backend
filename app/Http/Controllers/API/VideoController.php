<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $socials = Video::all();
        return response()->json($socials);
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
            'title'     => 'required|max:100',
            'content'   => 'required',
            'url'       => 'required',
            'lang_id'   => 'required|exists:langs,id'
        ]);

        $newVideo = new Video([
            'title'     => $request->get('title'),
            'content'   => $request->get('content'),
            'url'       => $request->get('url'),
            'lang_id'   => $request->get('lang_id'),
        ]);

        $newVideo->save();

        return response()->json($newVideo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);
        return response()->json($video);
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
        $video = Video::findOrFail($id);

        $name = $request->has('name') ? $request->get('name') : $video->name;
        $content = $request->has('content') ? $request->get('content') : $video->content;
        $url = $request->has('url') ? $request->get('url') : $video->url;
        $active = $request->has('active') ? $request->get('active') : $video->active;
        $lang_id = $request->has('lang_id') ? $request->get('lang_id') : $video->lang_id;

        $request->validate([
            'name'      => 'sometimes|required|max:50',
            'content'   => 'sometimes|required',
            'url'       => 'sometimes|required',
            'active'    => 'sometimes|required|boolean',
            'lang_id'   => 'sometimes|required|exists:langs,id'
        ]);

        $video->name = $name;
        $video->content = $content;
        $video->url = $url;
        $video->active = $active;
        $video->lang_id = $lang_id;

        $video->save();

        return response()->json($video);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json($video::all());
    }
}
