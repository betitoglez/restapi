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

if ($oHttpRequest->isDelete()) {
    $bIsValidRequest = true;

    if (!$oHttpRequest->hasPost('id')
    ) {
        $bIsValidRequest = false;
    }


    $oValidator = new Validate;
    if (!$oValidator->isValid($oHttpRequest)){
        $bIsValidRequest = false;
    }


    $aEvent = Event::find($oHttpRequest->getPost('id'));

    if (FALSE===$aEvent)
        $bIsValidRequest=false;

    if (!$bIsValidRequest){
        $oHttpResponse->notValidRequestResponse();
        exit();
    }

    $oEvent = new Event();
    $oEvent->id     = $oHttpRequest->getPost('id');
    $oEvent->remove();

    echo json_encode(['status'=>'OK']);

}else{
    $oHttpResponse->notValidMethodResponse();
    exit();
}