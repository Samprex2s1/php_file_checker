<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Text;

class CmpWithCategoryController extends BaseController
{
    public function __invoke(Request $request)
    {
        $category = $request['pickedCategory'];

        $fileA_path = $request->file('file')->path();
        $textA = $this->service->getFileText($fileA_path);

        $texts = Text::where('category', $category)->get();

        $textArr = array();

        foreach ($texts as $text) {
            similar_text($textA, $text['Text'], $perc);
            array_push($textArr, [
                'name'=> $text['FileName'], 
                'perc' => round($perc, 1)
            ]);
        }
        
        return $textArr;
    }
}
