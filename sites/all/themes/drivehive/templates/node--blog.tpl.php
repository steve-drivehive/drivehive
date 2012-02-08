<article<?php print $attributes; ?>>
  <?php print $user_picture; ?>
  <?php if (!$page && $title): ?>
  <header>
	<div class="cols" id="rss_update">
	                    		<span><h6>UPDATES</h6>
	                            <a href="#"> / / / / / / / / / / / / </a></span>
	                        </div>
    <?php print render($title_prefix); ?>
    <h2><?php print $title ?></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?> 

  <div id="posted">
                        	<span>Posted <?php print date('F, jS', $timestamp); ?> | <?php print $parent_event_comment_count; ?> COMMENT(S)</span>
                        </div>
  
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  <?php 

	if(arg(1) == $node->nid){
		?>
		<div class="clearfix">
	    <?php if (!empty($content['links'])): ?>
	      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
	    <?php endif; ?>

	    <?php  //print render($content['comments']); ?>
	  </div>
		<?php
		
	}
// NOTE: $related_event_node contains the related event node object.	

 ?>

</article>