<?php

function ACT_shortcode_helper() {
?>
<div class="wrap">
	<div id="ACT_main_body" >
	
	
	<div id="form_container">
	
				<div id="ACT_topbar">&nbsp;</div>

		<form id="form_978810" class="appnitro"  method="post" action="">
					<div class="form_description">
			<div class="ACT_h2">List All Posts by Author, nested Categories and Titles</div>
			<p><?php echo __('Automatic shortcode generator','list-all-posts-by-ACT');?></p>
		</div>	
		<div id="first_col" style="width: 59%; float:left; display:inline;">
							
			<ul >
			
			<li id="li_2" >
		<label class="description" >Select what list(s) to show: </label>
		<span>
			<input id="show_cat" name="show_cat" class="element checkbox" type="checkbox" value="1" checked/>
<label class="choice" for="show_cat">Categories</label>
<input id="show_aut" name="show_aut" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="show_aut">Authors</label>
<input id="show_tit" name="show_tit" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="show_tit">Titles</label>

		</span><p class="guidelines" id="guide_2"><small>Selecting more than one choice will include a selector dropdown box in your page. </small></p> 
		</li>		<li id="li_4" >
		<label class="description">Is this a single user site? </label>
		<span>
			<input id="single" name="single" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="single">Yes</label>

		</span><p class="guidelines" id="guide_4"><small>This option is for websites with a single author (or when you don't want to show the authors). It removes grouping by Authors and any author name. </small></p> 
		</li>		<li id="li_5" >
		<label class="description" >Include admin's posts? </label>
		<span>
			<input id="include_admin" name="include_admin" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="include_admin">Yes</label>

		</span> 
		</li>		<li class="section_break">

			<label class="description">Limit number of posts to max:</label>
			<p>Limit the number of posts in the lists, including only<br /> a certain number of the most recent posts.<br />This is achieved separately for the 3 lists.</p>
		</li>		<li id="li_3" >
		<label class="description" >Categories (0 means no limit) </label>
		<div>
			<input id="limit_cat" name="limit_cat" class="element text small" type="number" maxlength="4" value="0"/> 
		</div><p class="guidelines" id="guide_3"><small>Limit the Categories list to only the "x" most recent for every category</small></p> 
		</li>		<li id="li_7" >
		<label class="description" >Authors (0 means no limit) </label>
		<div>
			<input id="limit_aut" name="limit_aut" class="element text small" type="number" maxlength="4" value="0"/> 
		</div><p class="guidelines" id="guide_7"><small>Limit the Authors list to only the "x" most recent for every author</small></p> 
		</li>		<li id="li_8" >
		<label class="description" >Titles (0 means no limit) </label>
		<div>
			<input id="limit_tit" name="limit_tit" class="element text small" type="number" maxlength="4" value="0"/> 
		</div><p class="guidelines" id="guide_8"><small>Limit the Titles list to only "x" most recent ones.</small></p> 
		</li>		
		</div>
		
		<div id="second_col" style="float:left; width:40%; display:inline"> 
		<li id="li_9" style="width:99%" >
		<label class="description" >Categories to be EXCLUDED <br />(posts in selected Categories won't be listed) </label>
		<span>
		<br />
			<?php ACT_list_categories(); ?>

		</span><p class="guidelines" id="guide_9"><small>Exclude posts from selected Categories</small></p> 
		</li>
		</div>
			
					<li class="buttons" style="clear:both">
			    <input type="hidden" name="form_id" value="978810" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Generate Shortcode" />
		</li>
			</ul>
		</form>	
		
	</div>
	</div>
	</div> <!-- wrap -->
<?php
}

/*
function ACT_list_categories() {

$args = array(
  'hide_empty' => '0',
  );
  $i=0;
  $categories = get_categories($args);
  foreach($categories as $category) { 
  
  	if (!$category->parent) {
  		$i++;
  		echo ('<input id="cat_'.$i.'" name="cat_'.$i.'" class="element checkbox" type = "checkbox" value="'.$category->slug.'" />');
  		echo ('<label class="choice" for="cat_'.$i.'">'.$category->name.'</label>');
  		$i = ACT_get_child_cats( $category->term_id,$i);
  		}
  		
  	}
  	echo ('<input type="hidden" name="total_cats" value="'.$i.'" />');
}

function ACT_get_child_cats($cat, $k) {
	$next = get_categories('hide_empty=0&parent=' . $cat);
	 if( $next ) :
 		foreach( $next as $category ) :
 			$k++;
 			echo ('<input id="cat_'.$k.'" name="cat_'.$k.'" class="element checkbox" type = "checkbox" value="'.$category->slug.'" />');
  		echo ('<label class="choice" for="cat_'.$k.'">'.$category->name.'</label>');

 			$k = ACT_get_child_cats( $category->term_id, $k);
 		endforeach;
 	endif;
	return $k;
}

*/

function ACT_list_categories() {

$args = array(
  'hide_empty' => '0',
  'child_of' =>  '0'
  );
  $i=0;
  $categories = get_categories($args);
  foreach($categories as $category) { 
  
  	if (!$category->parent) {
  		$i++;
  		echo ('<input id="cat_'.$i.'" name="cat_'.$i.'" class="element checkbox" type = "checkbox" value="'.$category->slug.'" />');
  		echo ('<label class="choice" for="cat_'.$i.'">'.$category->name.'</label>');
  		$i = ACT_get_child_cats( $category->term_id,$i," ");
  		}
  		
  	}
  	echo ('<input type="hidden" name="total_cats" value="'.$i.'" />');
}

function ACT_get_child_cats($cat, $k,$level) {
	$next = get_categories('hide_empty=0&parent=' . $cat);
	 if( $next ) :
	 	$level .= "&#8212;";
 		foreach( $next as $category ) :
 			$k++;
 			echo ('<input id="cat_'.$k.'" name="cat_'.$k.'" class="element checkbox" type = "checkbox" value="'.$category->slug.'" />');
  		echo ('<label class="choice" for="cat_'.$k.'"> '.$level.' '.$category->name.'</label>');

 			$k = ACT_get_child_cats( $category->term_id, $k, $level);
 		endforeach;
 	endif;
	return $k;
}
