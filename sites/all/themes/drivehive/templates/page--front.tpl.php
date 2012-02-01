<?php 
/**
 * @file
 * Alpha's theme implementation to display a single Drupal page.
 */
?>
<div id="baner-part2">
	<div id="baner-images">
		<ul>
			<li id="no1">
				<img src="img/temp/baner-text.png" alt="" class="fake-text"/>
			</li>

		</ul>
	</div><!-- /baner-images -->
	<div id="baner-contents">
<div<?php print $attributes; ?>>
  <?php if (isset($page['header'])) : ?>
    <?php print render($page['header']); ?>
  <?php endif; ?>
	
	</div><!-- /baner-contents -->
  </div><!-- /baner-part2 -->
  
  <?php if (isset($page['content'])) : ?>
    <?php print render($page['content']); ?>
  <?php endif; ?>  

  <?php if (isset($page['footer'])) : ?>
    <?php print render($page['footer']); ?>
  <?php endif; ?>
</div>