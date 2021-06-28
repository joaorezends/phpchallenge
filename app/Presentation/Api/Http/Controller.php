<?php

namespace App\Presentation\Api\Http;

use App\Domain\Interfaces\Service;
use App\Presentation\Core\Http\Controllers\Controller as BaseController;
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
    public function __construct() {
        $this->service = app()->make($this->getServiceClass());
        $this->path = $this->getPath();
    }

    /**
     * @return string
     */
    abstract public function getServiceClass(): string;

    /**
     * @return string
     */
    abstract public function getPath(): string;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $objects = $this->service->all();
        $this->putIndexLinks($objects);

        return $this->json($objects);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $object = $this->service->find($id);
        
        if ($object instanceof Model) {
            $this->putShowLinks($object);
        }

        return $this->json($object);
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
