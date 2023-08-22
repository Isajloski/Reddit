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
        $communities = Community::with('user', 'flairs', 'image')->get();

        return Inertia::render('Communities/Community', [
            'communities' => $communities,
        ]);
    }


    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|unique:communities',
            'description' => 'required',
            'rules' => 'required',
            'image' => 'nullable|file'
        ]);

        $user = Auth::user();
        $community = new Community();
        $community->name = $request->input('name');
        $community->description = $request->input('description');
        $community->rules = $request->input('rules');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageController = new ImageController();
            $imageId = $imageController->storeImage($file, '/communities');
            $community->image_id = $imageId;
        }
        else{
            $community->image_id = null;
        }

        $community->user()->associate($user);
        $community->save();

        return redirect()->route('communities.index');
    }


    public function edit($id)
    {
        $community = Community::find($id);
    }

    public function update($id, Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rules' => 'required',
        ]);

        $community = Community::findOrFail($id);
        $community->name = $request->input('name');
        $community->description = $request->input('description');
        $community->rules = $request->input('rules');

        $community->save();

        return redirect()->route('communities.index');
    }



    public function destroy($id)
    {
        $community = Community::findOrFail($id);

        if ($community->image) {
            $imageId = $community->image_id;
        }


        $community->delete();

        if($community->image_id != null) {
            $imageController = new ImageController();
            $imageController->delete($imageId);
        }

        return redirect()->route('communities.index');
    }

    public function findById($id)
    {
        $community = Community::with('user', 'flairs', 'image')->find($id);

        if (!$community) {
            return response()->json(['message' => 'Community not found'], 404);
        }

        return Inertia::render('Communities/Community', [
            'communities' => [$community],
        ]);
    }




}
