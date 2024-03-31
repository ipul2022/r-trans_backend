<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class WebAdminController extends Controller
{
      public function index(Request $request)
    {
        // $drivers = DB::table('drivers')
        // ->when($request->input('name'), function ($query, $name) {
        //     return $query->where('name', 'like', '%' . $name . '%');
        // })
        // ->select('id', 'name', 'email', 'phone', DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as created_at'))
        // ->orderBy('id', 'desc')
        // ->paginate(10);
        $drivers = Driver::paginate(10);
    return view('pages.driver.index', compact('drivers'));
    }
    public function create()
    {

        return view('pages.driver.create');
    }
    public function login()
    {

        return view('pages.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'string',
            'jenis_kendaraan' => 'required',
            'nomor_kendaraan' => 'required',
            'phone' => 'string',
            'gender' => 'string',
            'location' => 'required',
            'image'     => 'required|image|mimes:png,jpg,jpeg'
        ]);
        if ($request->has("image")) {
            $image_path = public_path("storage/images/" . $request->image);
            $file = $request->image;
            if (File::exists($image_path)) {
            }
            $imageName = url("storage/images/" . time() . "_" . $file->getClientOriginalName());
            $file->move(public_path("storage/images/"), $imageName);
        }

        // Driver::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'jenis_kendaraan' => $request->jenis_kendaraan,
        //     'nomor_kendaraan' => $request->nomor_kendaraan,
        //     'roles' => $request->roles,
        //     'gender' => $request->gender,
        //     'phone' => $request->phone,
        //     'image' => $request->$imageName,
        // ]);
        // $imageName = urldecode(time() . '.' . $request->image->extension());
        // // $request->image->move(public_path('images'), $imageName);
        // $request->image->storeAs('storage/images', $imageName);

        $postData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nomor_kendaraan' => $request->nomor_kendaraan,
            'roles' => $request->roles,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'location' => $request->location,

        'image' => $imageName];

        Driver::create($postData);
        return redirect(route('driver.index'))->with('success', 'New Driver Berhasil Didaftarkan');
    }

    public function edit(Driver $driver)
    {
        return view('pages.driver.edit')->with('driver', $driver);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('driver.index')->with('success', 'Delete driver Success');
    }
}
