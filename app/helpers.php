<?php

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
