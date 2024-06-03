@extends('layouts.modme')

@section('title')
    Modme Token Company
@endsection

@section('content')
    <div>
        <h3 class="mx-auto" style="width: 300px;">
            Company Token
        </h3>
    </div>
    <form action="{{ route('company.store') }}" method="POST">
        @csrf
        <div class="form-group p-3">
            <label for="modme_token" class="p-2">Modme Token </label>
            <input type="text" class="form-control" id="modme_token" name="modme_token" placeholder="modme_token">
        </div>
{{--        qolgan ma'lumotlarni API orqali olamiz--}}
{{--        <div class="form-group p-3">--}}
{{--            <label for="name" class="p-2">O'quv Markaz nomi</label>--}}
{{--            <input type="text" class="form-control" id="name" name="name" placeholder="name">--}}
{{--        </div>--}}
{{--        <div class="form-group p-3">--}}
{{--            <label for="modme_company_id" class="p-2">Company Modme Id </label>--}}
{{--            <input type="number" class="form-control" id="modme_company_id" name="modme_company_id" placeholder="modme_company_id">--}}
{{--        </div>--}}

{{--        <div class="form-group p-3">--}}
{{--            <label for="tariff" class="p-2">Tariff</label>--}}
{{--            <input type="text" class="form-control" id="tariff" name="tariff" placeholder="tariff">--}}
{{--        </div>--}}

        <button type="submit" class="btn btn-primary m-3">Submit</button>
    </form>

@endsection
