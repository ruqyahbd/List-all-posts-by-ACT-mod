<?php

/*****************************************************************
*
* A hierarchical table of all posts by nested categories, post title, and authors
* © Fabio Marzocca - 2015-2024
*
* Frontend
******************************************************************/

$firtsrun = 0;

function ACT_hierarchy_indexes($atts)
{
    global $firstrun;

    if (!isset($_POST['order'])) {
        $firstrun = 1;
        $_POST['order'] = "category";
    }

    if ($atts['singleuser']) {
        $atts['admin'] = "1";
    }
    ob_start();
    
    $categories = get_categories(['hide_empty' => 0]);
    $writers = get_terms(['taxonomy' => 'writer', 'hide_empty' => 0]);
    
    echo '<div class="ACT-wrapper">';
    
    // Adding a wrapper div for search and filter boxes
    echo '<div class="search-filter-wrapper">';
    echo '<input type="text" id="tableSearch" placeholder="Search posts...">';
    echo '<select id="categoryFilter"><option value="">All Categories</option>';
    foreach ($categories as $category) {
        echo '<option value="' . esc_attr($category->name) . '">' . esc_html($category->name) . '</option>';
    }
    echo '</select>';
    
    echo '<select id="writerFilter"><option value="">All Writers</option>';
    foreach ($writers as $writer) {
        echo '<option value="' . esc_attr($writer->name) . '">' . esc_html($writer->name) . '</option>';
    }
    echo '</select>';
    echo '</div>'; // End of search-filter-wrapper
    
    echo '<table id="postsTable" class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>Post Title</th><th class="category-column">Category</th><th class="writer-column">Writer</th></tr></thead>';
    echo '<tbody>';

    if ($_POST['order'] == "author") {
        ACT_byauthor($atts);
    } elseif ($_POST['order'] == "title") {
        ACT_bytitle($atts);
    } else {
        ACT_bycategory($atts);
    }

    echo '</tbody>';
    echo '</table>';
    echo "</div> <!-- ACT-wrapper -->";

    echo '<script>
        document.getElementById("tableSearch").addEventListener("keyup", function() {
            let filter = this.value.toUpperCase();
            let rows = document.querySelectorAll("#postsTable tbody tr");
            rows.forEach(row => {
                let text = row.innerText.toUpperCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });
        
        document.getElementById("categoryFilter").addEventListener("change", function() {
            let filter = this.value;
            let rows = document.querySelectorAll("#postsTable tbody tr");
            rows.forEach(row => {
                let category = row.dataset.category;
                row.style.display = (filter === "" || category === filter) ? "" : "none";
            });
        });
        
        document.getElementById("writerFilter").addEventListener("change", function() {
            let filter = this.value;
            let rows = document.querySelectorAll("#postsTable tbody tr");
            rows.forEach(row => {
                let writer = row.dataset.writer;
                row.style.display = (filter === "" || writer === filter) ? "" : "none";
            });
        });
    </script>';

    $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
}

function ACT_bycategory($atts)
{
    foreach (get_categories(['hide_empty' => 0]) as $cat) {
        if (strpos($atts['exclude'], $cat->slug) !== false) {
            continue;
        }
        if (!$cat->parent) {
            echo "<tr id='{$cat->name}'><td colspan='3' style='font-weight: bold; font-size: 20px; text-align: center;'>{$cat->name}</td></tr>";
            ACT_traverse_cat_tree($cat->term_id, $atts, $cat->name);
        }
    }
}

function ACT_traverse_cat_tree($cat, $atts, $cat_name)
{
    static $post_counter = 0;
    $post_types = get_post_types(['public' => true, '_builtin' => false]);
    array_push($post_types, 'post');

    $args = [
        'category__in' => [$cat],
        'numberposts' => -1,
        'order' => $atts['reverse-date'] ? 'ASC' : 'DESC',
        'post_type' => $post_types
    ];

    $cat_posts = get_posts($args);

    if ($cat_posts) {
        foreach ($cat_posts as $post) {
            if (!$atts['admin'] && is_super_admin($post->post_author)) continue;

            $post_counter++;
            $post_title = $post_counter . '. <a href="' . esc_html(get_permalink($post->ID)) . '">' . esc_html($post->post_title) . '</a>';
            $writers = get_the_terms($post->ID, 'writer');
            $writer_name = $writers ? esc_html($writers[0]->name) : esc_html(get_the_author_meta('display_name', $post->post_author));

            echo "<tr data-category='{$cat_name}' data-writer='{$writer_name}'><td>{$post_title}</td><td class='category-column'>{$cat_name}</td><td class='writer-column'>{$writer_name}</td></tr>";
        }
    }
}

?>
