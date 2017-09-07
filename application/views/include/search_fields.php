<?php include("../include/search_dbconn.php");
include("../include/dal_repos.php");
include("../include/search_functions.php"); 

$strq = $_REQUEST["q"];   // search query
$strq = sqFilter($strq);  //check sql injection
$arrSearch = array();

if(strlen($strq)>2) {
	$clsSearch = new Search();
	$clsSearch->getSearch($strq,50);
	$rsSearch = $clsSearch->arr_results;
	
	while($rsSearch1 =  mysqli_fetch_assoc($rsSearch)) {
		$arrSearch[] = $rsSearch1;
	}
}

$arrSearch[] = array("id"=>'0', "name"=>$strq, "tagtitle"=>'search for '.$strq,"newstype"=>'0');   //first item in the results autocomplete array

header('Content-Type: application/json; charset=utf-8');
echo(json_encode($arrSearch));   //consume to json the results to the autocomplete field