<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $price = Price::all();
        return view('pages.price.index', compact('price'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.price.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required',
        ]);

        Price::create($request->all());
        return redirect()->route('pages.subjects.index')->with('success', 'price created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        return view('pages.price.edit')->with('price', $price);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PriceRequest $request, Price $price)
    {
        $validate = $request->validated();
        $price->update($validate);
        return redirect()->route('price.index')->with('success', 'Edit Price Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function get_price()
    {
        $user   = Auth::user();
        $price  = Price::first();
        return $price;

    }
}
