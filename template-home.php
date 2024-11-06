<?php
/* Template Name: Accueil */

get_header(); ?>

<div class="home-container">
    <!-- Section Hero -->
    <section class="hero-section" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
        
    </section>
    <div class="hero-content">
            <h1><?php the_field('slogan'); ?></h1>
            <a href="<?php echo esc_url(home_url('/inscription')); ?>" class="btn">Inscrivez-vous maintenant !</a>
        </div>
    <!-- Section de Bienvenue -->
    <section class="welcome-section">
        <h2><?php the_field('titre_dintroduction'); ?></h2>
        <p><?php the_field('texte_dintroduction'); ?></p>
        <p><strong>Date de début :</strong> <?php the_field('date_de_debut'); ?></p>
        <p><strong>Date de fin :</strong> <?php the_field('date_de_fin'); ?></p>
    </section>

    <!-- Section À Propos -->
    <section class="about-section">
        <h2><?php the_field('titre_a_propos'); ?></h2>
        <p><?php the_field('texte_a_propos'); ?></p>
    </section>

    <!-- Section Dernières Nouvelles -->
    <section class="news-section">
        <h2>Dernières nouvelles</h2>
        <div class="news-items">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 2,
            );

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();
                    ?>
                    <div class="news-item">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('medium');
                            } ?>
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_excerpt(); ?></p>
                        </a>
                    </div>
                    <?php
                endwhile;
            else :
                echo '<p>Aucune nouvelle à afficher.</p>';
            endif;

            wp_reset_postdata();
            ?>
        </div>
        <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn">En voir plus</a>
    </section>
</div>

<?php get_footer(); ?>
