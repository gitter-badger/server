<?php
namespace PhotoTresor\Repositories;

use User;

class UsersRepository implements RepositoryInterface {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->user->get();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    /**
     * @param array $input
     * @return Model
     */
    public function create(array $input)
    {
        return $this->user->create($input);
    }

    /**
     * @param int $id
     * @param array $input
     * @return Model
     */
    public function update($id, array $input)
    {
        $user = $this->find($id);

        $user->update($input);

        return $user;
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $user = $this->find($id);

        return $user->delete();
    }

}