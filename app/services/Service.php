<?php
namespace PhotoTresor\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;

abstract class Service implements ServiceInterface {

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
        // TODO: Implement create() method.
    }

    /**
     * @param array $input
     * @return Model
     */
    public function update(array $input)
    {
        // TODO: Implement update() method.
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
        // TODO: Implement errors() method.
    }
}