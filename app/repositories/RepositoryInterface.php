<?php
namespace PhotoTresor\Repositories;

interface RepositoryInterface {

    /**
     * @return Collection
     */
    public function all();

    /**
     * @param int $id
     * @return Model
     */
    public function find($id);

    /**
     * @param array $input
     * @return Model
     */
    public function create(array $input);

    /**
     * @param array $input
     * @return Model
     */
    public function update(array $input);

    /**
     * @param int $id
     * @return boolean
     */
    public function delete($id);
} 