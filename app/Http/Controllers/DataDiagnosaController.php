<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Inertia\Inertia;
use Inertia\Response;

class DataDiagnosaController extends Controller
{
    public function index(): Response
    {
        $careers = Career::orderBy('name')->get();

        return Inertia::render('dataDiagnosa', [
            'careers' => $careers,
        ]);
    }
}
