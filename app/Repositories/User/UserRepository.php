<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 11.09.18
 * Time: 20:39
 */

namespace App\Repositories\User;

use App\Models\Db\User;


class UserRepository
{
    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return User::all();
    }

    /**
     * @param integer $id
     *
     * @return User/null
     */
    public function getById($id)
    {
        return User::find($id);
    }

    /**
     * @param array $user
     *
     * @return User|\Illuminate\Database\Eloquent\Model
     */
    public function create($userData)
    {
        return User::create($userData);
    }

    /**
     * @param integer $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteById($id)
    {
        if ($user = $this->getById($id)) {
            return $user->delete();
        }

        return false;
    }
}