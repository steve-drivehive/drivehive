<header<?php print $attributes; ?>>
<?php 
$node = new stdClass();
$node->type = '';
if(arg(0) == 'node' && is_numeric(arg(1))){
	$node = node_load(arg(1)); 
}

?>
<?php 
if(drupal_is_front_page() || $node->type == 'event'){ 
	// hard coded for now till we sort out the banner images
	?>
<div id="baner-part2">
	<div id="baner-images">
		<ul>
			<li id="no1">
				<!--<img src="/sites/all/themes/drivehive/images/temp/baner-text.png" alt="" class="fake-text"/>-->
                            <?php 
                            //print '<pre style="color:orange;">';
                            //print_r($node->field_event_detail_banner);
                                        $event_banner_img_file = $node->field_event_detail_banner['und'][0]['filename'];
            $event_banner_img_uri = $node->field_event_detail_banner['und'][0]['uri'];
            $event_banner_img_path = '/sites/default/files/' . $event_banner_img_file;
            $event_banner_img_alt = $node->field_event_detail_banner['und'][0]['alt'];
            $event_banner_img_title = $node->field_event_detail_banner['und'][0]['title'];
                            print theme('image_style', array('style_name' => 'event_detail_banner', 
                            'path' => $event_banner_img_uri, 
                            'alt' => 'image alt', 
                            'title' => $event_banner_img_title, ))
                            //print '</pre>';
                            ?>
			</li>
		</ul>
	</div><!-- /baner-images -->
	<div id="baner-contents">
  <?php print $content; ?>
	</div><!-- /baner-contents -->
</div><!-- /baner-part2 -->
<?php }else{
	print $content;
} ?>
</header>