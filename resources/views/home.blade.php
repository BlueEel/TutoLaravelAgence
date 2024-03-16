@extends('base')

@section('content')

    <div class="bg-light p-5 mb-5 text-center">
        <div class="container">
            <h1>Agence Immo</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, reiciendis quas at libero totam iste a suscipit illo officia aliquam consequatur sequi dolorem ipsam ex, numquam aperiam, eum mollitia nisi.</p>
        </div>
    </div>

    <div class="container">
        <h2>Nos derniers biens</h2>
        <div class="row">
            @foreach ($properties as $property)
            <div class="col">
                @include('property.card')
            </div>
            @endforeach
        </div>
    </div>

@endsection
