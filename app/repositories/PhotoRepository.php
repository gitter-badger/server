<?php
namespace PhotoTresor\Repositories;

use Photo;

class PhotoRepository {

    /**
     * @var Photo
     */
    protected $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    public function all(array $options)
    {
        $this->order();

        if(isset($options['expand']) && $options['expand'] == 'user') {
            $this->expandUser();
        }

        return $this->photo->get();
    }

    public function expandUser()
    {
        $this->photo = $this->photo->with('User');
    }

    public function order()
    {
        $this->photo = $this->photo->orderBy('captured_at', 'DESC');
    }

}
