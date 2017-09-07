<?Php // helper functions requires file(cls_secure) to for sql injection attempts
include($base_dir ."include/cls_secure.php");

function getBrief($str) {
	$retTitle = $str;
	if($retTitle != ""){
		$retTitle = stripHtmlBody($retTitle, 50);
	}
	return $retTitle;
}

function get_words($sentence, $count = 10) {
  preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
  return $matches[0];
}

function stripHtmlBody($strStr, $numCount=8)
{
	$retStr = "";
	if($strStr != "")
	{
		$retStr = strip_tags($strStr);
		$retStr = get_words($retStr, $numCount);
	}
	return $retStr;
}
?>