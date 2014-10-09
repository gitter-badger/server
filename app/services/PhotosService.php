<?php
namespace PhotoTresor\Services;

use PhotoTresor\Repositories\PhotosRepository;
use PhotoTresor\Repositories\RepositoryInterface;
use PhotoTresor\Validators\PhotosValidator;
use PhotoTresor\Validators\ValidatorInterface;

class PhotosService extends AbstractService {

    public function __construct(PhotosRepository $photosRepository, PhotosValidator $photosValidator)
    {
        parent::__construct($photosRepository, $photosValidator);
    }

    public function allWithUsers()
    {
        return $this->repository->allWithUsers();
    }

}
