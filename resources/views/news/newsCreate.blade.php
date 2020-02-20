@extends('layouts.main')

@section('active_admin')
    {{ 'active' }}
@endsection


@section('content')
        <form method="POST" action="{{ route('news.add') }}">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">Выберите категорию</label>
                <select name="category" class="form-control" id="exampleFormControlSelect1">
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}" @if($category['id'] == old('$category')) selected @endif>
                                {{ $category['title'] }}
                            </option>
                        @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">
                    @if(old('title') == 'empty') <span style="color: red">Поле "Заголовок" обязательно для заполнения</span>
                        @else Заголовок
                    @endif
                </label>
                <input value="@if(old('title') != 'empty'){{ old('title') }} @endif" name="title" class="form-control" type="text" placeholder="Заголовок">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">
                    @if(old('text') == 'empty') <span style="color: red">Поле "Описание новости" обязательно для заполнения</span>
                        @else Описание новости
                    @endif
                </label>
                <textarea  name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"
                >@if(old('text') != 'empty'){{ old('text') }} @endif</textarea>
            </div>

            <div class="form-check form-check-inline">
                <input name="private" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1"
                       @if(old('private') == 1) checked @endif>
                <label class="form-check-label" for="inlineCheckbox1">Новость видна только авторизованным пользователям</label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 30px" >Разместить новость</button>
        </form>
@endsection

