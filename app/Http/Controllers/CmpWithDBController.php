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
            $fileB_name = $_FILES['files'][$i]['name'];
            $textB = $this->service->getFileText($fileB_path);
            Text::firstOrCreate([
                'FileName' => $fileB_name,
                'Text' => $textB,
            ]);
        }

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
