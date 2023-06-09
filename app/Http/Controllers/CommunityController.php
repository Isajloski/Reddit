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
        $communities = Community::with('user')->get();

        return Inertia::render('Communities/Community', [
            'communities' => $communities,
        ]);
    }


    public function store(Request $request)
    {
        $existingCommunity = Community::where('name', $request->input('name'))->first();
        if ($existingCommunity) {
            // Handle the case where the name is not unique
            echo "Error";
            return Inertia::render('communities.index');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rules' => 'required',
            // other validation rules
        ]);

        $user = Auth::user();
        $community = new Community();
        $community->name = $request->input('name');


        $community->description = $request->input('description');
        $community->rules = $request->input('rules');
        $community->image = $request->input('image') ?? 'https://www.historyofmacedonia.org/IndependentMacedonia/images/mak_flag.jpg';
        // Associate the community with the authenticated user
        $community->user()->associate($user);
        $community->save();

        return redirect()->route('communities.index');
    }

    public function edit($id)
    {
        $community = Community::find($id);

        // You can pass the $community variable to a view to display the edit form.
        // For example, return view('communities.edit', compact('community'));
    }

    public function update(Request $request, $id)
    {
        $community = Community::find($id);
        $community->name = $request->input('name');
        $community->description = $request->input('description');
        $community->rules = $request->input('rules');
        $community->image = $request->input('image');
        $community->save();

        // Optionally, you can redirect the user to a specific page after updating the community.
        // For example, return redirect()->route('communities.index');
    }

    public function destroy($id)
    {
        $community = Community::findOrFail($id);

        // Add any additional logic or checks here if needed

        $community->delete();

        // Optionally, you can redirect the user to a different page after deletion
        return redirect()->route('communities.index');
        // Optionally, you can redirect the user to a specific page after deleting the community.
        // For example, return redirect()->route('communities.index');
    }

    public function findById($id)
    {
        $community = Community::with('user')->find($id);

        if (!$community) {
            return response()->json(['message' => 'Community not found'], 404);
        }

        return Inertia::render('Communities/Community', [
            'communities' => [$community],
        ]);
    }




}
