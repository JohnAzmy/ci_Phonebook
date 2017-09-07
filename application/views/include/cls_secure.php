<?php
function do_reg($text)
{
	$regStr = "/Delete from|update|edit|mysql|select|user|delete|Drop|declare|Script|hack|admin|CHAR\(/i";
	if (preg_match($regStr, $text)) {
		return TRUE;
	} 
	else {
		return FALSE;
	}
}

function sqFilter($strPosted)
{
	if (do_reg($strPosted) == true)
	{
		do_log($strPosted);
		exit();
	}else {
		//echo "Here2: $value <br>";
		//exit();
	}
	return $strPosted;
}

function do_log($strHack)
{
	$myFile = "../logHack.txt";
	$fh = fopen($myFile, 'a');
	$stringData = "===========================================================\n";
	$stringData = $stringData . gmdate("Y-m-d H:i:s") ."\n";
	$stringData = $stringData . $strHack ."\n";
	$stringData = $stringData . "IP: ". $_SERVER['REMOTE_ADDR'] ."\n";
	$stringData = $stringData . "Page: ". $_SERVER['SCRIPT_NAME'] ."\n";
	$stringData = $stringData . "Variables: ". $_SERVER['QUERY_STRING'] ."\n";
	$stringData = $stringData . "Employee:" . $_SESSION["EmpID"] ." ". $_SESSION["EmpUserName"] ."\n";
	fwrite($fh, $stringData);
	fclose($fh);
}

?>