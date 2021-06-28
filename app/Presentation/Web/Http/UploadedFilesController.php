<?php

namespace App\Presentation\Web\Http;

use App\Domain\People\Jobs\StorePeopleFromFileJob;
use App\Domain\People\Rules\ValidPeopleXML;
use App\Domain\Shiporders\Jobs\StoreShipordersFromFileJob;
use App\Domain\Shiporders\Rules\ValidShipordersXML;
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
            "shiporders" => ["required", "file", "mimes:xml", new ValidShipordersXML],
        ], [], [
            "people" => "pessoas",
            "shiporders" => "pedidos",
        ]);

        StorePeopleFromFileJob::dispatch($request->file("people")->get());
        StoreShipordersFromFileJob::dispatch($request->file("shiporders")->get());
        
        return back()->with("succes", "Upload realizado com sucesso.");
    }
}
