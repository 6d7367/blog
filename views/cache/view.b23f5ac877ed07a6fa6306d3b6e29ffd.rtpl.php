<?php if(!class_exists('raintpl')){exit;}?><h1>
    <a href="/blog/view/<?php echo $content["id"];?>"><?php echo $content["title"];?></a>
</h1>
<div>
    <?php echo $content["content"];?>

</div>
<div class="article_menu">
    <b>Posted on <?php echo date('l d F Y G:i', strtotime($content["created_at"])); ?></b>
</div>

<div>
    <h2>Comments</h2>
    <div id='comments'>
        <?php $counter1=-1; if( isset($comments) && is_array($comments) && sizeof($comments) ) foreach( $comments as $key1 => $value1 ){ $counter1++; ?>

        <div>
            <h3>
                <?php echo $value1->author;?> / <?php echo $value1->title;?> / <?php echo date('l d F Y G:i', strtotime($value1->created_at)); ?>

            </h3>
            <div>
                <?php echo $value1->content;?>

            </div>
        </div>
        <?php } ?>

    </div>
    <form action='/blog/comment' method="post" name='comment'>
        <input type='hidden' name='entry_id' value='<?php echo $content["id"];?>' />
        <p>
            Your name:<br />
            <input type='text' name='author' />
        </p>
        <p>
            Your comment's title:<br />
            <input type='text' name='title' />
        </p>
        <p>
            Your comment:<br />
            <textarea name='content' style='width: 100%; height: 100px;'></textarea>
        </p>
        <p>
           <input type='submit' value='Comment' />
        </p>
    </form>
</div>