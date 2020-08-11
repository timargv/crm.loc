<?php

namespace App\Http\Controllers\Cabinet\Vacation;

use App\Entity\UserCapability\Vacation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vacation\CreateRequest;
use App\Http\Requests\Vacation\UpdateRequest;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use App\UseCase\User\Capability\Vacation\VacationService;
use Illuminate\Http\Request;

class VacationsController extends Controller
{

    private $service;
    private $repository;

    public function __construct(VacationService $service,
                                VacationRepositoryInterface $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    public function index()
    {
        $vacations = $this->repository->getVacationsWhereUserIdPaginate(\Auth::id(), 15);
        return view('cabinet.vacations.home', compact('vacations'));
    }

    public function show(Vacation $vacation)
    {
        $this->checkOwnVacation($vacation);
        $vacations = $this->repository->getVacationById($vacation->id);
        return view('cabinet.vacations.show', compact('vacations'));
    }

    public function createForm()
    {
        return view('cabinet.vacations.form._create');
    }

    public function create(CreateRequest $request)
    {
        try {
            $this->service->create(\Auth::id(), $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.vacations.home')->with('success', 'Добавлено');
    }


    public function editForm(Vacation $vacation)
    {
        $this->checkOwnVacation($vacation);
        $vacations = $this->repository->getVacationById($vacation->id);
        return view('cabinet.vacations.form._edit', compact('vacations'));
    }

    public function edit(Vacation $vacation, UpdateRequest $request)
    {
        $this->checkOwnVacation($vacation);
        try {
            $this->service->edit($vacation->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('cabinet.vacations.home')->with('success', 'Обновлено');
    }

    public function destroy(Vacation $vacation)
    {
        $this->checkOwnVacation($vacation);
        $this->service->remove($vacation->id);
        return redirect()->route('cabinet.vacations.home')->with('success', 'Удалено');
    }

    private function checkOwnVacation (Vacation $vacation) : void
    {
        if (!\Gate::allows('own_vacation',$vacation)) {
            abort(401, 'У Вас нет такой записи');
        }
    }
}
