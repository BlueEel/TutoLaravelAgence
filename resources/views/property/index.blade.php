@extends('base')

@section('title', 'Tous les biens')

@section('content')


    <div class="bg-light p-5 mb-5 text-center">
        <form action="" method="get" class="container d-flex gap-2">
            <input type="number" placeholder="Surface minimale" class="form-control" name="surface" value="{{ $input['price'] ?? '' }}">
            <input type="number" placeholder="Nombre de pièce min" class="form-control" name="rooms" value="{{ $input['rooms'] ?? '' }}">
            <input type="number" placeholder="Budget max" class="form-control" name="price" value="{{ $input['price'] ?? '' }}">
            <input placeholder="Mot clef" class="form-control" name="title" value="{{ $input['title'] ?? '' }}">
            <button type="submit" class="btn btn-dark btn-sm d-flex align-items-center">
                <i class="fa fa-magnifying-glass me-2"></i>
                <span>Rechercher</span>
            </button>
        </form>
    </div>

    <div class="container">
        <div class="row">
            @forelse ($properties as $property)
                <div class="col-3 mb-4">
                    @include('property.card')
                </div>
            @empty
                <div class="col text-center">
                Aucun bien ne correspond à votre recherche !
                </div>
            @endforelse
        </div>
        <div class="my-4">
            {{ $properties->links() }}
        </div>
    </div>

@endsection
