<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Driver;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receipt = Receipt::where('status','Active')
        ->with('driver:id,name','user:id,name','order:id,service')
        ->paginate(10);
        return view('pages.receipt.index', compact('receipt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::where('status','diproses')
        ->where('service','R-Ride')
        ->with('user:id,name')
        ->get();
        $receipt = Driver::where('status','off')->get();
        return view('pages.receipt.create',compact('orders','receipt'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'jarak' => 'required|string',
        //     'tarif' => 'required|string',
        //     'driver_id' => 'required',
        //     'order_id' => 'required',
        //     'user_id' => 'required',
        // ]);

        // Receipt::create([
        //     'jarak' => $request->jarak,
        //     'tarif' => $request->tarif,
        //     'driver_id' => $request->driver_id,
        //      'order_id' => $request->order_id,
        //     'user_id' => $request->user_id,
        // ]);

        // return redirect(route('receipt.index'))->with('success', 'Send Order Successfully');
        $profile = new Receipt;
        $profile->jarak = $request->input('jarak');
        $profile->tarif = $request->input('tarif');
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
