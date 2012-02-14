<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */

function drivehive_preprocess_comment(&$vars){
	/*
	print '<pre style="color:red; font-size:11px;">';
	//print_r($vars['content']);
	foreach($vars['content']['comment_body'] as $key=>$value){
		unset($value->subject);
	}
	foreach($vars['content']['comment_body'] as $key=>$value){
		print_r($value);
		print '<hr/>';
	}
	print '</pre>';
	*/
}
function drivehive_preprocess_comment_wrapper(&$vars){
	if(arg(0) == 'node'){
		$parent_event_comment_count = db_query("select count(cid) from {comment} where nid = :nid", array(':nid' => arg(1)))->fetchField();
		$vars['comment_count'] =  $parent_event_comment_count . ' ' . format_plural($parent_event_comment_count, 'Comment', 'Comments');
	}
}

function drivehive_preprocess_node(&$vars) {
	$vars['timestamp'] = $vars['created'];
	// if this is a blog post, find what event it is referencing.
	if($vars['type'] == 'blog'){
			$last_related_blog = db_query("select field_event_ref_target_id from field_data_field_event_ref where entity_id = :nid", array(':nid' => $vars['nid']))->fetchField();
			if(!empty($last_related_blog)){
				$parent_event_comment_count = db_query("select count(cid) from {comment} where nid = :nid", array(':nid' => $last_related_blog))->fetchField();
				$vars['parent_event_comment_count'] = $parent_event_comment_count . ' ' . format_plural($parent_event_comment_count, 'Comment', 'Comments');
				$vars['related_event_node'] = node_load($last_related_blog);
			}
	}
}

/**
* Pick an id to apply to the body of the page for different parts of the site.
*/
function drivehive_body_id(){
	$type = '';
	if(is_numeric(arg(1)) && arg(0) == 'node'){
		$type = db_query("select type from {node} where nid = :nid", array('nid' => arg(1)))->fetchField();
	}
	if(drupal_is_front_page()){
		return 'home';
		}elseif(arg(0) == 'user'){
			return 'user';
		}elseif($type == 'blog' || arg(0) == 'blog'){
			return 'page-blog';
		}elseif($type == 'event'){
			return 'event-detail';
		}
}

function drupal_print($var, $color = 'blue'){
    if($color == 'blue'){
        return drupal_set_message('<pre style="font-size:11px;">' . var_export($var, true) . '</pre>', 'status');
    }	elseif($color == 'red'){
        return drupal_set_message('<pre style="font-size:11px;">' . var_export($var, true) . '</pre>', 'error');
    }	elseif($color == 'yellow'){
        return drupal_set_message('<pre style="font-size:11px;">' . var_export($var, true) . '</pre>', 'warning');
    }else{
        return drupal_set_message('<pre style="font-size:11px;">' . var_export($var, true) . '</pre>', 'white');
    }
}