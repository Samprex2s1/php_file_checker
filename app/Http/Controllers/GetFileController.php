<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PhpOffice\PhpWord\IOFactory;

use App\Models\Text;

class GetFileController extends BaseController
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
            similar_text($textA, $textB, $perc);
            $textArr[$i] = [
                'name'=> $fileB_name, 
                'perc' => round($perc, 1)
            ];
        }

        return $textArr;
        
    }
}
