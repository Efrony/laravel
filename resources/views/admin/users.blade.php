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
                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}" class="btn btn-outline-success btn-sm mb-2">
                            Редактировать
                        </a>
                        <br>

                        <button class="user-admin-button btn btn-outline-info btn-sm mb-2 " data-id="{{ $user->id }}">
                            @if($user->admin) <b>Сделать обычным пользователем</b>
                            @else <b>Сделать администратором</b>
                            @endif
                        </button>

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

    <script>
        let  userAdminButton = document.getElementsByClassName('user-admin-button');
        userAdminButton.forEach((button) => {
            button.addEventListener('click', () => {
                console.log(button);
                let id = button.dataset.id;
                console.log(id);
                (async () => {
                    const response = await fetch('/api/user-admin/?id=' + id);
                    const answer = await response.json();
                    console.log(answer);
                })();
            });
        });
    </script>
@endsection
