<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 23/11/2016
 * Time: 20:36
 */

namespace App\Http;


class Response
{
    public function notValidRequestResponse ()
    {
        http_response_code(406);
    }

    public function notValidMethodResponse ()
    {
        http_response_code(405);
    }
}