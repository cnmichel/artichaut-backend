<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $articles = Article::all();

        return response()->json($articles);
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
            'image'     => 'image'
        ]);

        $newArticle = new Article([
            'title'     => $request->get('title'),
            'content'   => $request->get('content'),
            'image'     => $request->get('image'),
            'user_id'   => $request->get('user_id'),
            'lang_id'   => $request->get('lang_id')
        ]);

        $newArticle->save();

        return response()->json($newArticle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return response()->json($article);
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
        $article = Article::findOrFail($id);

        $request->validate([
            'title'     => 'required|max:100',
            'content'   => 'required',
            'image'     => 'image'
        ]);

        $article->title = $request->get('title');
        $article->content = $request->get('content');
        $article->image = $request->get('image');
        $article->lang_id = $request->get('lang_id');

        $article->save();

        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json($article::all());
    }
}
