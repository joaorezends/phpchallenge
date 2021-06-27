<?php

namespace App\Presentation\Web\Http;

use App\Domain\People\Rules\ValidPeopleXML;
use App\Presentation\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadedFilesController extends Controller
{
    public function create()
    {
        return view("web::index");
    }

    public function store(Request $request)
    {
        $request->validate([
            "people" => ["required", "file", "mimes:xml", new ValidPeopleXML],
        ], [], [
            "people" => "pessoas",
        ]);
        
        dd("Passou");
    }
}
