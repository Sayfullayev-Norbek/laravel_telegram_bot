@extends('layouts.modme')

@section('title')
    Statistika
@endsection

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1>Statistika Dashboard</h1>
                <div class="mb-3">
                    <a href="#" class="btn btn-primary">Statistika</a>
                    <a href="#" class="btn btn-secondary">Bot ulangan guruhlar ro'yhati</a>
                    <a href="https://t.me/guruh_chat_nomer_bot?start={{ $data['modme_company_id'] }}" class="btn btn-info">
                        Bot shaxsiy link
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                @if (!empty($groups))
                <h2>Telegram Guruh Jadvali</h2>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Guruh Nomi</th>
                            <th>Guruh ID</th>
                            <th>Qo'shilgan Sana</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                            <tr>
                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                <td>{{ $group->company_id }}</td>
                                <td>{{ $group->telegram_chat_id }}</td>
                                <td>{{ $group->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h3>
                        sizda hali guruhlar yuq
                    </h3>
                @endif
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h2>Yangi Guruh Qo'shish</h2>
                <form action="{{route('companyCreate')}}" method="GET">
                    @csrf
                    <div class="form-group mt-2">
                        <input type="hidden" class="form-control" name="company_id" value="{{ $data['modme_company_id'] }}">
                    </div>
                    <div class="form-group mt-2">
                        <label for="telegram_chat_id">Guruh ID</label>
                        <input type="number" class="form-control" id="telegram_chat_id" name="telegram_chat_id" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-4">Qo'shish</button>
                </form>
            </div>
        </div>
    </div>


@endsection
