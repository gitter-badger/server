<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\PhotoRepository;

class PhotoService extends Service {

    /**
     * @var PhotoRepository
     */
    private $repository;

    public function __construct(PhotoRepository $repository)
    {
        $this->repository = $repository;
    }

}
