<?php


namespace App\Services;


use Illuminate\Support\Str;

class PhoneNumberFormatter
{
    /**
     * Format phone number
     *
     * @param string $phone
     * @return bool|string
     */
    public static function format(string $phone)
    {
        $newPhone = $phone;

        if (Str::startsWith($phone, '0')) {
            $newPhone = substr($phone, 1, strlen($phone));
            $newPhone = '+234' . $newPhone;
        } elseif (Str::startsWith($phone, '+2340')) {
            $newPhone = substr($phone, 5, strlen($phone));
            $newPhone = '+234' . $newPhone;
        } elseif (Str::startsWith($phone, '2340')) {
            $newPhone = substr($phone, 4, strlen($phone));
            $newPhone = '+234' . $newPhone;
        } elseif (Str::startsWith($phone, '234')) {
            $newPhone = '+' . $phone;
        }

        return $newPhone;
    }
}
