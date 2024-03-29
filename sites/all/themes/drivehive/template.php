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

/*
 * @param $node
 *   A node object
 * @param $img_field 
 *   The image field you want to return, themed
 * @param $style 
 *   The imagecache style to apply to this image
 * @return 
 *   fully themed image markup
 * 
 */
function grab_node_image($node, $img_field, $style){
	$wrapper = entity_metadata_wrapper('node', $node);
	$img_file_info = $wrapper->{$img_field}->value();
        return theme('image_style', array('style_name' => $style, 
            'path' => $img_file_info['uri'], 
            'alt' => $img_file_info['alt'], 
            'title' => $img_file_info['title'],
            ));
}

function drivehive_preprocess_page(&$vars) {
    global $base_url;
    drupal_add_js(path_to_theme().'/js/drivehive.js');
    drupal_add_js(path_to_theme().'/js/jquery.cycle.all.js');
    drupal_add_js(path_to_theme().'/js/jquery.main.js');
    $item = menu_get_item();
    
    if(drupal_is_front_page()){
        $vars['banner_class'] = 'banner-tall';
    }elseif(!empty($item['page_arguments'][0]->type)){
        if($item['page_arguments'][0]->type == 'event'){
            drupal_add_js(path_to_theme().'/js/drivehive_event.js');
            $vars['banner_class'] = 'banner-tall';
        }else{
            $vars['banner_class'] = 'banner-generic';
        }
    }else{
        $vars['banner_class'] = 'banner-generic';
    }
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
        $banner_count = 0;
        foreach($result as $key=>$value){
            $promoted_nid = $value->nid;
            $event_node = node_load($value->nid);
            $wrapper = entity_metadata_wrapper('node', $event_node);
            $title = t('<div class = "frontpage-current-label">CURRENT EVENT:</div><div class="homepage-event-title">@title</div>', array('@title' => strtoupper($wrapper->title->value())));
            $alignment_class = 'overlay-right';
            $overlay_txt_color = $wrapper->field_event_detail_overlay_color->value();
            $overlay_style = !empty($overlay_txt_color) ? ' style = "color:#' . $overlay_txt_color . '" ' : ' style="color:#000" ';
            $product_id = $wrapper->field_event_product->product_id->value();
            $amount_pledged = drivehive_goal_progress($product_id);
            
            $goal = $wrapper->field_event_goal->value();
            $goal_percent = round($amount_pledged / $goal, 2);
            $goal_percent_printed = substr(round($amount_pledged / $goal, 2), -2);
            
            /*
             *  Thermometer image width is 197px, need to calculate percentage of width to move yellow image over
             */
            
            $thermometer_width = round(($goal_percent * 197), 0) . 'px';
            $therm_fg_style = "width:" . $thermometer_width;
            //print '<pre style="color:orange;font-size:11px;">';
            //print $therm_fg_style;
            //print '</pre>';
            $thermometer_section = '<div id = "therm-container"><div style="' . $therm_fg_style . '" class="therm-fg"></div><div class="therm-bg"></div><div class="frontpage-percent">' . $goal_percent_printed . '%</div></div>';
            $frontpage_desc = empty($wrapper->field_frontpage_desc) ? '' : '<div class="frontpage-desc">' . strtoupper($wrapper->field_frontpage_desc->value()) . '</div>';
            $event_banner_overlay =  '<div class="frontpage-banner-overlay hide ' . $alignment_class . '" ' . $overlay_style . '>' . $title . $frontpage_desc . '<div class="current-goal">CURRENT GOAL:</div>' . $thermometer_section . '</div>';
            $event_alias = $base_url . '/' . drupal_get_path_alias('node/' . $value->nid);
            $promoted_banners .= '<div id = "banner-container" class="slide" ><a href="' . $event_alias . '">' . $event_banner_overlay . '</a><div>' . grab_node_image($event_node, 'field_event_detail_banner', 'event_detail_banner') . '</div></div>';
            $banner_count ++;
        }
        // Only slide if there are multiple front page events.
        if($banner_count > 1){
            drupal_add_js(path_to_theme() . '/js/drivehive_frontpage_slide.js', 'file');
        }
        $vars['page_banner'] = '<div id ="banner-front-container">' . $promoted_banners . '</div>';
    }elseif(!empty($item['page_arguments'][0]->type)){
        if($item['page_arguments'][0]->type == 'event'){
            $event_product_id = $item['page_arguments'][0]->field_event_product['und'][0]['product_id'];
            $event_banner_large_txt = '<div class = "event-detail-large-banner-txt">' . $item['page_arguments'][0]->field_event_banner_large_txt['und'][0]['value'] . '</div>';
            $event_banner_small_txt = '<div class = "event-detail-small-banner-txt">' . $item['page_arguments'][0]->field_event_banner_small_txt['und'][0]['value'] . '</div>';
            $with_your_pledge = '<div class="event-detail-with-your-pledge">' . $item['page_arguments'][0]->field_with_your_pledge['und'][0]['value'] . '</div>';
            $overlay_alignment = $item['page_arguments'][0]->field_overlay_alignment['und'][0]['value'];
            $alignment_class = $overlay_alignment == 'Left' ? 'overlay-left' : 'overlay-right';
            $event_final_goal_amt = number_format($item['page_arguments'][0]->field_event_goal['und'][0]['value']);
            $goal_status = 0;
            $goal_section = '<div class="goal-overlay"><div class="goal-status">$' . $goal_status . '</div><div class = "pledged-of">PLEDGED OF $' . $event_final_goal_amt . '</div><div class="event-detail-product-id">' . $event_product_id . '</div></div>';            
            $overlay_txt_color = $item['page_arguments'][0]->field_event_detail_overlay_color['und'][0]['jquery_colorpicker'];
            $overlay_style = !empty($overlay_txt_color) ? ' style = "color:#' . $overlay_txt_color . '" ' : ' style="color:#000" ';
            $event_timestamp = strtotime($item['page_arguments'][0]->field_event_date['und'][0]['value']);
            $event_day = date('d', $event_timestamp);
            $event_month = date('m', $event_timestamp);
            $event_year = date('y', $event_timestamp);
            $event_date = '<div class="event-detail-date">' . $event_month . '.' . $event_day . '.' . $event_year . '</div>';
            $event_banner_overlay =  '<div class="event-detail-banner-overlay ' . $alignment_class . '" ' . $overlay_style . '>' . $event_banner_large_txt . $event_banner_small_txt . $event_date . $goal_section . $with_your_pledge . '</div>';
            $event_node = $item['page_arguments'][0];
            $vars['page_banner'] = '<div id ="banner-container" >' . $event_banner_overlay . grab_node_image($event_node, 'field_event_detail_banner', 'event_detail_banner') . '<div id="pledge-button"></div>
                </div>';
        }
    }
}

