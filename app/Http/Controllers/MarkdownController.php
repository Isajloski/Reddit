<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class MarkdownController extends Controller
{

    public function index()
    {
        return Inertia::render('Markdown/Mark');
    }

}
