<?php

/**
 * Adds numbered pagination to make navigating through older posts way easier.
 * I didn't write this awesome code, I just tweaked it a bit. Be sure to
 * thank Christian Kriesi Budschedl for the great pagination function:
 * http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin 
 */


function md_blog_pagination_build($pages = '', $range = 10)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<p class='pagination'>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a href=".get_pagenum_link($paged)." class=\"current\">".$i."</a></li>":"<a href='".get_pagenum_link($i)."'>".$i."</a>";
             }
         }
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>First</a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last</a>";
		 if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class=\"arrow\">&larr;</a>";
		 if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."' class=\"arrow\">&rarr;</a>";
         echo "</p>\n";
     }
}