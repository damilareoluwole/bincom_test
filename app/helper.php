<?php

use App\Classes\General\General;
use App\Classes\User\ManageUser;

define('APP_NAME','Bincom Dev');

function getStates($id = 0){
    return General::getStates($id);
}

function getAllParties($id = 0){
    return General::getAllParties($id);
}

?>
