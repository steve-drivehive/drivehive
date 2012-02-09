<?php

/**
 * @file
 * Default theme implementation to provide an HTML container for comments.
 *
 * Available variables:
 * - $content: The array of content-related elements for the node. Use
 *   render($content) to print them all, or
 *   print a subset such as render($content['comment_form']).
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default value has the following:
 *   - comment-wrapper: The current template type, i.e., "theming hook".
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * The following variables are provided for contextual information.
 * - $node: Node object the comments are attached to.
 * The constants below the variables show the possible values and should be
 * used for comparison.
 * - $display_mode
 *   - COMMENT_MODE_FLAT
 *   - COMMENT_MODE_THREADED
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_comment_wrapper()
 * @see theme_comment_wrapper()
 */
global $user;
?>
<div id="blog">
	<div class="frame-wrapper">
 	<div class="frame">
	<?php
	// Pull in the last blog post that references this event.
	$nid = arg(1);
	$last_related_blog = db_query("SELECT entity_id from {field_data_field_event_ref} where field_event_ref_target_id = :nid order by entity_id desc", array(':nid' => $nid))->fetchField();
	if(!empty($last_related_blog)){
			$last_blog_node = node_load($last_related_blog);
			print drupal_render(node_show($last_blog_node));
	}
	?>
<div id="comments" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if ($content['comments'] && $node->type != 'forum'): ?>
    <?php print render($title_prefix); ?>
    <?php print render($title_suffix); ?>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

  <?php if ($content['comment_form']): ?>
<div id="leave-comment"><span class="box-title">LEAVE COMMENT</span>
	<?php
	if($user->uid != 0){
		print 'Signed in as ' . l($user->name, '/user/' . $user->uid);
	}else{
		print '<div id="login"><a href="/user">SIGN IN</a> or <a href="/user/register">JOIN</a></div>';
	}
	
	?>
	
    <?php print render($content['comment_form']); ?>
</div>
  <?php endif; ?>
</div>
</div>
</div><!--.frame-wrapper-->
</div><!--.frame-->
