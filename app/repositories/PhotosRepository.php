<?php
namespace PhotoTresor\Repositories;

use Photo;

class PhotosRepository extends AbstractRepository {

    protected $model;

    public function __construct(Photo $photo)
    {
        $this->model = $photo;
    }

    /**
     * @return Photo
     */
    public function allWithUsers()
    {
        return $this->model->with('User')->get();
    }

}
