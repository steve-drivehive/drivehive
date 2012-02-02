<header<?php print $attributes; ?>>
<?php if(drupal_is_front_page()){ ?>
<div id="baner-part2">
	<div id="baner-images">
		<ul>
			<li id="no1">
				<img src="img/temp/baner-text.png" alt="" class="fake-text"/>
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