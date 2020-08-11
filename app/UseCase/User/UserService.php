<?php


namespace App\UseCase\User;


use App\Entity\User;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $repository;
    private $vacationRepository;

    public function __construct(UserRepositoryInterface $repository,
                                VacationRepositoryInterface $vacationRepository)
    {
        $this->repository = $repository;
        $this->vacationRepository = $vacationRepository;
    }


    public function create(CreateRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'surname' => $request['name'],
            'patronymic' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return $user;
    }

    public function edit($userId, UpdateRequest $request)
    {
        $user = $this->repository->getUserById($userId);

        if (!$user)
            throw new \DomainException('Пользователь не найден');


        if (!array_key_exists($request['rule'], User::roleLists()))
            throw new \DomainException('Роль пользователя не выбран');

        $user->update([
            'name' => $request['name'],
            'surname' => $request['name'],
            'patronymic' => $request['name'],
            'role' => $request['rule'],
            'password' => Hash::make($request['password']),
        ]);

        return $user;
    }


    public function remove($userId)
    {
        $user = $this->repository->getUserById($userId);
        if (!$user)
            throw new \DomainException('Пользователь не найден');

        $user->delete();
    }

    public function changeRole($userId, Request $request)
    {
        $request->validate([
            'roles' => 'required|string'
        ]);

        $user = $this->repository->getUserById($userId);
        if (!$user)
            throw new \DomainException('Пользователь не найден');

        User::whereId($userId)->update([
            'role' => (string) $request->get('roles'),
        ]);

    }

}
