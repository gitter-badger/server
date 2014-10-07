<?php
namespace PhotoTresor\Repositories;

use Photo;

class PhotoRepository implements RepositoryInterface {

    protected $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return Photo
     */
    public function all()
    {
        return $this->photo->get();
    }

    /**
     * @return Photo
     */
    public function allWithUsers()
    {
        return $this->photo->with('User')->get();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find($id)
    {
        return $this->photo->findOrFail($id);
    }

    /**
     * @param array $input
     * @return Model
     */
    public function create(array $input)
    {
        return $this->photo->create($input);
    }

    /**
     * @param int $id
     * @param array $input
     * @return Model
     */
    public function update($id, array $input)
    {
        $photo = $this->find($id);

        $photo->update($input);

        return $photo;
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $photo = $this->find($id);

        return $photo->delete();
    }
}
