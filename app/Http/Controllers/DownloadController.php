<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download()
    {

        return response()->download(storage_path("app/data/spt/hasil.docx"));
    }
}
