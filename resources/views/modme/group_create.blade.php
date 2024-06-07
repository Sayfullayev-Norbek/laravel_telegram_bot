<div class="row mt-5">
    <div class="col-12">
        <h2>Yangi Guruh Qo'shish</h2>
        <form action="{{route('groupCreate', ['modme_id' => $modme_id, 'token' => $token]) }}" method="POST">
            @csrf
            <div class="form-group mt-2">
                <input type="hidden" class="form-control" name="company_id" value="{{ $data['modme_company_id'] ?? $data['company_id']}}">
            </div>
            <div class="form-group mt-2">
                <label for="telegram_chat_id">Guruh ID</label>
                <input type="number" class="form-control" id="telegram_chat_id" name="telegram_chat_id" required>
            </div>
            <button type="submit" class="btn btn-success mt-4">Qo'shish</button>
        </form>
    </div>
</div>
