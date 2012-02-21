<?php
function drivehive_event_rss() { 
	$event_nid = arg(1);
	$event_node = node_load($event_nid);
	$event_title = $event_node->title;
   $query = db_select('field_data_field_event_ref', 'fdfer')
			->condition('field_event_ref_target_id', $event_nid)
			->condition('n.status', 1)
			->fields('fdfer', array('entity_id'));
	$query->leftJoin('node', 'n', 'n.nid = fdfer.entity_id');
   $result = $query->execute();
foreach($result as $key=>$value){
	$nids[] = $value->entity_id;
}
  $channel['title'] = t('!event_title updates', array('!event_title' => $event_title));
  $channel['link'] = url('blog', array('absolute' => TRUE));
  return node_feed($nids, $channel);
}