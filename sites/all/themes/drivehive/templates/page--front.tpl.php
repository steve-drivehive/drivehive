<?php 
/**
 * @file
 * Alpha's theme implementation to display a single Drupal page.
 */
?>

<div <?php print $attributes; ?>>
  <?php if (isset($page['header'])) : ?>
    <?php print render($page['header']); ?>
  <?php endif; ?>
	

  
  <?php if (isset($page['content'])) : ?>
<?php 

print render($page['content']); 
/*
print '<pre style="background:#fff; color:orange;font-size:11px;">';
print var_export($page, true);
print '</pre>';
*/
?>
  <?php endif; ?>  

  <?php if (isset($page['footer'])) : ?>
    <?php print render($page['footer']); ?>
  <?php endif; ?>
</div>