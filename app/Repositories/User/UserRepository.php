<?php


namespace App\Repositories\User;


use App\Entity\User as Model;
use App\Repositories\CoreRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends CoreRepository implements UserRepositoryInterface
{

    protected function getModelClass() : string
    {
        return Model::class;
    }


    public function getUserById($id)
    {
        return $this->startConditions()->where('id', $id)->first();
    }

    public function getUserByEmail($email)
    {
        $column = ['*'];

        return $this->startConditions()
            ->select($column)
            ->where('email', $email)
            ->first();
    }

    public function getUserOrderByColumnPaginate($orderBy = 'id', $sortBy = 'ASC', $perPage = null)
    {
        $column = ['*'];

        return $this->startConditions()
            ->select($column)
            ->orderBy($orderBy, $sortBy)
            ->paginate($perPage);
    }
}
