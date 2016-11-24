<?php

require __DIR__."/../bootstrap.php";
use App\Http\Request;
use App\Model\Event;
$oHttpRequest = new Request;
$oEvent = new Event();
$oEvent->name = 'Evento 1';
$oEvent->save();

var_dump($_SESSION['data']);
//var_dump(Event::all());
//
//var_dump (Event::find(1));

