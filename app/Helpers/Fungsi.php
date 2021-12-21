<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class Fungsi extends Model
{
    public static function responResult($data, $kode) 
    {
        $result['status'] = $kode;

        if (is_array($data)) {
            $result['data'] = $data;
        } else if (is_object($data)) {
            $result['data'] = $data;
        } else {
            if($data != '' || $data != null) {
                $result['message'] = $data; 
            }
        }

        return $result;
    }

    public static function resOK($data) 
    {
        return self::responResult($data, 200);
    }

    public static function resError($data, $kode = 500) 
    {
        return self::responResult($data, $kode);
    }

    public static function resErrorValidation($data) 
    {
        $arrError = $data->errors();

        $i = 0;
        foreach ($arrError as $key => $value) {
            if ($i == 0) {
                $message = $arrError[$key];
            }

            $i++;
        }

        return self::resError($message[0], $data->status);
    }

    public static function idrFormat($amount, $decimal)
    {
        return number_format($amount, $decimal, '.', ',');
    }
}
