<?php get_header(); ?>
<main id="site-content" role="main">
    <main class="content">
        <?php
            $title = '';
            if ( is_search() && have_posts() ) { // ICI on vérifie si nous sommes dans une recherche.
                $title = 'Résultats de recherche :';
            } elseif ( is_search() && !have_posts() ) { // ICI on vérifie si nous sommes dans une recherche.
                $title = 'Aucun résultat de recherche';
            } elseif ( is_category() && !have_posts() ) {// ICI on vérifie si nous sommes dans une archive de catégorie spécifiquement et qu'il n'y a pas de contenu
                $title = 'Aucun résultat dans cette catégorie';
            } elseif ( is_archive() && !have_posts() ) {// ICI on vérifie si nous sommes dans une archive et qu'il n'y a pas de contenu
                $title = 'Aucun résultat sur cette page';
            } elseif ( is_category() && have_posts() ) {// ICI on vérifie si nous sommes dans une archive de catégorie spécifiquement et qu'il y a du contenu
                $title = 'la ' . get_the_archive_title();
            } elseif ( is_tax() && have_posts() ) {// ICI on vérifie si nous sommes dans une archive de taxonomie et qu'il y a du contenu
                $title = 'la taxonomie ' . get_the_archive_title();
            } elseif ( is_archive() && have_posts() ) {// ICI on vérifie si nous sommes dans une archive quelconque et qu'il y a du contenu
                $title = 'l\'archive ' . get_the_archive_title();
            } elseif ( !is_home() && !is_single() && !is_page() ) { // ICI on vérifie que nous ne sommes sur la page d'accueil, dans ce cas on chargera le titre d'une page d'archive.
                $title = get_the_archive_title();
            } elseif ( is_single() || is_page() ) { // ICI on vérifie que nous ne sommes sur la page d'accueil, dans ce cas on chargera le titre d'une page d'archive.
                $title = get_the_title();
            } else { // Dans le cas des pages, articles et autres contenus du site
                $title = get_the_title();
            }

            if ( have_posts() && is_archive() && $title != '' ) { // ICI on vérifie dans le cas où nous sommes dans une page d'archives quelconque, si un titre existe pour cette page d'archives et s'il y a du contenu.
                ?>
                <h1>Publication pour <?php echo $title; ?></h1>
                <?php
            } elseif (is_home()) {// Ici nous affichons le titre de la page d'accueil
                ?>
                <h1>Bienvenue sur notre site | <?php echo get_bloginfo('name'); ?></h1>
                <h2>Lancez une recherche</h2>
                <?php
                get_search_form(
                    array(
                        'aria_label' => __( 'search again', 'twentytwenty' ),
                    )
                );
                ?>
                <h2>Ci-après la liste des dernières publications</h2>
                <hr/>
                <?php
            } else { // Dans le cas de toutes les autres pages nous affichons directement le titre de la page en question.
                ?>
                <h1><?php echo $title; ?></h1>
                <?php
            }

            if ( have_posts() && !is_search() && !is_archive() && !is_home() ) { // ICI on vérifie si l'on as une liste d'articles.
                while ( have_posts() ) {
                    the_post();
                    ?>
                    <div class="article">
                        <?php the_content(); ?>
                    </div>
                    <?php
                }
            }
            elseif ( is_search() || is_archive() || is_home() ) { // ICI on vérifie si nous sommes dans une page de liste de contenu.
                while ( have_posts() ) {
                    the_post();
                    ?>
                    <div class="article-list">
                        <h3><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php the_excerpt(); ?>
                    </div>
                    <?php
                }
            }

        ?>
    </main><!-- #content -->

</main><!-- #site-content -->
<?php get_footer();
