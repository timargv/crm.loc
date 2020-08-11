@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts._nav')
            <div class="card">
                <div class="card-header ">
                    Добавить планируемый отпуск
                </div>

                <div class="card-body">
                    <form action="{{ route('cabinet.vacations.create') }}" method="POST" >
                        @csrf
                        <div class="form-group">
                            <label for="date_from">От</label>
                            <input id="date_from" class="form-control" value="{{ old('date_from') }}" name="date_from" type="date" />
                        </div>
                        <div class="form-group">
                            <label for="date_to">До</label>
                            <input id="date_to" class="form-control" value="{{ old('date_to') }}" name="date_to" type="date" />
                        </div>

                        <button class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
