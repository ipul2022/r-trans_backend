<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListOrderController;
use App\Http\Controllers\ListPickupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WebAdminController;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/chart', function () {
    $months = [
        [
            'title' => 'January',
            'total' => 0
        ],
        [
            'title' => 'February',
            'total' => 0
        ],
        [
            'title' => 'March',
            'total' => 0
        ],
        [
            'title' => 'April',
            'total' => 0
        ],
        [
            'title' => 'Mei',
            'total' => 0
        ],
        [
            'title' => 'Juni',
            'total' => 0
        ],
        [
            'title' => 'Juli',
            'total' => 0
        ],
        [
            'title' => 'Agustus',
            'total' => 0
        ],
        [
            'title' => 'September',
            'total' => 0
        ],
        [
            'title' => 'Oktober',
            'total' => 0
        ],
        [
            'title' => 'November',
            'total' => 0
        ],
        [
            'title' => 'Desember',
            'total' => 0
        ],
    ];

    $yearNow = date('Y');
    $tarifs = Receipt::select([
        DB::raw('count(*) as data'),
        DB::raw('MONTH(created_at) month')
    ])->whereYear('created_at', $yearNow)
    ->groupby('month')
    ->get();

    // foreach ($tarifs as $data) {
    //     $key_month = $data->month - 1;
    //     $months[$key_month] = [
    //         'total' => $data->data,];}
    foreach ($tarifs as $data) {
        $key_month = $data->month - 1;
        $months[$key_month]['total'] =$data->data;
    }
            $month_titles = [''];
            $month_totals = [''];
           // dd($data);
            foreach ($months as $month) {
              //  dd($month);
                $month_titles[] = $month['title'];
                $month_totals[] = $month['total'];
            }
    return view('chart',compact('month_totals','month_titles'));
});
Route::get('/', function () {
    //return view('welcome');
    return view('pages.auth.login');});
// Route::post('login', WebAdminController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('home', function(){

        $driver = Driver::count();
        $user = User::where('roles','user')->count();
        $receipt = Receipt::count();
        $tarif = Order::sum('tarif');
        $drivers = Order::paginate();
        $receipts = Receipt::
        select('user_id','order_id','driver_id','created_at')
        ->with('user:id,name','order:id,service','driver:id,name')->latest()
        ->paginate(10);


        //
        $months = [
            [
                'title' => 'January',
                'total' => 0
            ],
            [
                'title' => 'February',
                'total' => 0
            ],
            [
                'title' => 'March',
                'total' => 0
            ],
            [
                'title' => 'April',
                'total' => 0
            ],
            [
                'title' => 'Mei',
                'total' => 0
            ],
            [
                'title' => 'Juni',
                'total' => 0
            ],
            [
                'title' => 'Juli',
                'total' => 0
            ],
            [
                'title' => 'Agustus',
                'total' => 0
            ],
            [
                'title' => 'September',
                'total' => 0
            ],
            [
                'title' => 'Oktober',
                'total' => 0
            ],
            [
                'title' => 'November',
                'total' => 0
            ],
            [
                'title' => 'Desember',
                'total' => 0
            ],
        ];
        // $tarifs = Receipt::select([
        //     DB::raw('count(*) as data'),
        //     DB::raw('MONTH(created_at) month')
        // ])->whereYear('created_at', $yearNow)
        // ->groupby('month')
        // ->get();
        $yearNow = date('Y');
       $tarifs = Receipt::select([
            DB::raw("count(*) as data"),
            DB::raw('MONTH(created_at) month')
        ])->whereYear('created_at', $yearNow)
        ->groupby('month')
        ->get();


        foreach ($tarifs as $data) {
            $key_month = $data->month - 1;
            $months[$key_month]['total'] =$data->data;
        }
                $month_titles = [''];
                $month_totals = [''];
               // dd($data);
                foreach ($months as $month) {
                  //  dd($month);
                    $month_titles[] = $month['title'];
                    $month_totals[] = $month['total'];
                }
//                 dd($tarifs);
//dd($month_totals);
        return view('pages.app.dashboard',
        compact('driver','user','receipt','tarif','drivers','month_titles','month_totals','receipts'));
    })->name('home');


    Route::resource('user', AdminController::class);

    //
    Route::resource('order',OrderController::class);
   // Route::get('order/{id}',[OrderController::class, 'update']);
    //
    Route::resource('listOrder', ListOrderController::class);
    Route::resource('listPickup', ListPickupController::class);
    //
    Route::resource('shop', ShopController::class);
    Route::resource('pickup', PickupController::class);
    //
    Route::resource('driver', WebAdminController::class);
    Route::resource('receipt', ReceiptController::class);

    //
    Route::resource('price', PriceController::class);
});
//         $yearNow = date('Y');
// $tarifs = Receipt::select(
//     DB::raw('SUM(tarif) as tarif'),
//     // DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
//     //DB::raw('max(created_at) as createdAt')
//     )
//  //  ->where("created_at", ">", \Carbon\Carbon::now()->subMonths())
//    ->groupBy( DB::raw('MONTH(created_at) month'))
//    ->whereYear('created_at', $yearNow)
//    ->sum('tarif');
// $tarifs = Receipt::select(DB::raw("CAST(SUM(tarif) as integer)as tarif"))
//    ->groupBy(DB::raw("Month(created_at)"))
//    ->pluck('tarif');
//    $bulans = Receipt::select(
//     DB::raw("MONTHNAME(created_at) as bulan"),)
//    ->groupBy(DB::raw("MONTHNAME(created_at) as bulan"))
//    ->pluck('bulan');

//         $tarifs = Receipt::select([
//                 DB::raw('count(id) as data'),
//                 DB::raw('MONTH(created_at) month')
//             ])->whereYear('created_at', $yearNow)
//             ->groupby('month')->get();
 //dd($tarifs);
