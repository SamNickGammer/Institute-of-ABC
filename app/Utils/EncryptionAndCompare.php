<?php

namespace App\Utils;

use Illuminate\Support\Facades\Hash;

class EncryptionAndCompare
{
   public static function compare($yourPassword, $hashedPassword) {
    return Hash::check($yourPassword, $hashedPassword);
   }

   public static function hash($password){
    return Hash::make($password, ['rounds' => 12]);
   }
}