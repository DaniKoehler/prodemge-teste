<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $persons = Person::all();
        return response()->json($persons);
    }

    public function store(Request $request)
    {
        $person = new Person();
        $person->fill($request->all());
        $person->save();
        return response()->json($person, 201);
    }

    public function show($id)
    {
        $person = Person::all()->where('id', $id)->first();

        if ($person) {
            return response()->json($person);
        } else {
            return response()->json(['error' => 'Person not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $person = Person::all()->where('id', $id)->first();

        if ($person) {
            $person->fill($request->all());
            $person->save();
            return response()->json($person);
        } else {
            return response()->json(['error' => 'Person not found'], 404);
        }
    }

    public function destroy($id)
    {
        $person = Person::all()->where('id', $id)->first();

        if ($person) {
            $person->delete();
            return response()->json(['message' => 'Person deleted successfully']);
        } else {
            return response()->json(['error' => 'Person not found'], 404);
        }
    }
}
