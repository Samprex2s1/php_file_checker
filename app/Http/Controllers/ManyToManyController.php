<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManyToManyController extends BaseController
{
    public function __invoke(Request $request) {
        $files = array();
        foreach($_FILES['files'] as $k => $l) {
            foreach($l as $i => $v) {
                $files[$i][$k] = $v;
            }
        }		
        $_FILES['files'] = $files;

        $textB = '';

        for ($i = 0; $i < count($_FILES['files']); $i++) {
            $fileB_path = $_FILES['files'][$i]['tmp_name'];

            $textB = $this->service->getFileText($fileB_path);

            for ($j = 0; $j < count($_FILES['files']); $j++) {
                $fileTmp_path = $_FILES['files'][$j]['tmp_name'];
                $textTmp = $this->service->getFileText($fileTmp_path);

                similar_text($textTmp, $textB, $perc);
                $textArr[$i][$j] =  $perc;
            }
        }

        return $textArr;
    }
}
