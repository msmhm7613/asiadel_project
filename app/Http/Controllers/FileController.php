<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload($file,$path){

        $file_name = date('y_m_d_h_i_s') . '_' . rand(1,1000) . '.' . $file->getClientOriginalExtension();

        //return public_path('../../' . $path);

        if ($file->move(public_path($path), $file_name))
            return "$path/$file_name";
        else
            return false;

    }
}
