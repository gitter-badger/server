<?php
namespace PhotoTresor\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;

interface ServiceInterface {

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
     * @param array $data
     * @return Model
     */
    public function create(array $data);

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update($id, array $data);

    /**
     * @param int $id
     * @return boolean
     */
    public function delete($id);

    /**
     * @return MessageBag
     */
    public function errors();
} 