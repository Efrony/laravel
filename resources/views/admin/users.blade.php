@extends('layouts.main')

@section('active_admin')
    {{ 'active' }}
@endsection

@section('content')

        @forelse($users as $user)
            @if($user->id == Auth::id()) @continue @endif
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }} @if($user->admin) <b>(Админ)</b><br> @endif</h5>
                        <p class="card-text">{{ $user->email }}</p>
                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}" class="btn btn-outline-success btn-sm">
                            Редактировать
                        </a>
                        <form method="POST" action="{{ route('admin.users.destroy', ['user' => $user]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                        </form>
                    </div>
                </div>
        @empty
            <h2>Пользователей нет</h2>
        @endforelse
    <div class="pagination-custom">{{ $users->links() }}</div>
@endsection
