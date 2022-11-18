<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    const STATUS_TRUE = true;
    const STATUS_FALSE = false;
    const IS_ACTIVE = true;
    const IS_DEACTIVE = false;

    CONST DOCUMENT_TYPE_PERSON_DNI = "DNI";
    CONST DOCUMENT_TYPE_PERSON_PASAPORTE = "PASAPORTE";
    CONST DOCUMENT_TYPE_PERSON_CARNET = "CARNET";

    const a_DOCUMENT_TYPE_PERSON = [
        [
            "name" => SELF::DOCUMENT_TYPE_PERSON_DNI,
            "shortName" => "DNI",
            "value" => SELF::DOCUMENT_TYPE_PERSON_DNI,
            "default" => true,
            "selected" => false
        ],
        [
            "name" => SELF::DOCUMENT_TYPE_PERSON_PASAPORTE,
            "shortName" => "PAS",
            "value" => SELF::DOCUMENT_TYPE_PERSON_PASAPORTE,
            "default" => false,
            "selected" => false
        ],
        [
            "name" => SELF::DOCUMENT_TYPE_PERSON_CARNET,
            "shortName" => "CAR",
            "value" => SELF::DOCUMENT_TYPE_PERSON_CARNET,
            "default" => false,
            "selected" => false
        ]
    ];
}
