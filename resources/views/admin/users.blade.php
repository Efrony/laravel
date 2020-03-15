@extends('layouts.main')

@section('active_admin')
    {{ 'active' }}
@endsection

@section('content')

        @forelse($users as $user)
            @if($user->id == Auth::id()) @continue @endif
                <div class="card">
                    <div class="card-body" id="{{ $user->id }}">
                        <h5 class="card-title">{{ $user->name }} <b>@if($user->admin) (Админ)<br> @endif </b></h5>
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
        let  userAdminButton = document.querySelectorAll('.user-admin-button');
        userAdminButton.forEach((button) => {
            button.addEventListener('click', () => {
                let id = button.dataset.id;

                fetch('/api/user-admin', {
                    method: 'POST',
                    headers: {
                        "content-type": "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        'id': id,
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        card = document.getElementById(data.id);
                        if (data.admin == 1) {
                            card.querySelector('button').innerHTML = '<b>Сделать обычным пользователем</b>';
                            card.querySelector('h5').querySelector('b').textContent = '(Админ)';
                        } else {
                            card.querySelector('button').innerHTML = '<b>Сделать администратором</b>';
                            card.querySelector('h5').querySelector('b').textContent = '';
                        }
                    })
            });
        });
    </script>
@endsection
