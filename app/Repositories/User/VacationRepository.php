<?php


namespace App\Repositories\User;


use App\Entity\UserCapability\Vacation as Model;
use App\Repositories\CoreRepository;
use App\Repositories\Interfaces\VacationRepositoryInterface;

class VacationRepository extends CoreRepository implements VacationRepositoryInterface
{

    protected function getModelClass() : string
    {
        return Model::class;
    }

    public function getVacationById($vacationId)
    {
        $column = ['*'];

        return $this->startConditions()
            ->select($column)
            ->with('user')
            ->find($vacationId);
    }

    public function getVacationByIdAndUserId($vacationId, $userId)
    {
        $column = ['*'];

        return $this->startConditions()
            ->select($column)
            ->where([
                ['id', $vacationId],
                ['user_id', $userId]
            ])
            ->with('user')
            ->first();
    }

    public function getVacationsPaginate($perPage = null)
    {
        $column = ['*'];

        return $this->startConditions()
            ->select($column)
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public function getVacationsWhereStatusPaginate($status, $perPage = null)
    {
        $column = ['*'];

        return $this->startConditions()
            ->select($column)
            ->where('status', $status)
            ->orderBy('id', 'DESC')
            ->with('user')
            ->paginate($perPage);
    }

    public function getVacationsWhereStatusAndUserIdPaginate($status, $userId, $perPage = null)
    {
        $column = ['*'];
        return $this->startConditions()
            ->select($column)
            ->where([
                ['status', $status],
                ['user_id', $userId]
            ])
            ->orderBy('id', 'DESC')
            ->with('user')
            ->paginate($perPage);
    }

    public function getVacationsWhereUserIdPaginate(int $userId, int $perPage = null)
    {
        $column = ['*'];
        return $this->startConditions()
            ->select($column)
            ->where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->paginate($perPage);
    }
}
