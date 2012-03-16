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

}
function drivehive_preprocess_comment_wrapper(&$vars){
    if(arg(0) == 'node'){
        $parent_event_comment_count = db_query("select count(cid) from {comment} where nid = :nid", array(':nid' => arg(1)))->fetchField();
        $vars['comment_count'] =  $parent_event_comment_count . ' ' . format_plural($parent_event_comment_count, 'Comment', 'Comments');
    }
}
function drivehive_preprocess_html(&$vars) {
    //include the js file in the header
    drupal_add_js(path_to_theme().'/js/drivehive.js');
}

/*
 * @param $node object
 */
function grab_event_banner($node){
            $event_banner_img_file = $node->field_event_detail_banner['und'][0]['filename'];
            $event_banner_img_uri = $node->field_event_detail_banner['und'][0]['uri'];
            $event_banner_img_path = '/sites/default/files/' . $event_banner_img_file;
            $event_banner_img_alt = $node->field_event_detail_banner['und'][0]['alt'];
            $event_banner_img_title = $node->field_event_detail_banner['und'][0]['title'];
            return theme('image_style', array('style_name' => 'event_detail_banner', 
                        'path' => $event_banner_img_uri, 
                        'alt' => $event_banner_img_alt, 
                        'title' => $event_banner_img_title, ));
}

function drivehive_preprocess_page(&$vars) {
    $item = menu_get_item();
    
    $vars['page_banner'] = '';
    // Grab the first event banner of each promoted event for the home page slider.
    if(drupal_is_front_page()){
        // Don't print the promoted content, just grab the banners.
        unset($vars['page']['content']['content']['content']['system_main']['nodes']);
            $promoted_query = db_select('node', 'n');
            $promoted_query->fields('n', array('nid', 'created', 'title'))
            ->condition('n.promote', 1)
            ->condition('n.type', 'event')
            ->condition('n.status', 1)
            ->orderBy('n.created', 'desc');                        
        $result = $promoted_query->execute();
        $promoted_banners = '';
        foreach($result as $key=>$value){
            $promoted_nid = $value->nid;
            $event_node = node_load($value->nid);
            $promoted_banners .= '<div id = "each_frontpage_slide">' . grab_event_banner($event_node) . '</div>';
        }
        //todo: make js slideshow of the banner array.  For now just printing first one.
        $vars['page_banner'] = $promoted_banners;
    }elseif(!empty($item['page_arguments'][0])){
        if($item['page_arguments'][0]->type == 'event'){
            

            
            $event_node = $item['page_arguments'][0];
            $vars['page_banner'] = grab_event_banner($event_node);
    }
}
}

function drivehive_preprocess_node(&$vars) {
    global $base_url;
    $vars['event_sponsors'] = '';
    
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
    if($vars['type'] == 'event'){
        $vars['event_sponsors'] = '<div id="sponsors">
<h3>Sponsored <span>by</span></h3>' . drivehive_event_sponsors($vars['nid']) . '</div>';
        // grab the last 4 blog posts to print in the right sidebar
        $query = db_select('node', 'n');
        $query->fields('n', array('nid', 'created', 'title'))
            ->condition('n.type', 'blog')
            ->condition('n.status', 1)
            ->orderBy('n.created', 'desc');                        
        $result = $query->execute();
        $recent_blogs = '';
        $recent_blogs .= '<ul>';
        foreach($result as $key=>$value){
            $node = node_load($value->nid);
            $recent_blogs .= '<li>' . drupal_render(node_view($node, 'teaser')) . '</li>';
        }
        $recent_blogs .= '</ul>';
        $vars['recent_blogs'] = '<div class="frame-wrapper" id="recent">
		                	<div class="frame">
		                    	<h4>Recent posts</h4>' . $recent_blogs . '<div id="see-all">
		                        	<a href="/blog">see all</a>
		                        </div><!-- /see-all -->
		                    </div> <!-- /frame -->
		                </div> <!-- .frame-wrapper -->';
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
        //return 'page-blog';
        return 'generic';
    }elseif($type == 'event'){
        return 'event-detail';
    }else{
        return 'generic';
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
