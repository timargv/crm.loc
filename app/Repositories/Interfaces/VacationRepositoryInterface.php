<?php


namespace App\Repositories\Interfaces;


interface VacationRepositoryInterface
{

    public function getVacationById($vacationId);

    public function getVacationByIdAndUserId($vacationId, $userId);

    public function getVacationsPaginate($perPage = null);

    public function getVacationsWhereStatusPaginate($status, $perPage = null);

    public function getVacationsWhereStatusAndUserIdPaginate($status, $userId, $perPage = null);

    public function getVacationsWhereUserIdPaginate(int $userId, int $perPage = null);

}
