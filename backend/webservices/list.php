<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 23/11/2016
 * Time: 21:11
 */

require __DIR__ . "/../bootstrap.php";
use App\Http\Request;
use App\Http\Response;
use App\Validate;
use App\Model\Event;


$oEvents = Event::all();
$aParsedEvents = [];

foreach ($oEvents as $iEventKey => $oEventDesc){
    $aParsedEvents[$iEventKey] = $oEventDesc;
}

echo json_encode($aParsedEvents);

