<?php
namespace PhotoTresor\Services;

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use PhotoTresor\Repositories\PhotosRepository;
use PhotoTresor\Validators\PhotosValidator;

class PhotosService extends AbstractService {

    /**
     * @var ConfigRepository
     */
    private $config;
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(
        PhotosRepository $photosRepository,
        PhotosValidator $photosValidator,
        ConfigRepository $config,
        Filesystem $filesystem
    )
    {
        parent::__construct($photosRepository, $photosValidator);

        $this->config = $config;
        $this->filesystem = $filesystem;
    }

    public function allWithUsers()
    {
        return $this->repository->allWithUsers();
    }

    /**
     * Delete a photo from the filesystem and the database.
     *
     * @param int $id
     * @return bool
     * @throws FileNotFoundException
     * @throws ModelNotFoundException
     */
    public function delete($id)
    {
        $photo = $this->repository->find($id);

        $path = $this->config->get('phototresor.storage') . "$photo->user_id/$photo->file_sha1.jpg";

        if( ! $this->filesystem->delete($path))
        {
            throw new FileNotFoundException();
        }

        return $this->repository->delete($id);
    }

}
