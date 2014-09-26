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

    /**
     * @return MessageBag
     */
    public function errors();
} 