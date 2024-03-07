<?php
/*****************************************************************
*
* 
* a hierarchical list of all posts by nested categories, post title and authors
* © Fabio Marzocca - 2015-2024
*
* Backend funtions
******************************************************************/


function ACT_shortcode_helper()
{
?>
<div class="wrap">
    <div id="ACT_main_body" >
    
    
    <div id="form_container">
    
                <div id="ACT_topbar">&nbsp;</div>

        <form id="ACT_form" class="appnitro"  method="post" action="">
                    <div class="form_description">
            <div class="ACT_h2">List All Posts by Author, nested Categories and Titles</div>
            <p><?php esc_html_e('Automatic shortcode generator', 'list-all-posts-by-authors-nested-categories-and-titles');?></p>
        </div>  
        <div id="first_col" style="width: 59%; float:left; display:inline;">
                            
            <ul >
            
            <li id="li_2" >
        <label class="description" ><?php esc_html_e('Select what list(s) to show:', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>
        <span>
            <input id="show_cat" name="show_cat" class="element checkbox" type="checkbox" value="1" checked/>
<label class="choice" for="show_cat"><?php esc_html_e('Categories', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>
<input id="show_aut" name="show_aut" class="element checkbox" type="checkbox" value="1" />
<label class="choice" id="aut_label" for="show_aut"><?php esc_html_e('Authors', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>
<input id="show_tit" name="show_tit" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="show_tit"><?php esc_html_e('Titles', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>

        </span><p class="guidelines" id="guide_2"><small><?php esc_html_e('Selecting more than one choice will include a selector dropdown box in your page.', 'list-all-posts-by-authors-nested-categories-and-titles');?></small></p> 
        </li>       <li id="li_4" >
        <label class="description"><?php esc_html_e('Is this a single user site?', 'list-all-posts-by-authors-nested-categories-and-titles');?> </label>
        <span>
            <input id="single" name="single" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="single"><?php esc_html_e('Yes', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>

        </span><p class="guidelines" id="guide_4"><small><?php esc_html_e('This option is for websites with a single author. It removes grouping by Authors and any author name in the list.', 'list-all-posts-by-authors-nested-categories-and-titles');?> </small></p> 
        </li>       <li id="li_5" >
        <label class="description" ><?php esc_html_e('Include admin\'s posts?', 'list-all-posts-by-authors-nested-categories-and-titles');?> </label>
        <span>
            <input id="include_admin" name="include_admin" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="include_admin"><?php esc_html_e('Yes', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>

        </span> 
        </li>       <li class="section_break">

            <label class="description"><?php esc_html_e('Limit number of posts to max:', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>
            <p><?php esc_html_e('Limit the number of posts in the lists, including only<br /> a certain number of the most recent posts.<br />This is achieved separately for the 3 lists.', 'list-all-posts-by-authors-nested-categories-and-titles');?></p>
        </li>       <li id="li_3" >
        <label class="description" ><?php esc_html_e('Categories (0 means no limit)', 'list-all-posts-by-authors-nested-categories-and-titles');?> </label>
        <div>
            <input id="limit_cat" name="limit_cat" class="element text small" type="number" maxlength="4" value="0"/> 
        </div><p class="guidelines" id="guide_3"><small><?php esc_html_e('Limit the Categories list to only the "x" most recent for every category.', 'list-all-posts-by-authors-nested-categories-and-titles');?></small></p> 
        </li>       <li id="li_7" >
        <label class="description" ><?php esc_html_e('Authors (0 means no limit)', 'list-all-posts-by-authors-nested-categories-and-titles');?> </label>
        <div>
            <input id="limit_aut" name="limit_aut" class="element text small" type="number" maxlength="4" value="0"/> 
        </div><p class="guidelines" id="guide_7"><small><?php esc_html_e('Limit the Authors list to only the "x" most recent for every author.', 'list-all-posts-by-authors-nested-categories-and-titles');?></small></p> 
        </li>       <li id="li_8" >
        <label class="description" ><?php esc_html_e('Titles (0 means no limit)', 'list-all-posts-by-authors-nested-categories-and-titles');?> </label>
        <div>
            <input id="limit_tit" name="limit_tit" class="element text small" type="number" maxlength="4" value="0"/> 
        </div><p class="guidelines" id="guide_8"><small><?php esc_html_e('Limit the Titles list to only the "x" most recent ones.', 'list-all-posts-by-authors-nested-categories-and-titles');?></small></p> 
                </li><br />     
        <li id="li_9" >
            <label class="description" ><?php esc_html_e('Show posts in reverse date order (not applicable to List by Title)', 'list-all-posts-by-authors-nested-categories-and-titles');?> </label>  
            <span>
            <input id="reverse_date" name="reverse_date" class="element checkbox" type="checkbox" value="1" /> 
        <label class="choice" for="reverse_date"><?php esc_html_e('Yes', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>
            </span><p class="guidelines" id="guide_9"><small><?php esc_html_e('Default is from newest to oldest post', 'list-all-posts-by-authors-nested-categories-and-titles');?> </small></p> 
            </li>        
				
        <li id="li_9b" >
            <label class="description" ><?php esc_html_e('Show posts date', 'list-all-posts-by-authors-nested-categories-and-titles');?> </label>  
            <span>
            <input id="postdate" name="postdate" class="element checkbox" type="checkbox" value="1" /> 
        <label class="choice" for="postdate"><?php esc_html_e('Yes', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>
            </span><p class="guidelines" id="guide_9b"><small><?php esc_html_e('Default is NO', 'list-all-posts-by-authors-nested-categories-and-titles');?> </small></p> 
            </li>   				
				
        </div>
        
        <div id="second_col" style="float:left; width:40%; display:inline">
        <li id="li_10" style="width:99%" >
        <label class="description" ><?php esc_html_e('Categories to be EXCLUDED (posts in selected Categories won\'t be listed)', 'list-all-posts-by-authors-nested-categories-and-titles');?></label>
        <span>
        <br />
            <?php ACT_list_categories(); ?>

            </span><p class="guidelines" id="guide_10"><small><?php esc_html_e('Exclude posts from selected Categories', 'list-all-posts-by-authors-nested-categories-and-titles');?> </small></p> 
        </li>
        </div>
            
                    <li class="buttons" style="clear:both">
                <input type="hidden" name="action" value="ACT_processform" />
                
                <input id="saveForm" class="button_text" type="submit" name="submit" value="<?php esc_html_e('Generate Shortcode', 'list-all-posts-by-authors-nested-categories-and-titles');?>" />
        </li>
            </ul>
        </form> 
        <div id="ACT_feedback"></div>
    </div>
    </div>
    <div id="ACT_wait"></div>
    </div> <!-- wrap -->
<?php
}


function ACT_list_categories()
{

    $args = array(
    'hide_empty' => '0',
    'child_of' =>  '0'
    );
    $i=0;
    $categories = get_categories($args);
    foreach ($categories as $category) {
        if (!$category->parent) {
            $i++;
            echo ('<input id=cat[] name=cat[] class="element checkbox" type = "checkbox" value="'.htmlspecialchars($category->slug).'" />');
            echo ('<label class="choice" for=cat[]>'.htmlspecialchars($category->name).'</label>');
            $i = ACT_get_child_cats( $category->term_id, $i, " ");
        }
    }
    echo ('<input type="hidden" name="total_cats" value="'.htmlspecialchars($i).'" />');
}

function ACT_get_child_cats($cat, $k, $level)
{
    $next = get_categories('hide_empty=0&parent=' . $cat);
    if ($next) :
        $level .= "&#8212;";
        foreach ($next as $category) :
            $k++;
            echo ('<input id=cat[] name=cat[] class="element checkbox" type = "checkbox" value="'.htmlspecialchars($category->slug).'" />');
            echo ('<label class="choice" for=cat[]> '.$level.' '.htmlspecialchars($category->name).'</label>');

            $k = ACT_get_child_cats( $category->term_id, $k, $level);
        endforeach;
    endif;
    return $k;
}

function ACT_processform()
{
    
    $sc = "[ACT-list";
    
    /* Show List */
    $showlist= array();
    if (strip_tags($_POST['show_cat'])) {
        $showlist[0] ="Category";
    }
    if(array_key_exists( 'show_aut' , $_POST)) {
        $showlist[1] ="Author";
    }
    
    if(array_key_exists( 'show_tit' , $_POST ))  {
        $showlist[2] ="Title";
    }

    $showlist_string = implode(",", $showlist);
    $sc = $sc." show='".$showlist_string."'";


    /** singleuser **/
    if(array_key_exists( 'single' , $_POST )) {
        $sc = $sc." singleuser=1";
    }
    
        /** is admin included? **/
        if(array_key_exists( 'include_admin' , $_POST ))  {
        $sc = $sc." admin=1";
    }
    
        /** Limit output **/
    if (strip_tags($_POST['limit_cat'])) {
        if (strip_tags($_POST['limit_cat'])>0) {
            $sc = $sc." postspercategory=".strip_tags($_POST['limit_cat']);
        }
    }
    
    if (strip_tags($_POST['limit_aut'])) {
        if (strip_tags($_POST['limit_aut'])>0) {
            $sc = $sc." postsperauthor=".strip_tags($_POST['limit_aut']);
        }
    }
    
    if (strip_tags($_POST['limit_tit'])) {
        if (strip_tags($_POST['limit_tit'])>0) {
            $sc = $sc." totalpoststitle=".strip_tags($_POST['limit_tit']);
        }
    }
    
    /** Post order  **/
    if(array_key_exists( 'reverse_date' , $_POST )) {
        $sc = $sc." reverse-date=1";
    }

    if(array_key_exists( 'postdate' , $_POST )) {
		$sc = $sc." postdate=1";
	}
	
    /** Excluded Categories **/
    $cat_array = array();
    if(array_key_exists( 'cat' , $_POST )) {
        $cat=$_POST['cat'];
            foreach ($cat as $key => $val) {
            array_push($cat_array,$val);
        }
        $cat_string = implode(",", $cat_array);
        $sc = $sc." exclude='".$cat_string."'";
    }
    
    $sc = $sc."]";
    esc_html_e('This is your shortcode:', 'list-all-posts-by-authors-nested-categories-and-titles');
    echo ("<br /><br />");
    echo "<code style='background-color:#eee'>".htmlspecialchars($sc)."</code><br /><br />";
    esc_html_e('Copy & Paste it into your page', 'list-all-posts-by-authors-nested-categories-and-titles');
    echo ("<br />");
    

    die();
}

?>
