@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} Vehicle
    </div>

    <div class="card-body">
        <form action="{{ route("admin.vehicle.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }} / Type*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($vehicle) ? $user->number : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                <label for="number">Number*</label>
                <input type="text" id="number" name="number" class="form-control" value="{{ old('number', isset($vehicle) ? $user->number : '') }}">
                @if($errors->has('number'))
                    <em class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </em>
                @endif
                <p class="helper-block">
                   {{-- enter number --}}
                </p>
            </div>
            <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                <label for="date">Date*</label>
                <input type="date" id="date" name="date" class="form-control" value="{{ old('date', isset($vehicle) ? $user->date : '') }}">
                @if($errors->has('date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </em>
                @endif
                <p class="helper-block">
                   {{-- enter date --}}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection