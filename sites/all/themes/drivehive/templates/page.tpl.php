<?php 
/**
 * @file
 * Alpha's theme implementation to display a single Drupal page.
 */
?>
<div<?php print $attributes; ?>>
    <div id="baner-part2">
	<div id="baner-images">
                        <div id ="banner-container">
            <?php print $page_banner; ?>
            </div>
		<ul>
			<li id="no1">
				<!--<img src="/sites/all/themes/drivehive/images/temp/baner-text.png" alt="" class="fake-text"/>-->
			</li>
		</ul>
	</div><!-- /baner-images -->
	<div id="baner-contents">
  <?php if (isset($page['header'])) : ?>
    <?php print render($page['header']); ?>
  <?php endif; ?>
  
  <?php if (isset($page['content'])) : ?>
    <?php print render($page['content']); ?>
  <?php endif; ?>  

  <?php if (isset($page['footer'])) : ?>
    <?php print render($page['footer']); ?>
  <?php endif; ?>
</div>