<script type="text/javascript">
    function clickEditOnFly(divId){
        $('#divAjax'+divId).show();
    }
    function editAjax(id)
    {
        var num = $('#number'+id).val();
        $.ajax({
                url: "books/editAjax",
                type: "POST",
                data: {"id":id, "number":num},
                success: function(data)
                {
                    $('#divAjax'+id).html('edited!');
                }
            });
    }
</script>
<h2><?php echo $title; ?></h2>
 
<table border='1' class="table" cellpadding='4'>
    <tr>
        <td><strong>Title</strong></td>
        <td><strong>Content</strong></td>
        <td><strong>Date</strong></td>
        <td><strong>Action</strong></td>
    </tr>
<?php foreach ($news as $news_item): ?>
        <tr>
            <td><?php echo $news_item['name']; ?></td>
            <td><?php echo $news_item['number']; ?>
                <div id="divAjax<?php echo($news_item['id'])?>" style="display: none"> <input type="text" name="number<?php echo($news_item['id'])?>" id="number<?php echo($news_item['id'])?>" value="<?php echo $news_item['number']; ?>" class="form-control input-sm">
                    <input type="button" name="button" onclick="editAjax(<?php echo $news_item['id']; ?>)" value="edit">
                </div>           
            </td>
            <td><?php echo $news_item['adddate']; ?></td>
            <td>
                <a href="javascript:;" onclick="clickEditOnFly(<?php echo($news_item['id'])?>);" name="editOnFly<?php echo($news_item['id'])?>">Edit Number AJAX</a> | 
                <a href="<?php echo site_url('books/edit/'.$news_item['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('books/delete/'.$news_item['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
<?php endforeach; ?>
</table>