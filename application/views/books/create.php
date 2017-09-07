<script type="text/javascript">
	tinyMCE.init({
        mode : "textareas",
        theme : "modern",
		plugins: "code, table, link",
		tools: "inserttable",
        editor_selector : "rte1"
	});
	tinyMCE.init({
        mode : "textareas",
        theme : "modern",
		plugins: "code, table, link",
		tools: "inserttable",
		directionality : 'rtl',
        editor_selector : "rte2"
	});
	
	</script>
        
<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('books/create'); ?>    
    <table>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" size="50" value="" class="form-control" />
        </div>
        <div class="form-group">
            <label for="number">Number: </label> 
            <input class="form-control" name="number" id="number" type="text" value="" class="form-control" />
        </div>
        <div class="form-group">
            <label for="txtDescAr">Active: </label>
            <input type="checkbox" name="chkActive" id="chkActive" value="1" class="form-control">
        </div>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Create news item" /></td>
        </tr>
    </table>    
<?php echo form_close();?>