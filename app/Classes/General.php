<?php
namespace App\Classes;

use App\Models\ForfeitureDocument;
use Illuminate\Http\Request;

/*
* This interface with telco
*/
class General
{
    /**
     * makes Telco data request
     */
    public static function queryGatewayStatus($transaction)
    {
        return true;
    }

}
