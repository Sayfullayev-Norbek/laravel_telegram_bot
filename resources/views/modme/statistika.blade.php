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
                    <a href="#" class="btn btn-primary">
                        Statistika
                        @if($leads)
                            <?php $i = 0; ?>
                            @foreach ($leads as $lead)
                                <?=++$i?>
                            @endforeach
                        @endif
                    </a>
                    <a href="#list" class="btn btn-secondary">Bot ulangan guruhlar ro'yhati</a>
                    <a href="https://t.me/guruh_chat_nomer_bot?start={{ $data['modme_company_id'] ?? $data['company_id'] }}-{{ $modme_branch_id['modme_branch_id'] }}"class="btn btn-info">
                        https://t.me/guruh_chat_nomer_bot?start={{ $data['modme_company_id'] ?? $data['company_id'] }}-{{ $modme_branch_id['modme_branch_id'] }}
                    </a>
                </div>
            </div>
        </div>

        @include('modme.list')

        @include('modme.group_create')
    </div>

@endsection
