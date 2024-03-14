<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admim\PropertyFormRequest;
use App\Models\Option;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property = new Property();
        $property->fill([
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'Saint-Pierre-Des-Corps',
            'postal_code' => 37700,
            'sold' => false,
        ]);
        return view('admin.properties.form', [
            'property' => $property,
            'optionsList' => Option::orderBy('name')->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property = Property::create($request->validated());
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'La propriété a bien été créée');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     // ICI on n'a pas forcément besoin d'un show car on a seulement besoin d'une édition donc on peut également supprimer cette route : il faut donc aller dans web.php et mettre une exception sur la méthode show : execpt(['show'])
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('admin.properties.form', [
            'property' => $property,
            'optionsList' => Option::orderBy('name')->pluck('name', 'id')
        ]);

        // AUTRE manière de faire
        // $optionsList = Option::query()->orderBy('name')->pluck('name', 'id');
        // return view('admin.properties.form', [
        //     'property' => $property,
        //     'optionsList' => $optionsList
        // ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->update($request->validated());
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'La propriété a bien été modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return to_route('admin.property.index')->with('success', 'La propriété a bien été supprimée');
    }
}
