<article<?php print $attributes; ?>>
  <?php print $user_picture; ?>
  <?php if (!$page && $title): ?>
  <header>
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?>
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
?>
<div id="celebrity-wrapper">
                	<div id="celebrity">
<?php 
      print render($content);
    ?>
</div> <!--#celebrity-wrapper-->
</div> <!--#celebrity-->
<div id="sponsors">
                	<h3>Sposored <span>by</span></h3>
                    <a class="linked" id="gibson" href="#">gibson</a>
                    <a class="linked" id="nike" href="#">nike</a>
                    <a class="linked" id="vw" href="#">vw</a>
                    <a class="linked" id="star" href="#">star</a>
                </div>
  </div>
  
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>

    <?php  print render($content['comments']); ?>
  </div>
</article>