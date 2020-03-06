@extends('layouts.main')

@section('active_admin')
    {{ 'active' }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ 'Редактировать пользователя' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ 'Имя' }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name ?? '' }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ 'E-Mail' }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email ?? '' }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input name='admin' type='hidden' value='0'>
                            <input name="admin" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1"
                                   @if(isset($user) && $user->admin == 1) checked @endif
                                   @if(old('admin') == 1) checked @endif>
                            <label class="form-check-label" for="inlineCheckbox1">Пользователь является администратором</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Изменить профиль' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
