<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckOngkirController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function getProvince()
    {
        $province = Province::pluck('name', 'province_id');
        return response()->json($province);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin' => "11", // ID kota/kabupaten asal
            'destination' => $request->get('destination'), // ID kota/kabupaten tujuan
            'weight' => $request->get('weight'), // berat barang dalam gram
            'courier' => $request->get('courier'), // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($cost);
    }
}
