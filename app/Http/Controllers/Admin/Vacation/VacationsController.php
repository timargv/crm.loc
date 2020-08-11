<?php

namespace App\Http\Controllers\Admin\Vacation;

use App\Entity\UserCapability\Vacation;
use App\Http\Controllers\Controller;
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

    public function index (Request $request)
    {
        $vacations = $this->repository->getVacationsPaginate(15);

        if (!empty($value = $request->get('status'))) {
            $vacations = $this->repository->getVacationsWhereStatusPaginate($value, 15);
        }

        return view('admin.vacations.home', compact('vacations'));
    }

    public function show (Vacation $vacation)
    {
        return view('admin.vacations.show', compact('vacation'));
    }

    public function editForm (Vacation $vacation)
    {
        return view('admin.vacations.form._edit', compact('vacation'));
    }

    public function edit (Vacation $vacation, UpdateRequest $request)
    {
        try {
            $this->service->edit($vacation->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.vacations.home')->with('success', 'Обновлено');
    }

    public function statusNoCompleted (Vacation $vacation)
    {
        try {
            $this->service->statusNoCompleted($vacation->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.vacations.home')->with('success', 'Статус не подтвержден');
    }

    public function statusCompleted (Vacation $vacation)
    {
        try {
            $this->service->statusCompleted($vacation->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.vacations.home')->with('success', 'Статус подтвержден');
    }


    public function destroy (Vacation $vacation)
    {
        $this->service->remove($vacation->id);
        return redirect()->route('admin.vacations.home')->with('success', 'Удалено');
    }

}
