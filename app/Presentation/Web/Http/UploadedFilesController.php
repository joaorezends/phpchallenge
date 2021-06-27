<?php

namespace App\Presentation\Web\Http;

use App\Presentation\Core\Http\Controllers\Controller;

class UploadedFilesController extends Controller
{
    public function create()
    {
        return view("web::index");
    }

    public function store()
    {
        
    }
}
