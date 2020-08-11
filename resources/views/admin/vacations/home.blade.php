@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts._nav')
            <div class="card">
                <div class="card-header">
                    Все Отпуска
                    <div class="float-right">
                        <a href="{{ route('cabinet.vacations.create') }}" class="btn btn-sm btn-primary m-0">Добавить</a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if(sizeof($vacations))
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ФИО</th>
                                <th scope="col">Статус</th>
                                <th scope="col">От</th>
                                <th scope="col">До</th>
                                <th width="220px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vacations as $vacation)
                                <tr>
                                    <th class="align-middle" scope="row">{{ $vacation->id }}</th>
                                    <td class="align-middle">{{ $vacation->getUserFullName() }}</td>
                                    <td class="align-middle">{{ $vacation->statusLists()[$vacation->status] }}</td>
                                    <td class="align-middle">{{ $vacation->date_from->format('d.m.Y') }}</td>
                                    <td class="align-middle">{{ $vacation->date_to->format('d.m.Y') }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex">

                                            @if($vacation->isWait() || $vacation->isNotCompleted())
                                                <form method="POST" action="{{ route('admin.vacations.status.completed', $vacation) }}" class="form-inline ml-2">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">Подтвердить</button>
                                                </form>
                                            @endif
                                            @if($vacation->isCompleted())
                                            <form method="POST" action="{{ route('admin.vacations.status.wait', $vacation) }}" class="form-inline ml-2">
                                                @csrf
                                                <button class="btn btn-warning btn-sm">Не Подтвердить</button>
                                            </form>
                                            @endif

                                            <form method="POST" action="{{ route('admin.vacations.delete', $vacation) }}" class="form-inline ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Удалить</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-5 text-center">Пусто</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
