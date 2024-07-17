<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    public function fetchAll($id, Request $request)
    {
        // Verifica se o parâmetro includeSoftDeleted foi passado e é verdadeiro
        if ($request->query('includeSoftDeleted') == 'true') {
            // Busca todos os endereços, incluindo os soft deleted, para o ID da pessoa especificado
            $addresses = Address::withTrashed()->where('person_id', $id)->get();
        } else {
            // Busca apenas os endereços não deletados para o ID da pessoa especificado
            $addresses = Address::where('person_id', $id)->get();
        }

        return response()->json($addresses);
    }

    public function store(Request $request)
    {
        $address = new Address();
        $address->fill($request->all());
        $address->save();
        return response()->json($address, 201);
    }

    public function show($id)
    {
        $address = Address::all()->where('id', $id)->first();

        if ($address) {
            return response()->json($address);
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $address = Address::all()->where('id', $id)->first();

        if ($address) {
            $address->fill($request->all());
            $address->save();
            return response()->json($address);
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }

    public function destroy($id)
    {
        $address = Address::all()->where('id', $id)->first();

        if ($address) {
            $address->delete();
            return response()->json(['message' => 'Address deleted successfully']);
        } else {
            return response()->json(['error' => 'Address not found'], 404);
        }
    }
}
