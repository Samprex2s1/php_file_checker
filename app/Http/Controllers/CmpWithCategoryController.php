<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Text;

class CmpWithCategory extends BaseController
{
    public function __invoke(Request $request)
    {
        $files = array();
        foreach($_FILES['files'] as $k => $l) {
            foreach($l as $i => $v) {
                $files[$i][$k] = $v;
            }
        }		
        $_FILES['files'] = $files;

        $fileA_path = $request->file('file')->path();
        $textA = $this->service->getFileText($fileA_path);
        $textB = '';

        for ($i = 0; $i < count($_FILES['files']); $i++) {
            $fileB_path = $_FILES['files'][$i]['tmp_name'];
            $textB = $this->service->getFileText($fileB_path);
            Text::firstOrCreate([
                'text' => $textB,
            ]);
        }

        $texts = DB::table('texts')->pluck('Text');
        $textArr[] = array();

        foreach ($texts as $text) {
            similar_text($textA, $text, $perc);
            array_push($textArr, $perc);
        }
        
        return $textArr;
    }
}
