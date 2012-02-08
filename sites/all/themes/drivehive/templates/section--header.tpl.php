<header<?php print $attributes; ?>>
<?php $node = node_load(arg(1)); ?>
<?php if(drupal_is_front_page() || $node->type == 'event'){ ?>
<div id="baner-part2">
	<div id="baner-images">
		<ul>
			<li id="no1">
				<img src="/sites/all/themes/drivehive/images/temp/baner-text.png" alt="" class="fake-text"/>
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