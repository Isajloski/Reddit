<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Inertia\Inertia;

class test extends Controller
{
    public function index()
    {
        $communities = Community::with('user')->get();

        return Inertia::render('Community', [
            'communities' => $communities,
        ]);
    }

}
