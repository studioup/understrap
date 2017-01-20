<?php
//Creating Option page for WPML

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

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
