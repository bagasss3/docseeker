<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Address $address)
    {
        $address = $address
            ::join(
                'provinces',
                'addresses.province_id',
                '=',
                'provinces.province_id'
            )
            ->join('cities', 'addresses.city_id', '=', 'cities.city_id')
            ->where('user_id', $request->user()->id)
            ->get([
                'addresses.*',
                'provinces.province_id',
                'provinces.name as province_name',
                'cities.city_id',
                'cities.name as city_name',
            ]);
        // return response()->json([
        //     'success' => true,
        //     'msg' => 'List address user',
        //     'data' => $address,
        // ]);
        return view('user-address', [
            'title' => 'Address',
            'data' => $address,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-address', [
            'title' => 'Create Address',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'fName' => 'required|min:3|max:100',
                'lName' => 'required|min:3|max:100',
                'email' => 'required|email:dns',
                'number' => 'required',
                'streetAddres' => 'required',
                'country' => 'required',
                'province' => 'required',
                'city' => 'required',
                'zipCode' => 'required',
            ],
            [
                'fName.required' => 'First name harus diisi',
                'fName.min' => 'First Name minimal 3 karakter',
                'fName.max' => 'First Name maksimal 100 karakter',
                'lName.required' => 'Last name harus diisi',
                'lName.min' => 'Last name minimal 3 karakter',
                'lName.max' => 'Last name maksimal 100 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format Email salah',
                'number.required' => 'Nomor HP harus diisi',
                'streetAddres.required' => 'Alamat harus diisi',
                'country.required' => 'Negara harus diisi',
                'province.required' => 'Provinsi harus diisi',
                'city.required' => 'Kota harus diisi',
                'zipCode.required' => 'Nomor ZIP harus diisi',
            ]
        );

        $data = [
            'user_id' => $request->user()->id,
            'first_name' => $request->fName,
            'last_name' => $request->lName,
            'email' => $request->email,
            'phone' => $request->number,
            'street_address' => $request->streetAddres,
            'country' => $request->country,
            'province_id' => $request->province,
            'city_id' => $request->city,
            'zip_code' => $request->zipCode,
            'is_active' => false,
        ];

        $checkUser = User::find($request->user()->id);
        if (!$checkUser) {
            return back()->with([
                'info' => 'User tidak ditemukan',
            ]);
        }

        $checkProvince = Province::where(
            'province_id',
            $request->province
        )->first();
        if (!$checkProvince) {
            return back()->with([
                'info' => 'Provinsi tidak ditemukan',
            ]);
        }

        $checkCity = City::where([
            'city_id' => $request->city,
            'province_id' => $request->province,
        ])->first();
        if (!$checkCity) {
            return back()->with([
                'info' => 'Kota tidak ditemukan',
            ]);
        }

        $store = Address::create($data);
        if (!$store) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat menyimpan address baru',
            ]);
        }

        // return response()->json([
        //     'success' => true,
        //     'msg' => 'Sukses menyimpan address',
        //     'data' => $store,
        // ]);
        return back()->with([
            'success' => 'Berhasil menyimpan address',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show($id, Address $address, Request $request)
    {
        $address = $address
            ::join(
                'provinces',
                'addresses.province_id',
                '=',
                'provinces.province_id'
            )
            ->join('cities', 'addresses.city_id', '=', 'cities.city_id')
            ->where('addresses.id', $id)
            ->get([
                'addresses.*',
                'provinces.province_id',
                'provinces.name as province_name',
                'cities.city_id',
                'cities.name as city_name',
            ])
            ->first();
        if (!$address) {
            return back()->with([
                'info' => 'Address tidak ada',
            ]);
        }
        if ($request->user()->id != $address->user_id) {
            return back()->with([
                'info' => 'Tidak memiliki akses ke address tersebut',
            ]);
        }

        // return response()->json([
        //     'success' => true,
        //     'msg' => 'Berhasil mengambil address',
        //     'data' => $address,
        // ]);

        return view('update-address', [
            'title' => 'Address',
            'address' => $address,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Address $address, Request $request)
    {
        $address = $address::find($id);
        if (!$address) {
            return back()->with([
                'info' => 'Address tidak ada',
            ]);
        }

        if ($address->user_id != $request->user()->id) {
            return back()->with([
                'info' => 'Tidak memiliki akses ke address tersebut',
            ]);
        }

        $currActiveAddr = $address
            ::where([
                'user_id' => $request->user()->id,
                'is_active' => true,
            ])
            ->first();
        if ($currActiveAddr) {
            $currActiveAddr->is_active = false;
            $currActiveAddr->save();
        }

        $address->is_active = true;
        $address->save();
        return back()->with([
            'success' => 'Berhasil mengaktifkan alamat sebagai alamat utama',
        ]);
    }

    public function nonactive($id, Address $address, Request $request)
    {
        $address = $address::find($id);
        if (!$address) {
            return back()->with([
                'info' => 'Address tidak ada',
            ]);
        }

        if ($address->user_id != $request->user()->id) {
            return back()->with([
                'info' => 'Tidak memiliki akses ke address tersebut',
            ]);
        }

        if ($address->is_active == false) {
            return back()->with([
                'info' => 'Address sudah tidak aktif',
            ]);
        }

        $address->is_active = false;
        $address->save();
        return back()->with([
            'success' => 'Berhasil mengnonaktifkan alamat',
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Address $address)
    {
        $request->validate(
            [
                'fName' => 'required|min:3|max:100',
                'lName' => 'required|min:3|max:100',
                'email' => 'required|email:dns',
                'number' => 'required',
                'streetAddres' => 'required',
                'country' => 'required',
                'provinceId' => 'required',
                'cityId' => 'required',
                'zipCode' => 'required',
            ],
            [
                'fName.required' => 'First name harus diisi',
                'fName.min' => 'First Name minimal 3 karakter',
                'fName.max' => 'First Name maksimal 100 karakter',
                'lName.required' => 'Last name harus diisi',
                'lName.min' => 'Last name minimal 3 karakter',
                'lName.max' => 'Last name maksimal 100 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format Email salah',
                'number.required' => 'Nomor HP harus diisi',
                'streetAddres.required' => 'Alamat harus diisi',
                'country.required' => 'Negara harus diisi',
                'provinceId.required' => 'Provinsi lama tidak ada',
                'cityId.required' => 'Kota lama tidak ada',
                'zipCode.required' => 'Nomor ZIP harus diisi',
            ]
        );

        if (!$request->city && !$request->province) {
            $cityInput = $request->cityId;
            $provinceInput = $request->provinceId;
        } else {
            $cityInput = $request->city;
            $provinceInput = $request->province;
        }

        $data = [
            'user_id' => $request->user()->id,
            'first_name' => $request->fName,
            'last_name' => $request->lName,
            'email' => $request->email,
            'phone' => $request->number,
            'street_address' => $request->streetAddres,
            'country' => $cityInput,
            'province_id' => $provinceInput,
            'city_id' => $request->city,
            'zip_code' => $request->zipCode,
        ];

        $address = $address::find($id);
        if (!$address) {
            return back()->with([
                'info' => 'Address tidak ada',
            ]);
        }

        if ($address->user_id != $request->user()->id) {
            return back()->with([
                'info' => 'Tidak memiliki akses ke address tersebut',
            ]);
        }

        $checkProvince = Province::where(
            'province_id',
            $request->province
        )->first();
        if (!$checkProvince) {
            return back()->with([
                'info' => 'Provinsi tidak ada',
            ]);
        }

        $checkCity = City::where('city_id', $request->city)->first();
        if (!$checkCity) {
            return back()->with([
                'info' => 'Kota tidak ada',
            ]);
        }

        if (!$address->update($data)) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat mengupdate address',
            ]);
        }

        return back()->with([
            'success' => 'Sukses mengupdate address',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Address $address, Request $request)
    {
        $address = $address::find($id);
        if (!$address) {
            return back()->with([
                'info' => 'Address tidak ditemukan',
            ]);
        }

        if ($request->user()->id != $address->user_id) {
            return back()->with([
                'info' => 'User tidak dapat menghapus address tersebut',
            ]);
        }

        if (!$address->delete()) {
            return back()->with([
                'info' => 'Terjadi kesalahan saat menghapus address',
            ]);
        }

        return back()->with([
            'success' => 'Berhasil menghapus address',
        ]);
    }
}
