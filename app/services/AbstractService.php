<?php
namespace PhotoTresor\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\MessageBag;
use PhotoTresor\Repositories\RepositoryInterface;
use PhotoTresor\Validators\ValidationException;
use PhotoTresor\Validators\ValidationInterface;

abstract class AbstractService implements ServiceInterface {

    protected $errors;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var ValidationInterface
     */
    protected $validator;

    public function __construct(RepositoryInterface $repository, ValidationInterface $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * @param int $id
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param array $data
     * @return Model
     *
     * @throws ValidationException
     */
    public function create(array $data)
    {
        $this->validator->validate($data);

        return $this->repository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model
     *
     * @throws ModelNotFoundException
     * @throws ValidationException
     */
    public function update($id, array $data)
    {
        $this->validator->validate($data);

        return $this->repository->update($id, $data);
    }

    /**
     * @param int $id
     * @return boolean
     *
     * @throws ModelNotFoundException
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @return MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }
}