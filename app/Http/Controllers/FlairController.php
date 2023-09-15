<?php

namespace App\Http\Controllers;

use App\Models\Community\Community;
use App\Models\Flair\Flair;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FlairController extends Controller
{
    public function index()
    {
        return Inertia::render('Flairs/Flair');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'community_id' => 'required',
        ]);


        $community = Community::findOrFail($request->input('community_id'));

        $flair = new Flair;
        $flair->name = $request->input('name');
        $flair->community_id = $request->input('community_id');
        $community->flairs()->save($flair);

        return response()->json(['message' => 'Flair created successfully'], 201);
    }

    public function getCommunityFlairs($communityId){
        return Flair::where('community_id', $communityId)->get();
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $flair = Flair::findOrFail($id);

        $flair->update($validatedData);

        return response()->json($flair);
    }

    public function destroy($id)
    {
        $flair = Flair::findOrFail($id);
        $flair->delete();

        return response()->json(['message' => 'Flair deleted']);
    }


}
