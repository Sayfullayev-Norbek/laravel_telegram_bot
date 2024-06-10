@extends('layouts.modme')

@section('title')
    Tariff
@endsection

@section('content')

    <form action="{{ route('tariffStore', ['modme_id' => $modme_id, 'token' => $token]) }}" method="POST">
        @csrf
        @if (!empty($token))
            <div>
                <input type="hidden" name="token" value={{ $token }}>
            </div>
            <div>
                <input type="hidden" name="modme_id" value={{ $modme_id }}>
            </div>
        @else
        <div>
            <H1>
                Token Xato
            </H1>
        </div>
        @endif
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
