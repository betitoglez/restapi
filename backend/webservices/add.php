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

$oHttpRequest = new Request;
$oHttpResponse = new Response;

if ($oHttpRequest->isPost()) {
    $bIsValidRequest = true;

    if (!$oHttpRequest->hasPost('date') || !$oHttpRequest->hasPost('type') || !$oHttpRequest->hasPost('name')
    ) {
        $bIsValidRequest = false;
    }

    $oValidator = new Validate;
    if (!$oValidator->isValid($oHttpRequest)){
        $bIsValidRequest = false;
    }

    if (!$bIsValidRequest){
        $oHttpResponse->notValidRequestResponse();
        exit();
    }

    $oEvent = new Event();
    $oEvent->date   = $oHttpRequest->getPost('date');
    $oEvent->name   = $oHttpRequest->getPost('name');
    $oEvent->type   = $oHttpRequest->getPost('type');
    $oEvent->save();

    echo $oEvent;

}else{
    $oHttpResponse->notValidMethodResponse();
    exit();
}