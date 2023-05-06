<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Text;

class GetCategoriesController extends Controller
{
    public function __invoke()
    {
        $categories = Text::select('Category')->distinct()->get();
        return $categories;
    }
}
