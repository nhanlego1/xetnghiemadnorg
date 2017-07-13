<?php
/* By taking advantage of hooks, filters, and the Custom Loop API, you can make Thesis
 * do ANYTHING you want. For more information, please see the following articles from
 * the Thesis User�s Guide or visit the members-only Thesis Support Forums:
 * 
 * Hooks: http://diythemes.com/thesis/rtfm/customizing-with-hooks/
 * Filters: http://diythemes.com/thesis/rtfm/customizing-with-filters/
 * Custom Loop API: http://diythemes.com/thesis/rtfm/custom-loop-api/
*/

include(THESIS_CUSTOM . '/md/md_functions.php'); #md

/*---:[ place your custom code below this line ]:---*/


function thesis_breadcrumbs() {
    echo '<a href="';    echo get_option('home');    echo '">';
    bloginfo('name');
    echo "</a>";
        if (is_category() || is_single()) {
            echo "  »  ";
            the_category(' • ');
                if (is_single()) {
                    echo "   »   ";
                    the_title();
                }
        } elseif (is_page()) {
            echo "  »  ";
            echo the_title();
        } elseif (is_search()) {
            echo "  »  Search Results for... ";
            echo '"<em>';
            echo the_search_query();
            echo '</em>"';
        }
    }
function display_breadcrumbs() {
?><br />
<div class="breadcrumbs"><?php thesis_breadcrumbs(); ?></div>
<p><?php
    }
 
add_action('thesis_hook_before_content','display_breadcrumbs');