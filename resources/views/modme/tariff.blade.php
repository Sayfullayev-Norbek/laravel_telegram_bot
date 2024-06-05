@extends('layouts.modme')

@section('title')
    Tariff
@endsection

@section('content')

    <form action="{{ route('tariff_create') }}" method="POST">
        @csrf
        {{-- <div>
            <label for="modme_token">Modme Token:</label>
            <input type="text" id="modme_token" name="modme_token" required>
        </div> --}}
        <div class="col-6">
            <div class="col-lg-8 p-5">
                <label for="tariff">Tariff:</label>
                <select id="tariff" name="tariff" required>
                    <option value="zo'r">Base</option>
                    <option value="o'rtacha">O'rtacha</option>
                    <option value="arzon">Arzon</option>
                </select>
            </div>
            <div class="col-lg-4 p-5">
                <label for="terms">
                    <input type="checkbox" id="terms" name="terms" required> Shartlarga roziman
                </label>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection
