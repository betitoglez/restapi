<?php


/**
 * @api {put} /webservices/edit.php Edit an existing event
 * @apiVersion 1.0.0
 * @apiName EditEvent
 * @apiGroup Events
 *
 * @apiParam {String} id         id
 * @apiParam {String} [name]     Name
 * @apiParam {String} [type]     type
 * @apiParam {String} [date]     date
 *
 * @apiSuccess {Integer} id Event Id
 * @apiSuccess {String} name  Name of the event
 * @apiSuccess {String} type  Type of the event
 * @apiSuccess {String} date  Date of the event
 */


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

if ($oHttpRequest->isPut()) {
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

    if ($oHttpRequest->hasPost('date')){
        $oEvent->date   = $oHttpRequest->getPost('date');
    } else {
        $oEvent->date   = $aEvent['date'];
    }

    if ($oHttpRequest->hasPost('name')){
        $oEvent->name   = $oHttpRequest->getPost('name');
    } else {
        $oEvent->name   = $aEvent['name'];
    }

    if ($oHttpRequest->hasPost('type')){
        $oEvent->type   = $oHttpRequest->getPost('type');
    } else {
        $oEvent->type   = $aEvent['type'];
    }

    $oEvent->save();

    echo $oEvent;

}else{
    $oHttpResponse->notValidMethodResponse();
    exit();
}