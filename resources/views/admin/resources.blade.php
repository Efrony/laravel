@extends('layouts.main')

@section('active_admin')
    {{ 'active' }}
@endsection

@section('content')

    <div class="form-inline">
        <input id="input-resource" value="" name="link" class="col-7 form-control mb-2 mr-4" type="text" placeholder="Ссылка на ресурс">
        <button id="create-resource" class="btn btn-outline-info mb-2 mr-2"> Добавить ресурс</button>
        <a href="{{ route('admin.resources.load') }}" class="btn btn-outline-success mb-2"> Загрузить свежие новости </a>
    </div>


        <table class="table mt-3">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Link</th>
                    <th scope="col">Удалить</th>
                </tr>
            </thead>
            <tbody>
                @forelse($resources as $resource)
                    <tr id="{{ $resource->id }}">
                        <th scope="row">{{ $resource->id }}</th>
                        <td>{{ $resource->created_at }}</td>
                        <td>{{ $resource->link }}</td>
                        <td><button data-id="{{ $resource->id }}" class="btn btn-outline-danger btn-sm delete-resource">X</button></td>
                    </tr>
                @empty
                    <h2>Пользователей нет</h2>
                @endforelse
            </tbody>
        </table>

    <script>
        deleteButtons();
        let createButton = document.getElementById('create-resource');
        createButton.addEventListener('click', () => {
            let link = document.getElementById('input-resource').value;
            fetch('/api/create-resource', {
                method: 'POST',
                headers: {
                    "content-type": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    'link': link,
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'ok') {
                        let table = document.querySelector('tbody');
                        let row = document.createElement('tr');
                        row.setAttribute('id', data.id);

                        let info =`
                            <th scope="row">${data.id}</th>
                            <td>${data.created_at}</td>
                            <td>${data.link}</td>
                            <td><button data-id="${data.id}" class="btn btn-outline-danger btn-sm delete-resource">X</button></td>`;

                        row.innerHTML = info;
                        table.insertAdjacentElement('afterbegin', row);
                        document.getElementById('input-resource').value = '';
                        deleteButtons();
                    }
                })
        });

        function deleteButtons() {
            let deleteButtons = document.querySelectorAll('.delete-resource');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    let id = button.dataset.id;
                    fetch('/api/delete-resource', {
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
                            let row = document.getElementById(data.id);
                            row.remove();
                        })
                });
            });
        }
    </script>
@endsection
