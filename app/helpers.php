<?php

use App\Models\Orders;
use App\Models\Payments;
use App\Models\Products;

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
    $customId = $code . $year . $month . $day . sprintf('%03d', $id);
    return $customId;
}
