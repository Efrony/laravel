@extends('layouts.main')

@section('active_add')
    {{ 'active' }}
@endsection


@section('content')
        <form>
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">Выберите категорию</label>
                <select class="form-control" id="exampleFormControlSelect1">
                        @foreach ($categories as $category)
                            <option>{{ $category['title'] }}</option>
                        @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Заголовок</label>
                <input class="form-control" type="text" placeholder="Заголовок">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Описание новости</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="private">
                <label class="form-check-label" for="inlineCheckbox1">Новость видна только зарегистрированным пользователям</label>
            </div>

            <button type="button" class="btn btn-primary btn-lg btn-block" style="margin-top: 30px" >Разместить новость</button>
        </form>
@endsection