function drivehive_preprocess_node(&$vars) {
    global $base_url;
    $nid = $vars['nid'];
    $node = node_load($nid);
    $vars['event_sponsors'] = '';
    $vars['timestamp'] = $vars['created'];
    // if this is a blog post, find what event it is referencing.
    if($vars['type'] == 'blog'){
        $last_related_blog = db_query("select field_event_ref_target_id from field_data_field_event_ref where entity_id = :nid", array(':nid' => $nid))->fetchField();
        if(!empty($last_related_blog)){
            $parent_event_comment_count = db_query("select count(cid) from {comment} where nid = :nid", array(':nid' => $last_related_blog))->fetchField();
            $vars['parent_event_comment_count'] = $parent_event_comment_count . ' ' . format_plural($parent_event_comment_count, 'Comment', 'Comments');
            $vars['related_event_node'] = node_load($last_related_blog);
        }
    }
    if($vars['type'] == 'event'){
        if(!empty($vars['field_guest_face_pic'])){
            $vars['guest_face_pic'] = '<div id="guest_face_pic">' . grab_node_image($node, 'field_guest_face_pic', 'guest_face_pic') . '</div>';
        }
        if(!empty($vars['field_guest_quote'])){
            $vars['guest_quote'] = '<div class="quote">' . $vars['field_guest_quote']['und'][0]['value'] . '</div>';
        }
        if(!empty($vars['field_charity_pic'])){
            $vars['charity_pic'] = '<div id="charity-pic">' . grab_node_image($node, 'field_charity_pic', 'guest_face_pic') . '</div>';
        }
        // Pull in the last blog post that references this event.
        $last_related_blog = db_query("SELECT entity_id from {field_data_field_event_ref} where field_event_ref_target_id = :nid order by entity_id desc", array(':nid' => $nid))->fetchField();
        if(!empty($last_related_blog)){
            $last_blog_node = node_load($last_related_blog);
            $vars['last_related_blog'] = '<div id="blog"><div class="frame-wrapper"><div class="frame">' . drupal_render(node_show($last_blog_node)) . '</div> <!-- .frame --></div> <!-- .frame-wrapper --></div> <!-- #blog -->';
        }



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
    $node_type = '';
    
    $item = menu_get_item();
    //debug($item);
    if(is_array($item['load_functions'])){
        if(in_array('node_load', $item['load_functions'])){
            $node_type = $item['page_arguments'][0]->type;
        }
    }
        else{
            $node_type = '';
        }
    if(drupal_is_front_page()){
        return 'home';
    }elseif(arg(0) == 'user'){
        return 'user';
    }elseif($node_type == 'blog' || arg(0) == 'blog'){
        //return 'page-blog';
        return 'generic';
    }elseif($node_type == 'event'){
        return 'event-detail';
    }elseif($item['path'] == 'cart'){
        return 'generic';
    }else{
        return 'generic';
    }
}