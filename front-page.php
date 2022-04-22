<?php

/**
 * The template for displaying front page
 
 */

 get_header ();
 ?>

 <section id="primary" class="content-area">
     <main id="main" class="site-main">

        <?php

        /* Start the loop */
        while ( have_posts() ) :
            the_posts();

            get_template_part( 'template-parts/content/content', 'front' );

            // if comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
    </section><!-- #primary -->

    <?php
    get_footer();