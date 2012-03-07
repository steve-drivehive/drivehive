<?php if($teaser): ?>

<?php 
global $base_url;
$output = '';

$blog_link_alias = $base_url . '/' . drupal_get_path_alias('node/' . $node->nid);
            
            $blog_img_file = $node->field_blog_image['und'][0]['filename'];
            $blog_img_uri = $node->field_blog_image['und'][0]['uri'];
            $blog_img_path = '/sites/default/files/' . $blog_img_file;
            $blog_img_alt = $node->field_blog_image['und'][0]['alt'];
            $blog_img_title = $node->field_blog_image['und'][0]['title'];     
            $blog_img = '<a href = "' . $blog_link_alias .' ">' . 
                theme('image_style', array('style_name' => 'blog_teaser_thumb', 
                            'path' => $blog_img_uri, 
                            'alt' => 'image alt', 
                            'title' => $blog_img_title, )) . '</a>';
            
                        $blog_title = strlen($node->title) > 30 ? substr($node->title, 0, 30) . '...' : $node->title;
                        $blog_teaser_body = empty($node->body[0]['value']) ? $node->body['und'][0]['value'] : $node->body[0]['value'];
            $blog_teaser_body = strip_tags(trim($blog_teaser_body));
            
            $blog_teaser_body = strlen($blog_teaser_body) > 50 ? substr($blog_teaser_body, 0, 50) . '...' : $blog_teaser_body;
$output .= '<div class="recent-pic">' . $blog_img . '</div><!-- /recent-pic -->';
            $output .= '<div class="recent-txt">' . l($blog_title, $blog_link_alias, array('attributes' => array('title' => $node->title))) . '<p>' . $blog_teaser_body . '</p><span>' . format_date($node->created, 'long') . '</span></div><!-- /recent-text -->';

print $output;
?>
<?php else: ?>

<article<?php print $attributes; ?>>
  <?php if (!$page && $title): ?>
  <header>
	<div class="cols" id="rss_update">
	                    		<span><h6>UPDATES</h6>
                                            <?php print l('/ / / / / / / / / / / /', 'event_rss/' . $related_event_node->nid, array(
                                                'attributes'=> array('target' => '_blank')
                                            )); ?>
	                        </div>
    <?php print render($title_prefix); ?>
    <h2><?php print $title ?></h2>
    <?php print render($title_suffix); ?>
  </header>
  <?php endif; ?> 

  <div id="posted">
                        	<span>Posted <?php print date('F, jS', $timestamp); ?> | <?php 
if(!empty($parent_event_comment_count)){
	print $parent_event_comment_count;
}

 ?></span>
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
<?php endif; ?>