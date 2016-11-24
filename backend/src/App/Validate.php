<?php
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 24/11/2016
 * Time: 12:49
 */

namespace App;


use App\Http\Request;

class Validate
{

    public function isValid (Request $oRequest) {
        $bIsValid = true;
        if ($oRequest->hasPost('id') && !is_numeric($oRequest->getPost('id')))
            $bIsValid = false;
        if ($oRequest->hasPost('date')){
            $sDate = $oRequest->getPost('date');
            if (strtotime($sDate) == FALSE)
                $bIsValid = false;
        }

        return $bIsValid;
    }
}