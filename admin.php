<?php
text_ln();


function searchStormUpdateOptions(){
    ?>
    <div class="wrap">
        <div class="icon32" id=""><img src="<?php echo WP_PLUGIN_URL ?>/search-storm/img/searchstorm.png"></div>
        <h2>Search Storm <?php echo SETTINGS ?></h2>
        <p><?php echo ADMIN_MSG ?></p>
         <form action="options.php" method="post">
             <?php settings_fields('searchstorm_options_group'); ?>
            <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="category1"><?php echo CATEGORY ?> 1</label></th>
                    <td><select name="searchstorm_category1" id="searchstorm_category1" ><option></option><?php echo ws_get_category(get_option('searchstorm_category1')) ?></select></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="category2"><?php echo CATEGORY ?> 2</label></th>
                    <td><select name="searchstorm_category2" id="searchstorm_category2" ><option></option><?php echo ws_get_category(get_option('searchstorm_category2')) ?></select></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="category3"><?php echo CATEGORY ?> 3</label></th>
                    <td><select name="searchstorm_category3" id="searchstorm_category3" ><option></option><?php echo ws_get_category(get_option('searchstorm_category3')) ?></select></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="category4"><?php echo CATEGORY ?> 4</label></th>
                    <td><select name="searchstorm_category4" id="searchstorm_category4" ><option></option><?php echo ws_get_category(get_option('searchstorm_category4')) ?></select></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="category4">Custom CSS</label></th>
                    <td><textarea id="searchstorm_css" name="searchstorm_css" style="width:350px;height:200px;"><?php echo get_option('searchstorm_css') ?></textarea></td>
                </tr>                
             </tbody>
            </table>

            <p class="submit"><input type="submit" name="salva" id="salva" value="<?php echo SAVE ?>" class="button button-primary" /></p>
        </form>
        <hr style="size:1px; color:#eee;" />
        <?php   help_ln(); #include_once dirname( __FILE__ ) .   '/help/'.help_ln().'.php'; ?>
    </div>
    <?php
}
	
function ss_menu(){
    add_menu_page('Search Storm', 'Search Storm', 'administrator', 'SearchStorm', 'searchStormUpdateOptions', WP_PLUGIN_URL . '/search-storm/img/searchstorm16.png');
}
add_action('admin_menu', 'ss_menu');


function searchstormActivateSetDefaultOptions()
{
    add_option('searchstorm_category1', '1', '', 'yes');
    add_option('searchstorm_category2', '1', '', 'yes');
    add_option('searchstorm_category3', '1', '', 'yes');
    add_option('searchstorm_category4', '1', '', 'yes');
    add_option('searchstorm_css', '', '', 'yes');
}
 
register_activation_hook( __FILE__, 'searchstormActivateSetDefaultOptions');


/**
 * Registrazione opzioni plugin
 */
function searchstormRegisterOptionsGroup()
{
    register_setting('searchstorm_options_group', 'searchstorm_category1');
    register_setting('searchstorm_options_group', 'searchstorm_category2');
    register_setting('searchstorm_options_group', 'searchstorm_category3');
    register_setting('searchstorm_options_group', 'searchstorm_category4');
    register_setting('searchstorm_options_group', 'searchstorm_css');
}
 
add_action('admin_init', 'searchstormRegisterOptionsGroup');


function text_ln(){
	$bloginfo = get_bloginfo( 'language' );
        if (is_readable(dirname( __FILE__ ) . '/languages/'.$bloginfo.'.php')):
            include_once dirname( __FILE__ ) . '/languages/'.$bloginfo.'.php';
        else:
            include_once dirname( __FILE__ ) . '/languages/en-US.php';
        endif;
}

function help_ln(){
        if (is_readable(dirname( __FILE__ ) . '/help/help-'.get_locale().'.php')):
            include_once dirname( __FILE__ ) . '/help/help-'.get_locale().'.php';
        else:
            include_once dirname( __FILE__ ) . '/help/help-en-US.php';
        endif;
}

?>