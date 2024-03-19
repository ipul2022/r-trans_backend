<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Driver;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shop = Order::where('status','diproses')
        ->where('service','R-Shop')
        ->with('user:id,name')
        ->paginate(10);


        return view('pages.shop.index', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::where('status','diproses')
        ->where('service','R-Shop')
        ->with('user:id,name')
        ->get();
        $receipt = Driver::where('status','off')->get();
        return view('pages.shop.create',compact('orders','receipt'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $profile = new Receipt;
        // $profile->jarak = $request->input('jarak');
        // $profile->tarif = $request->input('tarif');
        $profile->service = $request->input('service');
        $profile->driver_id = $request->input('driver_id');
        $profile->order_id = $request->input('order_id');
        $profile->user_id = $request->input('user_id');
        $profile->save();
   $request->validate([
           'status' => 'selesai',
        ]);
        $user = Order::find($profile->order_id);
        $user->status = 'selesai';
        $user->update();
        $request->validate([
            'status' => 'on',
         ]);
        $user = Driver::find($profile->driver_id);
        $user->status = 'on';
        $user->update();
        return redirect()->route('receipt.index')->with('success', 'Your info are updated');

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
