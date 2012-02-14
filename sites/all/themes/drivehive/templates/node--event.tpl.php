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



<div id="sponsors">
<h3>Sposored <span>by</span></h3>
<?php
$nid = arg(1);
print drivehive_event_sponsors($nid);
?>

  </div>
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
				</div>
				</div>
				</div>
				<?php
		}
		
		?>

  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
	    <?php  print render($content['comments']); ?>

		<div class="frame-wrapper" id="recent">
		                	<div class="frame">
		                    	<h4>Recent posts</h4>
		                        <ul>
		                        	<li>
		                            	<div class="recent-pic">
		                                	<img alt="" src="img/temp/recent-pic1.jpg">
		                                </div><!-- /recent-pic -->
		                                <div class="recent-txt">
		                                	<a href="#">Location for the Concert Event Announced</a>
		                                    <p>Be there or be square...no seriously</p>
		                                    <span>September 1, 2011</span>
		                                </div><!-- /recent-text -->
		                            </li>
		                            <li>
		                            	<div class="recent-pic">
		                                	<img alt="" src="img/temp/recent-pic2.jpg">
		                                </div><!-- /recent-pic -->
		                                <div class="recent-txt">
		                                	<a href="#">Starbucks Giveaway</a>
		                                    <p>Free Starbucks on the day of the event to any members with a code!</p>
		                                    <span>August 30, 2011</span>
		                                </div><!-- /recent-text -->
		                            </li>
		                            <li>
		                            	<div class="recent-pic">
		                                	<img alt="" src="img/temp/recent-pic3.jpg">
		                                </div><!-- /recent-pic -->
		                                <div class="recent-txt">
		                                	<a href="#">Coldplay Preview</a>
		                                    <p>Coldplay releases a video message encouraging fans</p>
		                                    <span>August 25, 2011</span>
		                                </div><!-- /recent-text -->
		                            </li>
		                            <li>
		                            	<div class="recent-pic">
		                                	<img alt="" src="img/temp/recent-pic4.jpg">
		                                </div><!-- /recent-pic -->
		                                <div class="recent-txt">
		                                	<a href="#">Event Selected!</a>
		                                    <p>Coldplay to Release Unheard Single. See what all the hubub is about</p>
		                                    <span>August 20, 2011</span>
		                                </div><!-- /recent-text -->
		                            </li>
		                        </ul>
		                        <div id="see-all">
		                        	<a href="#">see all</a>
		                        </div><!-- /see-all -->
		                    </div><!-- /frame -->
		                </div>
	<div id="event-detail-lower">


	</div> <!-- #event-detail-lower -->

  </div>
</article>

