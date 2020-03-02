@extends('layouts.main')

@section('active_admin')
    {{ 'active' }}
@endsection

@section('content')
        <form method="POST" action="@if (isset($oneNews)) {{ route('admin.news.save', $oneNews) }} @else {{ route('admin.news.create') }} @endif" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">
                    @if($errors->has('category'))
                        <span style="color: red">
                            @foreach($errors->get('category') as $error)
                                {{ $error}}
                            @endforeach
                        </span>
                    @else Выберите категорию
                    @endif
                </label>
                <select name="category" class="form-control" id="exampleFormControlSelect1">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if(isset($oneNews) && $oneNews->category == $category->id) selected @endif
                                    @if($category->id == old('category')) selected @endif>
                                {{ $category->title }}
                            </option>
                        @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">
                    @if($errors->has('title'))
                        <span style="color: red">
                            @foreach($errors->get('title') as $error)
                                {{ $error}}
                            @endforeach
                        </span>
                    @else Заголовок
                    @endif
                </label>
                <input value="{{ $oneNews->title ?? old('title') }}" name="title" class="form-control" type="text" placeholder="Заголовок">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">
                    @if($errors->has('text'))
                        <span style="color: red">
                            @foreach($errors->get('text') as $error)
                                {{ $error}}
                            @endforeach
                        </span>
                    @else Описание новости
                    @endif
                </label>
                <textarea  name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"
                >{{ $oneNews->text ?? old('text') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image-for-news">
                    @if($errors->has('image'))
                        <span style="color: red">
                            @foreach($errors->get('image') as $error)
                                {{ $error}}
                            @endforeach
                        </span>
                    @else Изображение для новости:
                    @endif
                </label>
                <input type="file" name="image" id="image-for-news">
            </div>

            <div class="form-check form-check-inline">
                <input name='private' type='hidden' value='0'>
                <input name="private" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1"
                       @if(isset($oneNews) && $oneNews->private == 1) checked @endif
                       @if(old('private') == 1) checked @endif>
                <label class="form-check-label" for="inlineCheckbox1">Новость видна только авторизованным пользователям</label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-top: 30px" >
                @if (isset($oneNews)) Редактировать @else Добавить @endif новость

            </button>
        </form>
@endsection

