<?php
// Data Access Layer
// implements two classes Article and Search with inhertance

// class Article
// implements methods get_article_details, get_all

class Article{
  public $id;
  public $titlear;
  public $descar;
  public $aimage;
  public $adate;
  public $atags;
  public $abrief;
  public $arr_results;
  public $imagepath_large;
  public $imagepath_small;
  
  public function __construct($data = null)
  {
        if (is_array($data)) {
            if (isset($data['id'])) $this->id = $data['id'];
			
            getArticle($varID);
        }
  }
	
  public function geAll($limit)
  {
	$db = $GLOBALS['db'];
	if($varLimit>0)
	    $strSQL = "SELECT * FROM tblarticles WHERE aorder<>0 ORDER BY id DESC LIMIT $limit;";
	else
	    $strSQL = "SELECT * FROM tblarticles WHERE aorder<>0 ORDER BY id DESC;";
			
    $rsAllCat  = mysqli_query($db, $strSQL);
    
	$this->arr_results  = $rsAllCat;
  }
  
  public function getArticle($varID)
  {
	$db = $GLOBALS['db'];
	if($varID>0)
    	$strSQL = 'SELECT * FROM tblarticles WHERE id='. $varID;
	else
		$strSQL = "SELECT * FROM tblarticles ORDER BY id DESC LIMIT 1;";
    $rs  = mysqli_query($db, $strSQL);
    if($row = mysqli_fetch_array($rs))
	{
		$this->id  = $row['id'];
		$this->titlear = $row['atitle'];
		$this->descar = $row['abody'];
		$this->adate = $row["adate"];
		$this->atags = $row["atags"];
		$this->aimage = $row["aimage"];
		$this->abrief = $row["abrief"];
	}
  }
}

// class Search extends Article
// implements method search_articles

class Search extends Article{
  public function getSearch($strTitle, $limit)
  {
	$db = $GLOBALS['db'];
	$strSQL = "SELECT id, atitle as name, atitle as tagtitle, 0 FROM tblarticles WHERE (atitle like '%$strTitle%') limit $limit";
	$rsResult  = mysqli_query($db, $strSQL);

	$this->arr_results  = $rsResult;

  }	
}
