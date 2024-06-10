<div class="row mt-4">
    <div class="col-12" id="list">
        @if (!empty($groups) && $groups->count() > 0)
            <h2>Telegram Guruh Jadvali</h2>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Company ID</th>
                        <th>Guruh ID</th>
                        <th>Bot Start</th>
                        <th>Qo'shilgan Sana</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $group->company_id }}</td>
                            <td>{{ $group->telegram_chat_id }}</td>
                            <td>
                                <a href="https://t.me/guruh_chat_nomer_bot?start={{ $group->telegram_chat_id }}">
                                    <https: href="">https://t.me/guruh_chat_nomer_bot?start={{ $group->telegram_chat_id }}
                                </a>
                            </td>
                            <td>{{ $group->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3>
                Sizda hali guruhlar yuq
            </h3>
        @endif
    </div>
</div>
