<?php

/*****************************************************************
*
* 
* a hierarchical list of all posts by nested categories, post title and authors
* © Fabio Marzocca - 2015
******************************************************************/



function ACT_hierarchy_indexes($atts){

	if (!isset($_POST['order'])) {
    	$_POST['order']="category";
    }

	if ($atts['singleuser']) {
		$atts['admin'] = "1";
		}
	ob_start();
	
	echo '<div class="ACT-wrapper">';
	if (count(explode(",", $atts['show'])) > 1 ) :
?>

<form name="form1" method="post" action="<?=$PHP_SELF?>"  >
        <div align="center" class="styled-select"><?php _e("Group by:", 'list-all-posts-by-ACT') ?> 
          <select name="order"  id="order"  onChange=" ;this.form.submit();">
          <?php if (!($atts['singleuser']) and strpos($atts['show'], "Author") !== false): ?>
            <option value="author" <?php if ($_POST['order']  == "author") echo "selected"; ?>><?php _e("Author", 'list-all-posts-by-ACT'); ?> </option>
            <?php endif; ?>
            <?php if (strpos($atts['show'], "Title") !== false ): ?>
            <option value="title" <?php if ($_POST['order']  == "title") echo "selected"; ?>><?php _e("Title", 'list-all-posts-by-ACT'); ?> </option>
             <?php endif; ?>
             <?php if (strpos($atts['show'], "Category") !== false ): ?>
            <option value="category" <?php if ($_POST['order']  == "category") echo "selected"; ?>><?php _e("Category", 'list-all-posts-by-ACT'); ?> </option>
            <?php endif; ?>
          </select>
        </div>
    </form>
<?php

	endif;
	
	if (count(explode(",", $atts['show'])) == 1 ):
		$_POST['order'] = strtolower($atts['show']);
	endif;
	
	if ( count(explode(",", $atts['show'])) == 2 and strpos($atts['show'], "Category") === false):
		$_POST['order'] = "author";
	endif;

	if ($_POST['order']  == "author") {
		ACT_byauthor($atts);
	}
	
	elseif ($_POST['order']  == "title") {
		ACT_bytitle($atts);
		}
	else{
		ACT_bycategory($atts);
	}
 echo "</div> <!-- ACT-wrapper -->";
 $output_string=ob_get_contents();;
 ob_end_clean();
 return $output_string;
}
	
function ACT_bycategory($atts) {
	/* Start browsing categories*/
	foreach( get_categories('hide_empty=0') as $cat ) :
		$args = array(
    	'category__in' => array($cat->term_id)
	 	);
		$my_query = new WP_Query($args); 
		if  (strpos($atts['exclude'], $cat->slug)!== false): continue;
		endif;
	
	 	if( !$cat->parent ) {
	 		echo "<h4>".$cat->name."</h4><ul>";
 	 		ACT_traverse_cat_tree( $cat->term_id,$atts);
 	 	 }
	endforeach;
 	wp_reset_query(); //to reset all trouble done to the original query

}


function ACT_traverse_cat_tree( $cat, $atts ) {
 
 $args = array('category__in' => array( $cat ), 'numberposts' => -1);
 $cat_posts = get_posts( $args );
 
 if( $cat_posts ) :
 foreach( $cat_posts as $post ) :
 
 	/* exclude admin?  */
 	if (!$atts['admin']) {
 		if (is_super_admin($post->post_author)) : continue;
 		endif;
 	}
 	echo '<li class="subpost">';
 	echo '<a href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a>';
 	if (!($atts['singleuser'])):
 		echo "<span class='righttext'>[".get_the_author_meta( 'first_name', $post->post_author )." ".get_the_author_meta( 'last_name', $post->post_author )."]</span>";
 	endif; 
 	echo '</li>';
 	endforeach;
 endif;
 $next = get_categories('hide_empty=0&parent=' . $cat);
 
 if( $next ) :
 foreach( $next as $cat ) :
 	if  (strpos($atts['exclude'], $cat->slug)!== false): continue;
		endif;
 	echo '<ul><li class="subcat">'.$cat->name.'</li>';
 	ACT_traverse_cat_tree( $cat->term_id, $atts);
 	endforeach;
 	endif;
 echo '</ul>';
}


function ACT_bytitle($atts) {
	$args = array(  'posts_per_page' => -1, 
				'orderby' => 'title' , 
				'order' => 'ASC'); 
    $articoli = get_posts($args);
    if ($articoli):
	echo "<ul>";
    	foreach ($articoli as $articolo ):
    	
    	/* excluded categories  */ 
	    	if (has_category(explode(',',$atts['exclude']),$articolo->ID)):
	    		continue;
	    	endif;
	    	
    	/* include admin? */
    		if (!$atts['admin']) {	
    			if (is_super_admin($articolo->post_author)) : continue;
 				endif;
 			}
    		echo '<li>';
 			echo '<a href="' . get_permalink( $articolo->ID ) . '">' . $articolo->post_title . '</a>';
 			if (!($atts['singleuser'])):
 				echo "<span class='righttext'>[".get_the_author_meta( 'first_name', $articolo->post_author )." ".get_the_author_meta( 'last_name', $articolo->post_author )."]</span>";
 			else :
				$categories = get_the_category( $articolo->ID );
 				$list_cats =null;
 				foreach ($categories as  $cat):
 					$list_cats .= $cat->name.", ";
 				endforeach;
 				$list_cats = substr($list_cats, 0, -2);
 				echo "<span class='righttext'>[".$list_cats."]</span>"; 			
 			endif;
 			echo '</li>';
    	endforeach;
	echo "</ul>";
    endif;
}

function ACT_byauthor($atts) {
 if (!$atts['admin']) {	
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
	echo '<h4>'.$user->display_name.'</h4>';
	
	if($author_posts){
		echo '<ul>';
	    foreach ($author_posts as $author_post)  {
	    
	    	/* excluded categories   */
	    	if (has_category(explode(',',$atts['exclude']),$author_post->ID)):
	    		continue;
	    	endif;
	    	    		
 			echo '<li><a href="' . get_permalink( $author_post->ID ) . '">'.$author_post->post_title.'</a>';
 			$categories = get_the_category( $author_post->ID );
 			$list_cats =null;
 			foreach ($categories as  $cat):
 				$list_cats .= $cat->name.", ";
 			endforeach;
 			$list_cats = substr($list_cats, 0, -2);
 			echo "<span class='righttext'>[".$list_cats."]</span>";
 			echo '</li>';
		}
	}
	echo '</ul>';
	endforeach;
	}


?>