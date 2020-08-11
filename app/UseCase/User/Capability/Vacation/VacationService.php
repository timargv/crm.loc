<?php


namespace App\UseCase\User\Capability\Vacation;


use App\Entity\UserCapability\Vacation;
use App\Http\Requests\Vacation\CreateRequest;
use App\Http\Requests\Vacation\UpdateRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use Carbon\Carbon;

class VacationService
{
    private $repository;
    private $userRepository;

    public function __construct(VacationRepositoryInterface $repository,
                                UserRepositoryInterface $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function create(int $userId, CreateRequest $request)
    {

        $user = $this->userRepository->getUserById($userId);

        if (!$user)
            throw new \DomainException('Пользователь не найден');

        \DB::transaction(function () use ($user, $request) {
            $vacation = Vacation::make([
                'date_from' => $request['date_from'],
                'date_to' => $request['date_to'],
            ]);

            $vacation->user()->associate($user);
            $vacation->saveOrFail();
        });
    }


    public function edit(int $vacationId, UpdateRequest $request)
    {
        $vacation = $this->repository->getVacationById($vacationId);
        if (!$vacation)
            throw new \DomainException('Запись не найдена');

        $authUser = $this->userRepository->getUserById($vacation->user->id);
        if (!$authUser && $authUser->isCapabilty() && $vacation->isCompleted())
            throw new \DomainException('Запись уже подтверждена');

        if (Carbon::parse($request['date_from']) || Carbon::parse($request['date_to']))
            throw new \DomainException('Неверная дата');

        \DB::transaction(function () use ($user, $request) {
            $vacation = Vacation::make([
                'date_from' => Carbon::createFromFormat('d.m.Y',  $request['date_from'] .' 00:00:00'),
                'date_to' => Carbon::createFromFormat('d.m.Y',  $request['date_to'] .' 00:00:00'),
                'status' => Vacation::STATUS_WAIT
            ]);

            $vacation->user()->associate($user);
            $vacation->saveOrFail();
        });
    }

    public function statusNoCompleted(int $vacationId) : void
    {
        $vacation = $this->repository->getVacationById($vacationId);

        if (!$vacation)
            throw new \DomainException('Запись не найдена');

        $vacation->update(['status' => Vacation::STATUS_NOT_COMPLETED]);
    }

    public function statusCompleted(int $vacationId) : void
    {
        $vacation = $this->repository->getVacationById($vacationId);

        if (!$vacation)
            throw new \DomainException('Запись не найдена');

        $vacation->update(['status' => Vacation::STATUS_COMPLETED]);
    }

    public function remove(int $vacationId)
    {
        $vacation = $this->repository->getVacationById($vacationId);
        $authUser = $this->userRepository->getUserById($vacation->id);

        if (!$authUser && $authUser->isCapabilty() && $vacation->isCompleted())
            throw new \DomainException('Запись нельзя удалить');

        $vacation->delete();
    }

}
