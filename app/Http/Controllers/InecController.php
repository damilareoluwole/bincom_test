<?php
namespace App\Http\Controllers;

use App\Classes\General\General;
use App\Classes\User\ManageUser;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InecController extends Controller
{
    public function index(){
        return view("index");
    }

    public function getLgas()
    {
        $id = $_GET['id'];
        if(!$id){
            Session::put('message','Invalid Request.');
            return redirect('/index');
        }
        $lgas = General::getLgas($id);
        if(count($lgas)){
            echo "<option value=''>Select LGA</option>";
            foreach($lgas as $lga){
                echo "<option value='$lga->uniqueid'>$lga->lga_name</option>";
            }
        }else{
            echo '<option>No record found</option>';
        }
    }

    public function getWards()
    {
        $id = $_GET['id'];
        if(!$id){
            Session::put('message','Invalid Request.');
            return redirect('/index');
        }
        $wards = General::getWards($id);
        if(count($wards)){
            echo "<option value=''>Select Ward</option>";
            foreach($wards as $ward){
                echo "<option value='$ward->uniqueid'>$ward->ward_name</option>";
            }
        }else{
            echo '<option>No record found</option>';
        }
    }

    public function getPollingUnit()
    {
        $id = $_GET['id'];
        if(!$id){
            return back()->with('error_message','Invalid Request.');
        }
        $pollingUnits = General::getPollingUnit($id);
        if(count($pollingUnits)){
            echo "<option value=''>Select Polling unit</option>";
            foreach($pollingUnits as $pollingUnit){
                echo "<option value='$pollingUnit->uniqueid'>$pollingUnit->polling_unit_name</option>";
            }
        }else{
            echo '<option>No record found</option>';
        }
    }

    public function getPollingUnitResults(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required',
            'lga' => 'required',
            'ward' => 'required',
            'polling_unit' => 'required'
        ]);

        if ($validator->fails())
        {
            return back()->withInput()->withError($validator)->with('error_message', 'Some required fields are missing.');
        }

        $pollingUnitResults = General::getPollingUnitResults($request->polling_unit);

        if(!count($pollingUnitResults)){
            return back()->with('error_message', 'No record was found for the selected polling unit.');
        }

        return view("index",['datas'=>$pollingUnitResults]);

    }

    public function getAddResultsPage(Request $request)
    {
        return view('add-party-result');
    }

    public function doAddResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'polling_unit' => 'required'
        ]);

        if ($validator->fails())
        {
            return back()->withInput()->withError($validator)->with('error_message', 'Some required fields are missing.');
        }

        $parties = General::getAllParties();

        foreach($parties as $party){
            if($_POST["party".$party->id] && $_POST["result".$party->id]){
                $party_id = $_POST["party".$party->id];
                $result = $_POST["result".$party->id];

                $data = DB::table('announced_pu_results')->where('polling_unit_uniqueid',$request->polling_unit)->where('party_abbreviation',$party_id)->get();

                if(count($data)){
                    return back()->with('error_message', 'You can not add result for a polling unit with a result already.');
                }

                DB::insert('insert into announced_pu_results (polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address) values(?,?,?,?,?,?)',[$request->polling_unit,General::truncateString($party_id, 4),$result,'Damilare Oluwole',date('Y-m-d'),ManageUser::getClientIp()]);

            }else{
                return back()->with('error_message', 'A political party with its respective result can not be empty.');
            }
        }

        return back()->with('message', 'The results has been added successfully.');
    }

    public function getLgaResult(Request $request)
    {
        return view('lga-result');
    }

    public function doLgaResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required',
            'lga' => 'required'
        ]);

        if ($validator->fails())
        {
            return back()->withInput()->withError($validator)->with('error_message', 'Some required fields are missing.');
        }

        $lga_id = General::getLgaId($request->lga);

        if(!$lga_id){
            return back()->with('error_message', 'Your request Could not be completed.');
        }

        $pollingUnitIds = [];

        $pollingUnitUniqueIds = DB::table('polling_unit')->where('lga_id',$lga_id)->get();

        foreach($pollingUnitUniqueIds as $pollingUnitUniqueId){
            $pollingUnitIds[] = $pollingUnitUniqueId->uniqueid;
        }

        $data = DB::table('announced_pu_results')->whereIn('polling_unit_uniqueid',$pollingUnitIds)->get();

        $pdp = $data->whereIn('party_abbreviation',['PDP']);
        $pdpVote = $pdp->sum('party_score');

        $acn = $data->whereIn('party_abbreviation',['ACN']);
        $acnVote = $acn->sum('party_score');

        $ppa = $data->whereIn('party_abbreviation',['PPA']);
        $ppaVote = $ppa->sum('party_score');

        $cdc = $data->whereIn('party_abbreviation',['CDC']);
        $cdcVote = $cdc->sum('party_score');

        $jp = $data->whereIn('party_abbreviation',['JP']);
        $jpVote = $jp->sum('party_score');

        $anpp = $data->whereIn('party_abbreviation',['ANPP']);
        $anppVote = $anpp->sum('party_score');

        $labo = $data->whereIn('party_abbreviation',['LABO']);
        $laboVote = $labo->sum('party_score');

        $cpp = $data->whereIn('party_abbreviation',['CPP']);
        $cppVote = $cpp->sum('party_score');

        $dpp = $data->whereIn('party_abbreviation',['DPP']);
        $dppVote = $dpp->sum('party_score');

        $response = (object)[
            'pdp'=>'PDP',
            'pdpVote'=>$pdpVote,
            'acn'=>'ACN',
            'acnVote'=>$acnVote,
            'ppa'=>'PPA',
            'ppaVote'=>$ppaVote,
            'cdc'=>'CDC',
            'cdcVote'=>$cdcVote,
            'jp'=>'JP',
            'jpVote'=>$jpVote,
            'anpp'=>'ANPP',
            'anppVote'=>$anppVote,
            'labo'=>'LABO',
            'laboVote'=>$laboVote,
            'cpp'=>'CPP',
            'cppVote'=>$cppVote,
            'dpp'=>'DPP',
            'dppVote'=>$dppVote
        ];


        return view("lga-result",['data'=>$response]);

    }
}


