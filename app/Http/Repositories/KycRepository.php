<?php

namespace App\Http\Repositories;

use App\Http\Helpers\CurlHelper;
use App\Http\Models\Kyc;

class KycRepository
{
    public function auth()
    {
        $data = [
            'account-id' => 123,
            'type' => 123,
            'date_of_birth' => '',
            'email' => '',
            'sex' => '',
            'type_address' => '',
            'street_1' => '',
            'city' => '',
            'region' => '',
            'postal_code' => '',
            'country' => '',
            'primary-phone-number' => '',
        ];
        $api = 'http://13.229.70.159/v2/contacts';
        $PrimetrustTokenRepository = new PrimetrustTokenRepository();
        $header = [
            'token' => $PrimetrustTokenRepository->getToken(),
        ];
        $res = CurlHelper::http($api, 'POST', $data, $header);
        var_dump($res);
    }

    public function saveKycInfo($uid, $data)
    {

    }

    public function updateKycStatus()
    {

    }

}
