<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::with('user', 'flairs')->get();

        return Inertia::render('Communities/Community', [
            'communities' => $communities,
        ]);
    }


    public function store(Request $request)
    {
        $existingCommunity = Community::where('name', $request->input('name'))->first();
        if ($existingCommunity) {
            echo "Error";
            return Inertia::render('communities.index');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rules' => 'required',
        ]);

        $user = Auth::user();
        $community = new Community();
        $community->name = $request->input('name');


        $community->description = $request->input('description');
        $community->rules = $request->input('rules');
        $community->image = $request->input('image') ?? 'https://w0.peakpx.com/wallpaper/906/498/HD-wallpaper-auora-borealis-northern-lights-nature-iceland-mountain-auora-snow.jpg';
        $community->user()->associate($user);
        $community->save();

        return redirect()->route('communities.index');
    }

    public function edit($id)
    {
        $community = Community::find($id);
    }

    public function update(Request $request, $id)
    {
        $community = Community::find($id);
        $community->name = $request->input('name');
        $community->description = $request->input('description');
        $community->rules = $request->input('rules');
        $community->image = $request->input('image');
        $community->save();
    }

    public function destroy($id)
    {
        $community = Community::findOrFail($id);
        $community->delete();
        return redirect()->route('communities.index');
    }

    public function findById($id)
    {
        $community = Community::with('user', 'flairs')->find($id);

        if (!$community) {
            return response()->json(['message' => 'Community not found'], 404);
        }

        return Inertia::render('Communities/Community', [
            'communities' => [$community],
        ]);
    }




}
