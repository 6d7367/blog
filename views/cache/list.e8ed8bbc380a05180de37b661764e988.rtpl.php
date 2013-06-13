<?php if(!class_exists('raintpl')){exit;}?><script xmlns="http://www.w3.org/1999/html">

globalEditorContent = '';

function toggleComments(div)
{
    $(div).toggle();
}

function removeEntry(entry_id)
{
    $('#entry' + entry_id).remove();

    $.ajax({
        type: "POST",
        url: '/admin/remove_entry',
        data: {entry_id: entry_id}
    });
}

function removeComment(entry_id, comment_id)
{
    $('#comment' + comment_id).remove();

    $.ajax({
        type: "POST",
        url: '/admin/remove_comment',
        data: {entry_id: entry_id, comment_id: comment_id}
    });
}

function showEdit(entry_id)
{
    globalEditorContent = tinymce.get('hidden_content_textarea' + entry_id).getContent();

    $('#shown_content' + entry_id).hide()
    $('#hidden_content' + entry_id).show()
}

function cancelEdit(entry_id)
{
    $('#shown_content' + entry_id).show()
    $('#hidden_content' + entry_id).hide()

    tinymce.get('hidden_content_textarea' + entry_id).setContent(globalEditorContent);

}

function saveEdit(entry_id)
{
    content = tinymce.get('hidden_content_textarea' + entry_id).getContent();
    $.ajax({
        type: "POST",
        url: '/admin/update',
        data: {entry_id: entry_id, content: content}
    });

    //console.log();

    $('#shown_content' + entry_id).html(tinymce.get('hidden_content_textarea' + entry_id).getContent());

    globalEditorContent = tinymce.get('hidden_content_textarea' + entry_id).getContent();

    $('#shown_content' + entry_id).show()
    $('#hidden_content' + entry_id).hide()
}


$(function()
{
    $(".comments").hide();
})
</script>
<style>
.comment
{
    margin-bottom: -15px;
}
</style>
<div>
    <?php $counter1=-1; if( isset($list) && is_array($list) && sizeof($list) ) foreach( $list as $key1 => $value1 ){ $counter1++; ?>

        <div id='entry<?php echo $value1["id"];?>'>
            <p>
                <h1>
                    <span onclick="removeEntry(<?php echo $value1["id"];?>); return false;">
                        <img src='/images/delete.png' style='width: 12px; vertical-align: baseline;' >
                    </span>
                    / <?php echo $value1["title"];?> / <?php echo date('l d F Y G:i', strtotime($value1["created_at"])); ?>

                </h1>
            </p>
            <div>
                <div id='shown_content<?php echo $value1["id"];?>'>
                    <?php echo substr($value1["content"], 0, 300); ?> ... <a href='#'></a>
                </div>
                <strong onclick="showEdit(<?php echo $value1["id"];?>); return false;">Edit</strong>
                <div id='hidden_content<?php echo $value1["id"];?>' style='display: none;'>
                    <textarea id='hidden_content_textarea<?php echo $value1["id"];?>'><?php echo $value1["content"];?></textarea>
                    <p>
                        <input type='button' value='Save' onclick='saveEdit(<?php echo $value1["id"];?>); return false;'/>
                        <input type='button' value='Cancel' onclick='cancelEdit(<?php echo $value1["id"];?>); return false;'/>
                    </p>
                </div>
                <h2 onclick="toggleComments('#comments<?php echo $value1["id"];?>')">
                    <?php if( count($value1["comments"]) > 0 ){ ?>

                        Comments (<?php echo count($value1["comments"]); ?>)(Show/Hide)
                    <?php }else{ ?>

                        No comments
                    <?php } ?>

                </h2>
                <div id='comments<?php echo $value1["id"];?>' class="comments" style='margin-left: 15px;'>
                    <?php $counter2=-1; if( isset($value1["comments"]) && is_array($value1["comments"]) && sizeof($value1["comments"]) ) foreach( $value1["comments"] as $key2 => $value2 ){ $counter2++; ?>

                        <div id='comment<?php echo $value2->id;?>'>
                            <p class='comment'>
                                <a href='' onclick="removeComment(<?php echo $value2->entry_id;?>, <?php echo $value2->id;?>); return false;">
                                    <img src='/images/delete.png' style='width: 10px; vertical-align: baseline;'>
                                </a>
                                / <?php echo $value2->author;?> / <?php echo $value2->title;?> / <?php echo date('l d F Y G:i', strtotime($value2->created_at)); ?>

                            </p>
                            <div>
                                <p><?php echo $value2->content;?></p>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    <?php } ?>

</div>