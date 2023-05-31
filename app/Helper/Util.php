<?php

namespace App\Helper;

class Util {

   public static function rupiah($angka)
    {
           return 'Rp. '. number_format($angka,'0',',' , '.');
    }

}
 
