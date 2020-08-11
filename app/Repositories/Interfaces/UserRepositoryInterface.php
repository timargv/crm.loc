<?php


namespace App\Repositories\Interfaces;


interface UserRepositoryInterface
{

    public function getUserById($id);

    public function getUserByEmail($email);


    /**
     * Получить всех пользователей по сортировке
     * столбцу по дефолту - id
     * с необязательной пагинацией
     * @param string $orderBy
     * @param string $sortBy
     * @param null $perPage
     * @return mixed
     */
    public function getUserOrderByColumnPaginate($orderBy = 'id', $sortBy = 'ASC', $perPage = null);

}
