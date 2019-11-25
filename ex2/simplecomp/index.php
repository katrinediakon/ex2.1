<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:simplecomp.exam", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PRODUCTS_IBLOCK_ID" => "5",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CAT_IBLOCK_ID" => "2",
		"CLASSIFIER_IBLOCK_ID" => "5",
		"KOD" => "UF_NEW_CLASSIFIER"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>