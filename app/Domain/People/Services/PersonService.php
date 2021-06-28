<?php

namespace App\Domain\People\Services;

use App\Domain\Abstracts\Service;
use App\Domain\People\Entities\Person;
use App\Domain\People\Interfaces\Repositories\PersonRepository;
use App\Domain\People\Interfaces\Repositories\PhoneRepository;
use App\Domain\People\Interfaces\Services\PersonService as IPersonService;
use Exception;
use Illuminate\Support\Facades\DB;

class PersonService extends Service implements IPersonService
{
    /**
     * @var array
     */
    protected $rules = [
        "id" => "nullable|integer|min:1",
        "name" => "required|max:191",
        "phones" => "required|array|min:1",
        "phones.*.number" => "required|size:7",
    ];

    /**
     * @var PhoneRepository
     */
    private $phoneRepository;

    /**
     * @return void
     */
    public function __construct(PersonRepository $personRepository, PhoneRepository $phoneRepository)
    {
        parent::__construct($personRepository);
        $this->phoneRepository = $phoneRepository;
    }

    /**
     * @param  array $attributes
     * @return Person
     */
    public function store(array $attributes): Person
    {
        try {
            DB::beginTransaction();

            $person = parent::store($attributes);

            foreach ($attributes["phones"] as $phone) {
                $this->phoneRepository->store($phone + ["person_id" => $person->id]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return $person;
    }
}
