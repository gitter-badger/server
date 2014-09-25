<?php
namespace PhotoTresor\Repositories;

use Photo;

class PhotoRepository {

    protected $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    public function all()
    {
        return $this->photo->get();
    }

    public function allWithUsers()
    {
        return $this->photo->with('User')->get();
    }

}
