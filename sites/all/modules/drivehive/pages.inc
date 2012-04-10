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
function drivehive_ajax_goal_status(){
    $product_id = arg(1);
	$query = "SELECT MIN(commerce_line_item_field_data_commerce_line_items.line_item_id) AS commerce_line_item_field_data_commerce_line_items_line_item_, 'commerce_line_item' AS field_data_commerce_total_commerce_line_item_entity_type, SUM(commerce_line_item_field_data_commerce_line_items__field_data_commerce_total.commerce_total_amount) AS commerce_line_item_field_data_commerce_line_items__field_dat, SUM(commerce_line_item_field_data_commerce_line_items__field_data_commerce_total.commerce_total_currency_code) AS commerce_line_item_field_data_commerce_line_items__field_dat_1
	FROM 
	{commerce_order} commerce_order
	LEFT JOIN {field_data_commerce_line_items} field_data_commerce_line_items ON commerce_order.order_id = field_data_commerce_line_items.entity_id AND (field_data_commerce_line_items.entity_type = 'commerce_order' AND field_data_commerce_line_items.deleted = '0')
	INNER JOIN {commerce_line_item} commerce_line_item_field_data_commerce_line_items ON field_data_commerce_line_items.commerce_line_items_line_item_id = commerce_line_item_field_data_commerce_line_items.line_item_id
	LEFT JOIN {field_data_commerce_product} commerce_line_item_field_data_commerce_line_items__field_data_commerce_product ON commerce_line_item_field_data_commerce_line_items.line_item_id = commerce_line_item_field_data_commerce_line_items__field_data_commerce_product.entity_id AND (commerce_line_item_field_data_commerce_line_items__field_data_commerce_product.entity_type = 'commerce_line_item' AND commerce_line_item_field_data_commerce_line_items__field_data_commerce_product.deleted = '0')
	LEFT JOIN {field_data_commerce_total} commerce_line_item_field_data_commerce_line_items__field_data_commerce_total ON commerce_line_item_field_data_commerce_line_items.line_item_id = commerce_line_item_field_data_commerce_line_items__field_data_commerce_total.entity_id AND (commerce_line_item_field_data_commerce_line_items__field_data_commerce_total.entity_type = 'commerce_line_item' AND commerce_line_item_field_data_commerce_line_items__field_data_commerce_total.deleted = '0')
	WHERE (( (commerce_order.status IN  ('pending')) AND (commerce_line_item_field_data_commerce_line_items__field_data_commerce_product.commerce_product_product_id = '2') ))";
	
    //get the total amount of this product_id sold, print here for ajax retrieval on event detail goal counter.
    print '400';
    return null;
}