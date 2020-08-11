<?php

namespace App\Http\Controllers\Admin\User;

use App\Entity\User;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\UseCase\User\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $repository;
    private $service;

    public function __construct(UserRepositoryInterface $repository, UserService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $users = $this->repository->getUserOrderByColumnPaginate('id','DESC', 15);
        return view('admin.users.home', compact('users'));
    }

    public function changeRole(User $user,Request $request)
    {
        try {
            $this->service->changeRole($user->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.users.home')->with('success', 'Роль изменена');
    }

    public function destroy(User $user)
    {
        try {
            $this->service->remove($user->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.users.home')->with('success', 'Удалено');
    }
}
