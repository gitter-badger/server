<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\PhotoRepository;

class PhotoService extends AbstractService {

    /**
     * @var PhotoRepository
     */
    protected $repository;

    public function __construct(PhotoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function allWithUsers()
    {
        return $this->repository->allWithUsers();
    }

}