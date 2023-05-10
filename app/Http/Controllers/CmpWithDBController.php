<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\DB;

use App\Models\Text;

class CmpWithDBController extends BaseController
{
    public function __invoke(Request $request)
    {
       

        $fileA_path = $request->file('file')->path();
        $fileA_name =  $request->file('file')->getClientOriginalName();
        $textA = $this->service->getFileText($fileA_path);

        Text::firstOrCreate([
            'FileName' => $fileA_name,
            'Text' => $textA,
        ]);

        

        $texts = DB::table('texts')->pluck('Text', 'FileName')->toArray();
        $textArr = array();

        foreach ($texts as $key => $text) {
            similar_text($textA, $text, $perc);
            array_push($textArr, [
                'name'=> $key, 
                'perc' => round($perc, 1)
            ]);
        }
        return $textArr;
    }
}
