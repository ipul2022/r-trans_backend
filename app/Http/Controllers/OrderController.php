<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Resources\ReceiptResource;
use App\Http\Resources\UserResource;
use App\Models\Order;
use App\Models\Receipt;
use App\Models\RecieptOrderModel;
use App\Models\User;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//
     use AuthUserTrait;
     //
    public function create_order(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'alamat_penjemputan'=>'required',
            'alamat_tujuan'=>'required',
            'gender_driver'=>'required',
            'jadwal_pengantaran'=>'required',
            'service'=>'R-Ride',
            'tarif'=>'required',
            'jarak'=>'required',
        ]);


    if($validator -> fails()){
        return response()->json($validator->messages());
    }
    $user = $this->getAuthUser();
           $user->order()->create([
                'alamat_penjemputan'=> request('alamat_penjemputan'),
                'alamat_tujuan'=> request('alamat_tujuan'),
                'gender_driver'=> request('gender_driver'),
                'jadwal_pengantaran'=> request('jadwal_pengantaran'),
                'jarak'=> request('jarak'),
                'tarif'=> request('tarif'),
                'service'=> 'R-Ride',

            ]);
            return response()->json([
                'message'=>'Create Order Berhasil',
                'data'=>$user
            ]);

    }

// create order r-shop


public function create_order_shop(Request $request)
{
    $validator = Validator::make(request()->all(),[
        // 'alamat_pembelian'=>'required',
        // 'alamat_pengantaran'=>'required',
        'alamat_penjemputan'=>'required',
        'alamat_tujuan'=>'required',
        'jenis_barang'=>'required',
        'jumlah_barang'=>'required',
        'dana_talangan'=>'required',
        'service'=>'R-Shop',
        'tarif'=>'required',
        'jarak'=>'required',
    ]);


if($validator -> fails()){
    return response()->json($validator->messages(),422);
}
$user = $this->getAuthUser();
       $user->order()->create([
        'alamat_penjemputan'=> request('alamat_penjemputan'),
        'alamat_tujuan'=> request('alamat_tujuan'),
            'dana_talangan'=> request('dana_talangan'),
            'jumlah_barang'=> request('jumlah_barang'),
            'jenis_barang'=> request('jenis_barang'),
            // 'alamat_pengantaran'=> request('alamat_pengantaran'),
            'service'=> 'R-Shop',
            'jarak'=> request('jarak'),
            'tarif'=> request('tarif'),
        ]);
        return response()->json([
            'message'=>'Create Order Berhasil',
            'data'=>$user
        ]);

}



// create order pickup


public function create_order_pickup(Request $request)
{
    $validator = Validator::make(request()->all(),[
        // 'alamat_pengambilan'=>'required',
        // 'alamat_pengantaran'=>'required',
        'alamat_penjemputan'=>'required',
        'alamat_tujuan'=>'required',
        'jenis_barang'=>'required',
        'berat_barang'=>'required',
        'dana_talangan'=>'required',
        'service'=>'R-Pickup',
        'tarif'=>'required',
        'jarak'=>'required',
    ]);

if($validator -> fails()){
    return response()->json($validator->messages());
}
$user = $this->getAuthUser();
       $user->order()->create([
        'alamat_penjemputan'=> request('alamat_penjemputan'),
        'alamat_tujuan'=> request('alamat_tujuan'),
            'dana_talangan'=> request('dana_talangan'),
            'berat_barang'=> request('berat_barang'),
            'jenis_barang'=> request('jenis_barang'),
            // 'alamat_pengantaran'=> request('alamat_pengantaran'),
            'service'=> 'R-Pickup',
            'jarak'=> request('jarak'),
            'tarif'=> request('tarif'),
        ]);
        return response()->json([
            'message'=>'Create Order Berhasil',
            'data'=>$user
        ]);




}



//



    public function get_receipt()
    {
    $user     = Auth::user();
    $receipt  = Receipt::where('user_id',$user->id)
    ->where('service','R-Ride')
    ->where('status','Active')
    ->with('driver:id,name,nomor_kendaraan,jenis_kendaraan,phone,image',
    'order:id,user_id,alamat_penjemputan,alamat_tujuan,service,jadwal_pengantaran,tarif,jarak')
    ->get();


    return response()->json([
        'status'=>[
            'message'=>'succes'
        ],
        'data'=>$receipt

    ]);
    }

