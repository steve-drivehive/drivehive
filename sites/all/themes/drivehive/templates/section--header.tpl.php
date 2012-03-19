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

  <?php print $content; ?>
	</div><!-- /baner-contents -->
</div><!-- /baner-part2 -->
<?php }else{
	print $content;
} ?>
</header>