<?php

/*****************************************************************
*
* 
* a hierarchical list of all posts by nested categories, post title and authors
* © Fabio Marzocca - 2015
******************************************************************/



function hierarchy_indexes($atts){

	if (!isset($_POST['order'])) {
    	$_POST['order']="category";
    }

?>
<form name="form1" method="post" action="<?=$PHP_SELF?>"  >
        <div align="center" class="styled-select"><?php _e("Group by:", 'list-all-posts-by-ACT'); ?> 
          <select name="order"  id="order"  onChange=" ;this.form.submit();">
            <option value="author" <?php if ($_POST['order']  == "author") echo "selected"; ?>><?php _e("Author", 'list-all-posts-by-ACT'); ?> </option>
            <option value="title" <?php if ($_POST['order']  == "title") echo "selected"; ?>><?php _e("Title", 'list-all-posts-by-ACT'); ?> </option>
            <option value="category" <?php if ($_POST['order']  == "category") echo "selected"; ?>><?php _e("Category", 'list-all-posts-by-ACT'); ?> </option>
          </select>
        </div>
    </form>
<?php

$exclude_list=null;
if ($atts["exclude"]) :
	$exclude_list = explode(",", preg_replace('/\s+/', '', $atts["exclude"]));
endif;

$add_admin=false;
if ($atts["admin"]) :
	$add_admin=true;
endif;

	if ($_POST['order']  == "author") {
		byauthor($exclude_list, $add_admin);
	}
	
	elseif ($_POST['order']  == "title") {
		bytitle($exclude_list, $add_admin);
		}
	else{
		bycategory($exclude_list, $add_admin);
	}
}
	
function bycategory($exclude_list, $add_admin) {
	/* Start browsing categories*/
	foreach( get_categories('hide_empty=0') as $cat ) :
		$args = array(
    	'category__in' => array($cat->term_id)
	 	);
		$my_query = new WP_Query($args); 
		if (check_excluded_cats($cat->slug, $exclude_list)): continue;
		endif;
	
	 	if( !$cat->parent ) {?>
        <h4 style="text-transform:uppercase;"><?php echo $cat->name; ?></h4>
 		<?php
 	 	traverse_cat_tree( $cat->term_id,$exclude_list, $add_admin );
 	 	 }
	endforeach;
 	wp_reset_query(); //to reset all trouble done to the original query

}




function traverse_cat_tree( $cat, $exclude_list, $add_admin ) {
 
 $args = array('category__in' => array( $cat ), 'numberposts' => -1);
 $cat_posts = get_posts( $args );
 
 if( $cat_posts ) :
 foreach( $cat_posts as $post ) :
 
 	/* exclude admin?  */
 	if (!$add_admin) {
 		if (is_super_admin($post->post_author)) : continue;
 		endif;
 	}
 	echo '<li style="margin-left:20px;">';
 	echo '<a href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a>';
 	echo "<span style='text-transform:uppercase; float:right;'>[".get_the_author_meta( 'first_name', $post->post_author )." ".get_the_author_meta( 'last_name', $post->post_author )."]</span>";
 	echo '</li>';
 	endforeach;
 endif;
 $next = get_categories('hide_empty=0&parent=' . $cat);
 
 if( $next ) :
 foreach( $next as $cat ) :
 	if (check_excluded_cats($cat->slug, $exclude_list)): continue;
		endif;
 	echo '<ul style="margin-bottom:0px; text-transform:upercase"><li><strong>'.$cat->name.'</strong></li>';
 	traverse_cat_tree( $cat->term_id, $exclude_list, $add_admin );
 	endforeach;
 	endif;
 echo '</ul>';
}


function bytitle($exclude_list, $add_admin) {
	$args = array(  'posts_per_page' => -1, 
				'orderby' => 'title' , 
				'order' => 'ASC'); 
    $articoli = get_posts($args);
    if ($articoli):
    	foreach ($articoli as $articolo ):
    	
    	/* excluded categories  */
	    	if (check_post_cat($exclude_list, $articolo->ID)): 
	    		continue;
	    	endif;
	    	
    	/* include admin? */
    		if (!$add_admin) {	
    			if (is_super_admin($articolo->post_author)) : continue;
 				endif;
 			}
    		echo '<li>';
 			echo '<a href="' . get_permalink( $articolo->ID ) . '">' . $articolo->post_title . '</a>';
 			echo "<span style='text-transform:uppercase; float:right;'>[".get_the_author_meta( 'first_name', $articolo->post_author )." ".get_the_author_meta( 'last_name', $articolo->post_author )."]</span>";
 			echo '</li>';
    	endforeach;
    endif;
}

function byauthor($exclude_list, $add_admin) {
 if (!$add_admin) {	
 	$param = 'blog_id=1&orderby=nicename&role=author';
 	}
 else {
  	$param = 'blog_id=1&orderby=nicename&who=authors';
	}
 $autori= get_users( $param );
// Array of WP_User objects.
foreach ( $autori as $user ):
	$args= array(
    		'author'        =>  $user->ID, 
			'posts_per_page' =>  -1,
    		'orderby'       =>  'title',
    		'order'         =>  'ASC' 
   		 );
	
	$author_posts=  get_posts( $args ); 
	if (!$author_posts): continue; endif;
	echo '<h4 style="text-transform:uppercase;">'.$user->display_name. '</h4>';
	
	if($author_posts){
		echo '<ul>';
	    foreach ($author_posts as $author_post)  {
	    
	    	/* excluded categories   */
	    	if (check_post_cat($exclude_list, $author_post->ID)): 
	    		continue;
	    	endif;
	    	    		
 			echo '<li><a href="' . get_permalink( $author_post->ID ) . '">'.$author_post->post_title.'</a>';
 			$categories = get_the_category( $author_post->ID );
 			$list_cats =null;
 			foreach ($categories as  $cat):
 				$list_cats .= $cat->name.", ";
 			endforeach;
 			$list_cats = substr($list_cats, 0, -2);
 			echo "<span style='text-transform:uppercase; float:right;'>[".$list_cats."]</span>";
 			echo '</li>';
		}
	}
	echo '</ul>';
	endforeach;
	}
	
function check_excluded_cats($catname, $exclude_list) { 
 		/* exclude category */
		if ($exclude_list) :
			if ( in_array($catname, $exclude_list, true)) {
					return true;
				}	
		endif;
		return false;
}

function check_post_cat($exclude_list, $postID) {
			if ($exclude_list) : 
    			if (has_category($exclude_list,$postID)): return true;
    			endif;
			endif;
			return false;
}
?>