<?php
namespace PhotoTresor\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;

abstract class AbstractService implements ServiceInterface {

    protected $errors;

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
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param array $input
     * @return Model
     */
    public function create(array $input)
    {
        return $this->repository->create($input);
    }

    /**
     * @param int $id
     * @param array $input
     * @return Model
     */
    public function update($id, array $input)
    {
        return $this->repository->update($id, $input);
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $this->repository->delete($id);
    }

    /**
     * @return MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }
}