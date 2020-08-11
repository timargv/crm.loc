@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts._nav')
            <div class="card">
                <div class="card-header">
                    Все Пользователи
                </div>

                <div class="card-body p-0">
                    @if(sizeof($users))
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ФИО</th>
                                <th scope="col">Email</th>
                                <th scope="col">Роль</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th class="align-middle" scope="row">{{ $user->id }}</th>
                                    <td class="align-middle">{{ $user->getFullName() }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->roleLists()[$user->role] }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex">
                                            @if(auth()->user()->isAdmin())
                                                <form method="POST" action="{{ route('admin.users.change.role', $user) }}" class="form-inline mr-3">
                                                    @csrf
                                                    <select name="roles" class="form-control form-control-sm" onchange="this.form.submit()">
                                                        <option selected disabled>Выберите роль</option>
                                                        @foreach($user->roleLists() as $key => $label)
                                                            <option value="{{ $key }}">{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                </form>
                                                <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="form-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Удалить</button>
                                                </form>
                                            @endif
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
