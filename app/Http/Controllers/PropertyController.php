<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request)
    {
        $query = Property::query()->orderBy('created_at', 'desc');
        if ($request->validated('price')) {
            $query = $query->where('price', '<=', $request->validated('price'));
        }
        //Autre possibilité :
        // eager loading en préchargeant les options pour les faire apparaître dans la card de l'index :
        // $query = Property::query()->with('options');
        // if ($price = $request->validated('price')) {
        //     $query = $query->where('price', '<=', $price);
        // }
        if ($request->validated('surface')) {
            $query = $query->where('surface', '>=', $request->validated('surface'));
        }
        if ($request->validated('rooms')) {
            $query = $query->where('rooms', '>=', $request->validated('rooms'));
        }
        if ($request->validated('title')) {
            $query = $query->where('title', 'like', "%{$request->validated('title')}%");
        }
        return view('property.index', [
            'properties' => $query->paginate(16),
            'input' => $request->validated()
        ]);
    }

    public function show(string $slug, Property $property)
    {
        $expectedSlug = $property->getSlug();
        if ($slug != $expectedSlug) {
            return to_route('property.show', ['slug' => $expectedSlug, 'property' => $property]);
        }

        return view('property.show', [
            'property' => $property
        ]);
    }

    public function contact(Property $property, PropertyContactRequest $request)
    {
        Mail::send(new PropertyContactMail($property, $request->validated()));
        return back()->with('success', 'Votre demande de contact a bien été envoyé');
        // Cela envoie directement le mail, si l'on veut le mettre en fil d'attente il faut passer par :
        // Mail::queue(new PropertyContactMail($property, $request->validated()));
    }
}
