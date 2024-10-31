<?php
/**
 * @param $catId string nome della categoria genitrice
 * @param $order string ASC o DESC
 * @return $output string lista di link a categorie
 */
function ws_get_category($catId=null, $order='ASC') {
	global $wpdb;
	global $cat;
	 
	$output = '';
	 
	if (strtoupper($order) != 'DESC') $order = 'ASC';
	 
	$query = "select t.term_id as term_ids, t.name from $wpdb->terms t, $wpdb->term_taxonomy tx where t.term_id = tx.term_id and tx.taxonomy = 'category' and tx.parent = 0 group by  t.term_id order by t.term_id $order";
	 
	$results = $wpdb->get_results($query);
	foreach ($results as $result) {
		 
		if (!is_null($catId) AND ($catId == $result->term_ids)): 
                    $selected = ' selected="selcted"';
		else:
                    $selected = '';
                endif;
		 
		$output .= '<option value="'.$result->term_ids.'" '.$selected.'>'.$result->name.'</option>';
		 
	}
	 
	return $output;
}


function ss_category_get($catId=null) {
    global $wpdb;
    if(!is_null($catId)):
    $query = "select t.term_id as term_ids, t.name, t.slug from $wpdb->terms t, $wpdb->term_taxonomy tx 
        where 
        t.term_id = tx.term_id 
        and tx.taxonomy = 'category' 
        and tx.parent = 0
        and t.term_id = $catId
        group by  t.term_id 
        order by t.term_id
    ";

    $results = $wpdb->get_results($query);
    foreach ($results as $result) {
        $catData = array(
            'id'=>$result->term_ids,
            'name'=>$result->name,
            'slug'=>$result->slug
        );
    }
    return $catData;
    endif;
}

?>