<?php

use App\Models\Orders;
use App\Models\Payments;
use App\Models\Products;
use Illuminate\Support\Carbon;

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function local($tanggal)
{
    date_default_timezone_set('Asia/Jakarta');

    $date = strtotime($tanggal . ' UTC');
    $dateTime = date("Y-m-d H:i:s", $date);
    return $dateTime;
}

function custom_id($table)
{
    $year = date('y');
    $month = date('m');
    $day = date('d');
    $now = Carbon::now();
    $hour = sprintf('%02d', $now->hour);
    $minute = sprintf('%02d', $now->minute);
    $second = sprintf('%02d', $now->second);

    switch ($table) {
        case 'orders':
            $latestRecord = Orders::orderBy('id', 'desc')->first();
            $code = 'NOR';
            break;
        case 'payments':
            $latestRecord = Payments::orderBy('id', 'desc')->first();
            $code = 'NPA';
            break;
        case 'products':
            $latestRecord = Products::orderBy('id', 'desc')->first();
            $code = 'NPR';
            break;
    }
    if (!$latestRecord) {
        $id = 1;
    } else {
        $id = $latestRecord->id + 1;
    }
    $customId =
        $code .
        $year .
        $month .
        $day .
        $hour .
        $minute .
        $second .
        sprintf('%03d', $id);
    return $customId;
}
