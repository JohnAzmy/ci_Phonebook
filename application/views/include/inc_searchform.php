<?php
$pfilename = $_SERVER['REQUEST_URI'];
$isSearch =0;
$isPost=0;

if($isSearch == 0){
?>
<script type="text/javascript">
	function ClickSearchSubmit(){
		$("#formMenuSearch").submit();
		return false;
	}
	$(".token-input-input-token-facebook").click(function() {
	  $(this).find("div").attr("href").val('#'); 
	  return false;
	});
</script>
<form id="formMenuSearch" method="post" action="">
    <div class="form-group">
    
    
    <div class="input-group">
        <input type="hidden" id="txtId" name="txtId" value="">
        <input type="hidden" id="txtType" name="txtType" value="0"> <?php // 0=products 3=recipes ?>
        <!--<input type="hidden" id="txtSearch" size="50" name="txtSearch">-->
    
        <input id="txtSearch" size="50" name="txtSearch" class="form-control"  placeholder="Search for...">
        <script type="text/javascript">
        $(document).ready(function () {
        $("#txtSearch").tokenInput("../HomeController/search_ajax", {
            //theme: "facebook",
            tokenLimit:1,
            propertyToSearch: "name",
            resultsFormatter: function (item) { 
                return "<li class='token-input-input-token-facebook'>" + "<div style='display: inline-block;'>" + item.tagtitle + "</div></li>" },
            onAdd: function(item) {
                $("#txtId").val(item.id);
                $("#txtType").val(item.newstype);
                $("#txtSearch").val(item.name);
            },
        });
        });
        </script>
        <span class="input-group-btn">
            <input type="button" name="but1" id="but1" value="Search" onClick="ClickSearchSubmit()" pname="<?php echo($pfilename)?>" class="text-center btn btn-default" >
        </span>
    </div>
    </div>
    </form>
<?php } ?>