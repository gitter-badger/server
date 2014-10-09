<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\PhotosRepository;

class PhotoService extends AbstractService {

    /**
     * @var PhotosRepository
     */
    protected $repository;

    public function __construct(PhotosRepository $repository)
    {
        $this->repository = $repository;
    }

    public function allWithUsers()
    {
        return $this->repository->allWithUsers();
    }

}
