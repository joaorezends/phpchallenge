<?php

namespace App\Presentation\Api\Http;

use App\Domain\Interfaces\Service;
use App\Presentation\Core\Http\Controllers\Controller as BaseController;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Controller extends BaseController
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * @var string
     */
    protected $path;

    /**
     * @return void
     */
    public function __construct(Service $service) 
    {
        $this->service = $service;
        $this->path = $this->getPath();
    }

    /**
     * @return string
     */
    abstract public function getPath(): string;

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $objects = $this->service->all();
            $this->putIndexLinks($objects);

            return $this->json($objects);
        } catch (Exception $e) {
            return $this->badRequest("Não foi possível listar.");
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $object = $this->service->find($id);
        
            if (! $object instanceof Model) {
                return $this->resourceNotFound();
            }
            
            $this->putShowLinks($object);

            return $this->json($object);
        } catch (Exception $e) {
            return $this->badRequest("Não foi possível buscar.");
        }
    }

    /**
     * Create a new JSON response from the application.
     *
     * @param  mixed  $data
     * @param  int  $status
     * @param  array  $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function json($data, $status = 200, array $headers = [])
    {
        return response()->json($data, $status, $headers);
    }

    /**
     * Create a new 400 response from the application.
     *
     * @param  string  $content
     * @param  array  $headers
     * @return \Illuminate\Http\Response
     */
    protected function badRequest($content = "", array $headers = [])
    {
        return response($content, 400, $headers);
    }

    /**
     * Create a new 404 response from the application.
     *
     * @param  string  $content
     * @param  array  $headers
     * @return \Illuminate\Http\Response
     */
    protected function resourceNotFound($content = "", array $headers = [])
    {
        return response($content, 404, $headers);
    }

    /**
     * @param  Collection $objects
     * @return void
     */
    private function putIndexLinks(Collection &$objects): void
    {
        $objects = $objects->map(function($object) {
            $object->links = [
                "rel" => "self",
                "href" => url(
                    join("/", array_filter([
                        "api", 
                        $this->getPath(), 
                        $object->id
                    ]))
                )
            ];

            return $object;
        });
    }

    /**
     * @param  Model $object
     * @return void
     */
    private function putShowLinks(Model &$object): void
    {
        $object->links = [
            "list of " . $this->getPath() => url(
                join("/", array_filter([
                    "api", 
                    $this->getPath()
                ]))
            )
        ];
    }
}
