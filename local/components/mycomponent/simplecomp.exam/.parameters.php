<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"CAT_IBLOCK_ID" => array(
			"NAME" => GetMessage("CAT_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
        "CLASSIFIER_IBLOCK_ID" => array(
            "NAME" => GetMessage("CLASSIFIER_IBLOCK_ID"),
            "TYPE" => "STRING",
        ),
        "KOD" => array(
            "NAME" => GetMessage("KOD"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
	),
);