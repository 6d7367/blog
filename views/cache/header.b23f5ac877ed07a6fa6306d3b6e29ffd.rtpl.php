<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>Mini Blog</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/css/1.css" type="text/css" media="screen,projection" />
    <script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <?php if( $type == 'admin' ){ ?>

        <script>
            tinymce.init({selector:'textarea'});
        </script>
    <?php } ?>

</head>
<!-- header ends here -->