//
public function get_receipt_pickup()
{
$user     = Auth::user();
$receipt  = Receipt::where('user_id',$user->id)
->where('service','R-Pickup')
->where('status','Active')
->with('driver:id,name,nomor_kendaraan,jenis_kendaraan,phone,image',
'order:id,user_id,alamat_penjemputan,alamat_tujuan,service,dana_talangan,berat_barang,jenis_barang,tarif,jarak')
->get();


return response()->json([
    'status'=>[
        'message'=>'succes'
    ],
    'data'=>$receipt

]);
}


public function get_receipt_shop()
{
$user     = Auth::user();
$receipt  = Receipt::where('user_id',$user->id)
->where('service','R-Shop')
->where('status','Active')
->with('driver:id,name,nomor_kendaraan,jenis_kendaraan,phone,image',
'order:id,user_id,alamat_penjemputan,alamat_tujuan,service,jenis_barang,dana_talangan,jumlah_barang,tarif,jarak')
 ->latest()->get();


return response()->json([
    'status'=>[
        'message'=>'succes'
    ],
    'data'=>$receipt

]);
}

// update status order

public function update_status(Request $request,$id)
{
    $validator =Validator::make($request->all(),[
        'status'=>'Done',
    ]);
if($validator -> fails()){
return response()->json($validator->messages());
}
$receipts = Receipt::find($id);
$this->checkOwnership($receipts->user_id);
$receipts->status='Done';
$receipts->save();
return response()->json(['message'=>'SuccessFuly Update']);
}



    public function get_List()
    {

    $user     = Auth::user();
    $receipt  = Receipt::where('user_id',$user->id)
    ->where('service','R-Ride')
    ->where('status','Done')
    ->with('driver:id,name,nomor_kendaraan,jenis_kendaraan',
    'order:id,user_id,alamat_penjemputan,alamat_tujuan,service,jadwal_pengantaran,tarif,jarak')

     ->latest()
    ->get();
    return response()->json([
        'status'=>[
            'message'=>'succes'
        ],
        'data'=>$receipt

    ]);
    }
    //
    public function get_List_shop()
    {

    $user     = Auth::user();
    $receipt  = Receipt::where('user_id',$user->id)
    ->where('service','R-Shop')
    ->where('status','Done')
    ->with('driver:id,name,nomor_kendaraan,jenis_kendaraan',
    'order:id,user_id,alamat_penjemputan,alamat_tujuan,service,jenis_barang,dana_talangan,jumlah_barang,tarif,jarak')
     ->latest()
    ->get();
    return response()->json([
        'status'=>[
            'message'=>'succes'
        ],
        'data'=>$receipt

    ]);
    }
    public function get_List_pickup()
    {

    $user     = Auth::user();
    $receipt  = Receipt::where('user_id',$user->id)
    ->where('service','R-Pickup')
    ->where('status','Done')
    ->with('driver:id,name,nomor_kendaraan,jenis_kendaraan',
    'order:id,user_id,alamat_penjemputan,alamat_tujuan,service,dana_talangan,berat_barang,jenis_barang,tarif,jarak')
     ->latest()
    ->get();
    return response()->json([
        'status'=>[
            'message'=>'succes'
        ],
        'data'=>$receipt

    ]);
    }



    //
    // public function delete_order($id)
    // {

    //     // $user     = Auth::user();
    //     $orderss = Receipt::find($id);
    //     $this->checkOwnership($orderss->user_id);
    //     $orderss->delete();
    //     $receipts = Order::find($orderss->id);
    //     $receipts->delete();
    // return response()->json([
    //         'message'=>'delete order succes'
    // ]);
    // }


    public function get_detail_order($id)
    {
        $user     = Auth::user();
      return Receipt::
where('user_id',$user->id)
      ->where('status','Done')
    ->with('driver:id,name,phone',
    'user:id,name',
    'order:id,user_id,alamat_penjemputan,alamat_tujuan,service')
    ->find($id);
    }


    private function getAuthUser(){
        try{
            return auth()->userOrFail();

        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            response()->json(['message'=>'not authentication'])->send();
        exit;
        }
    }

    // web admin

    public function index(Request $request)
    {
        $orders = Order::where('status','diproses')
        ->where('service','R-Ride')
        ->with('user:id,name')
        ->paginate(10);

    return view('pages.order.index', compact('orders'));
    }
    public function show(Request $request)
    {

    }
    public function destroy(Request $request)
    {

    //     $orders = Order::paginate(10);
    // return view('pages.driver.index', compact('orders'));
    }
    public function store(Request $request)
    {

    //     $orders = Order::paginate(10);
    // return view('pages.driver.index', compact('orders'));
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'status' => 'selesai',
        ]);
$order = Order::find($id);
// $this->checkOwnership($order->user_id);
$order->status='selesai';
$order->save();

return redirect()->route('order.index');
    }

    //

    //




}
