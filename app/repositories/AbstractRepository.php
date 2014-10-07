<?php
namespace PhotoTresor\Repositories;

abstract class AbstractRepository implements RepositoryInterface {

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $input
     * @return Model
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * @param int $id
     * @param array $input
     * @return Model
     */
    public function update($id, array $input)
    {
        $model = $this->find($id);

        $model->update($input);

        return $model;
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $model = $this->find($id);

        return $model->delete();
    }

}