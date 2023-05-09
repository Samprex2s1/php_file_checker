<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Text;

class SaveCategoryController extends BaseController
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

        $categoryName = $request['categoryName'];
        $textB = '';

        for ($i = 0; $i < count($_FILES['files']); $i++) {
            $fileB_path = $_FILES['files'][$i]['tmp_name'];
            $fileB_name = $_FILES['files'][$i]['name'];
            $textB = $this->service->getFileText($fileB_path);
            Text::updateOrCreate([
                'FileName' => $fileB_name,
                'Text' => $textB,          
            ],[
                'Category' =>  $categoryName,
            ]);
        }
        
        return 'Категория добавлена';
    }
}
