
<h2><?php echo $title; ?></h2>
 
<?php echo validation_errors(); ?>
 
<?php echo form_open('books/edit/'.$news_item['id']); ?>
    <table>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" size="50" value="<?php echo $news_item['name'] ?>" class="form-control" />
        </div>
        <div class="form-group">
            <label for="number">Number: </label> 
            <input class="form-control" name="number" id="number" type="text" value="<?php echo $news_item['number'] ?>" class="form-control" />
        </div>
        <div class="form-group">
            <label for="txtDescAr">Active: </label>
            <input type="checkbox" name="chkActive" id="chkActive" value="1" <?Php if($news_item['isactive']==1)echo("checked"); ?> class="form-control">
        </div>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Edit item" /></td>
        </tr>
    </table>
<?php echo form_close(); 