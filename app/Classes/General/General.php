<?php
namespace App\Classes\General;

use App\Classes\User\ManageUser;
use Illuminate\Support\Facades\DB;

Class General
{

    public static function getStates($id=0)
    {
        $data = [];

        if($id){
            $data = DB::table('states')->where('state_id',$id)->get();
        }else{
            $data = DB::table('states')->get();
        }

        return $data;
    }

    public static function getLgas($state_id=0)
    {
        $data = [];

        if($state_id){
            $data = DB::table('lga')->where('state_id',$state_id)->get();
        }else{
            $data = DB::table('lga')->get();
        }

        return $data;
    }

    public static function getWards($lga_id=0)
    {
        $data = [];

        if($lga_id){
            $data = DB::table('ward')->where('lga_id',$lga_id)->get();
        }else{
            $data = DB::table('ward')->get();
        }

        return $data;
    }

    public static function getPollingUnit($ward_id=0)
    {
        $data = [];

        if($ward_id){
            $data = DB::table('polling_unit')->where('uniquewardid',$ward_id)->get();
        }else{
            $data = DB::table('polling_unit')->get();
        }

        return $data;
    }

    public static function getPollingUnitResults($pollingUnitId=0)
    {
        $data = [];

        if($pollingUnitId){
            $data = DB::table('announced_pu_results')->where('polling_unit_uniqueid',$pollingUnitId)->get();
        }else{
            $data = DB::table('announced_pu_results')->get();
        }

        return $data;
    }

    public static function getAllParties($party_id=0)
    {
        $data = [];

        if($party_id){
            $data = DB::table('party')->where('id',$party_id)->get();
        }else{
            $data = DB::table('party')->get();
        }

        return $data;
    }

    public static function truncateString(string $string, int $lenght ){
        if (strlen($string) > $lenght) {

            $stringCut = substr($string, 0, $lenght);

            return $stringCut;
        }

        return $string;
    }

    public static function getLgaId($lga_unique_id)
    {

        $lga_id = DB::table('lga')->where('uniqueid',$lga_unique_id)->first()->lga_id;

        return $lga_id;
    }

}
