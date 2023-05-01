<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PhpOffice\PhpWord\IOFactory;

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

        $fileB_path = $_FILES['files'][0]['tmp_name'];
        $textB = $this->service->getFileText($fileB_path);

        similar_text($textA, $textB, $perc);
        return $perc;
        
    }
}
