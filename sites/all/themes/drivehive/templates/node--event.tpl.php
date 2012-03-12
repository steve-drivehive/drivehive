<article<?php print $attributes; ?>>
  <?php //print $user_picture; ?>
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
	<?php print render($content); ?>
	</div> <!--#celebrity-->
</div> <!--#celebrity-wrapper-->


<?php print $event_sponsors; ?>
  </div>
  	
		<?php
		// Pull in the last blog post that references this event.
		$nid = arg(1);
		$last_related_blog = db_query("SELECT entity_id from {field_data_field_event_ref} where field_event_ref_target_id = :nid order by entity_id desc", array(':nid' => $nid))->fetchField();
		if(!empty($last_related_blog)){
				$last_blog_node = node_load($last_related_blog);
				
				?> 
				<div id="blog">
					<div class="frame-wrapper">
				 	<div class="frame">
				
				<?php 
				print drupal_render(node_show($last_blog_node));
				?>
				</div> <!-- .frame -->
				</div> <!-- .frame-wrapper -->
				</div> <!-- #blog -->
				
				<?php
		}
		
		?>

                                        <?php print $recent_blogs; ?>
		                        


  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php //print render($content['links']); ?></nav>
    <?php endif; ?>
	    <?php  print render($content['comments']); ?>


	<div id="event-detail-lower">


	</div> <!-- #event-detail-lower -->

  </div>
</article>

