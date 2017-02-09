<?php
//Creating Option page for WPML

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
			//'title' => __('General options','cerulean'), // this seems to create an options page for every language
			'title' => 'Global options',
			'menu_slug' => 'global-options',
			'capability' => 'manage_options'
	));

	if ( function_exists('icl_object_id') ) {
			acf_add_options_page(array(
					//'title' => __('General options','cerulean'), // this seems to create an options page for every language
					'title' => 'Options',
					'menu_slug' => 'translated-options',
					'capability' => 'manage_options'
			));
	}

	function cl_set_global_options_pages($current_screen) {
        //var_dump($current_screen);
      // IDs of admin options pages that should be "global"
      $page_ids = array(
        "toplevel_page_global-options"
      );

      if (in_array($current_screen->id, $page_ids)) {
        add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
      }
    }
    add_action( 'current_screen', 'cl_set_global_options_pages' );



    function cl_acf_set_language() {
      return acf_get_setting('default_language');
    }

    /**
     * Wrapper around get_field() to get the "global" option values.
     * This is the function you'll want to use in your templates instead of get_field() for "global" options.
     */
    function get_global_option($name) {
        global $sitepress;

	    if(!empty($sitepress)){
		    $current_language = $sitepress->get_current_language();
			$default_language = $sitepress->get_default_language();
			$sitepress->switch_lang($default_language,true);
		}
		add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
        $option = get_field($name, 'option');
        remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
        if(!empty($sitepress)){
			$sitepress->switch_lang($current_language,true);
		}
        return $option;
    }


}

function get_excerpt_chars($count,$id = null){
  global $post;
  $original_post = $post;
  if($id != null){
      $post = get_post( $id );
  }
  setup_postdata($post);

  $permalink = get_permalink();
  if( !empty( $post->post_excerpt )) {
    $excerpt = get_the_excerpt();
  }else{
    $excerpt = apply_filters('the_content', get_post_field('post_content'));

  }
  $excerpt = strip_tags($excerpt);
  if( strlen($excerpt) > $count ){
    $excerpt = substr($excerpt, 0, $count);

    $excerpt = $excerpt.'...'; // <a href="'.$permalink.'">more</a>';
  }
  wp_reset_postdata();
  $post = $original_post;
  return $excerpt;
}

//Country name type are iso2 or full
function get_languages_dropdown($customClass = "", $countryNameType = 'iso2'){
	$languages_list = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
	$html = "";
	$curr_lang = array();
    if( !empty( $languages_list ) ) {
        foreach( $languages_list as $language ) {
            if( !empty( $language['active'] ) ) {
                $curr_lang = $language; // This will contain current language info.
                break;
            }
        }
    }

	$html .= '<div class="lang-dropdown dropdown">';
	$html .= '  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
	if ($countryNameType=='iso2'){
		$html .= $curr_lang['language_code'];
	}else{
		$html .= $curr_lang['translated_name'];
	}
	$html .= '    </button>';
	$html .= '      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
	foreach ($languages_list as &$language) {

		$html .= '<a class="dropdown-item" href="'.$language['url'].'">';
		if ($countryNameType=='iso2'){
			$html .= $language['language_code'];
		}else{
			$html .= $language['translated_name'];
		}
		$html .='</a>';
	}
	$html .= '  </div>';
	$html .= '</div>';


  echo($html);


}

?>
