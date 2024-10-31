<?php

/**
 * @param $catID int ID della categoria genitrice
 * @param $order string ASC o DESC
 * @return $output string lista di link a categorie
 */
function get_category_children_only($catID = 0, $subCat, $order = 'ASC') {
    global $wpdb;

    $output = '';

    if (strtoupper($order) != 'DESC')
        $order = 'ASC';

    $query = "select t.term_id as term_ids, t.name 
                from $wpdb->terms t, $wpdb->term_taxonomy tx 
                where t.term_id = tx.term_id 
                and tx.taxonomy = 'category' 
                and tx.parent = '" . intval($catID) . "'  
                group by  t.term_id 
                order by t.term_id $order";

    $results = $wpdb->get_results($query);
    if($results):
        foreach ($results as $result) {
            $selected = ($subCat == $result->term_ids) ? ' selected="selected"' : '';
            $output .= '<option value="' . $result->term_ids . '" ' . $selected . '>' . $result->name . '</option>';
        }
    else:
        $output = null;
    endif;

    return $output;
}

?>