@extends('layouts.main')

@section('active_admin')
    {{ 'active' }}
@endsection

@section('content')

    <div class="form-inline">
        <input id="link" value="" name="link" class="col-7 form-control mb-2 mr-4" type="text" placeholder="Ссылка на ресурс">
        <a href="" class="btn btn-outline-info mb-2 mr-2"> Добавить ресурс</a>
        <a href="" class="btn btn-outline-success mb-2"> Обновить новости со всех ресурсов </a>
    </div>


        <table class="table mt-3">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Link</th>
                    <th scope="col">X</th>
                </tr>
            </thead>
            <tbody>
                @forelse($resources as $resource)
                    <tr>
                        <th scope="row">{{ $resource->id }}</th>
                        <td>{{ $resource->created_at }}</td>
                        <td>{{ $resource->link }}</td>
                        <td><button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button></td>
                    </tr>
                @empty
                    <h2>Пользователей нет</h2>
                @endforelse
            </tbody>
        </table>
    <div class="pagination-custom">{{ $resources->links() }}</div>

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
