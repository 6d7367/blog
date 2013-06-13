<?php if(!class_exists('raintpl')){exit;}?><?php $counter1=-1; if( isset($list) && is_array($list) && sizeof($list) ) foreach( $list as $key1 => $value1 ){ $counter1++; ?>

    <h1>
        <a href="/blog/view/<?php echo $value1["id"];?>"><?php echo $value1["title"];?></a>
    </h1>
    <div>
        <?php echo substr($value1["content"], 0, 500); ?>...
    </div>
    <div class="article_menu">
        <b>Posted on <?php echo $value1["created_at"];?></b>
        <a href="/blog/view/<?php echo $value1["id"];?>">Read all</a>
    </div>
<?php } ?>