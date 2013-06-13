<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>
<body>
<div id="container">
  <div id="header">
    <h1><a href="/">blog<strong>.LOC</strong></a></h1>
    <h2>For all your blogging needs.</h2>
    <ul id="nav">
      <li><a href="/" accesskey="h"><em>H</em>ome</a></li>
      <li><a href="#css" title="CSS and XHTML (a:c)" accesskey="c"><em>c</em>ss &amp; xhtml</a></li>
      <li><a href="#about" title="All about me (a:a)" accesskey="a"><em>A</em>bout the author</a></li>
      <li><a href="#contact" title="Get in Touch (a:o)" accesskey="o">C<em>o</em>ntact</a></li>
    </ul>
  </div>
  <div id="sidebar">
    <h1>Last Entries</h1>
    <ul class="submenu">
      <?php $counter1=-1; if( isset($sidebar) && is_array($sidebar) && sizeof($sidebar) ) foreach( $sidebar as $key1 => $value1 ){ $counter1++; ?>
        <li><a href="/blog/view/<?php echo $value1["id"];?>"><?php echo $value1["title"];?></a></li>
      <?php } ?>
    </ul>
    <p class="note"> Here is a special paragraph for any important notes that you might want to display. </p>
  </div>
  <div id="content">
      <?php if( isset($type) ){ ?>
        <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("login") . ( substr("login",-1,1) != "/" ? "/" : "" ) . basename("login") );?>
      <?php }else{ ?>
        <?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("list") . ( substr("list",-1,1) != "/" ? "/" : "" ) . basename("list") );?>
      <?php } ?>

  </div>
<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>
  </body>
</html>
