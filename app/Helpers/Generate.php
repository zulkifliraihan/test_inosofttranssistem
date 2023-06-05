<?php
namespace App\Helpers;

class Generate
{
    public static function tipePembayaran()
    {
        $options = ["Cash", "Kredit"];
        $randomIndex = array_rand($options);
        $result = $options[$randomIndex];

        return $result;
    }

}
