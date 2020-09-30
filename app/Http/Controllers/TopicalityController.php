<?php

namespace App\Http\Controllers;

use App\Topicality;
use App\Http\Resources\Topicality as ResourcesTopicality;
use Illuminate\Http\Request;

class TopicalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $topicalities = Topicality::all();
        // Permet d'afficher les ressources dans un ordre decroissant en fonction de la date de création :
        $topicalities = Topicality::orderByDesc('created_at')->get();

        return $topicalities->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* La fonction "cerate()" est un Mass-Assignment.
            Du coup, il faudrait le rpéciser dans le Model. */
        if(Topicality::create($request->all())) {
            return response()->json([
                'success' => 'Actualité créée avec succès'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function show(Topicality $topicality)
    {
        return new ResourcesTopicality($topicality);
        // return $topicality;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topicality $topicality)
    {
        if($topicality->update($request->all())) {
            return response()->json([
                'success' => 'Actualité modifiée avec succès'
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topicality  $topicality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topicality $topicality)
    {
        if($topicality->delete()) {
            return response()->json([
                'success' => 'Actualité supprimée avec succès'
            ],200);
        }
    }
}
