<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class TextDiffController extends Controller
{
    public function __invoke(Request $request)
    {
        $textA = GetFileController::class;

        return $textA;
    }
}
