<?php
namespace PhotoTresor\Repositories;

use Photo;

class PhotoRepository {

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
        return $this->photo;
    }

    /**
     * @return Photo
     */
    public function allWithUsers()
    {
        return $this->all()->with('User');
    }

}
