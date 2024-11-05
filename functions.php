<?php
// vignettes
add_theme_support( 'post-thumbnails' );
the_post_thumbnail( 'thumbnail' ); 

function register_my_menu(){
    register_nav_menus( array(
        'header-menu' => __( 'Menu De Tete'),
        'footer-menu'  => __( 'Menu De Pied'),
    ) );
}
add_action( 'init', 'register_my_menu', 0 );

// Fonction pour afficher le formulaire d'inscription
function afficher_formulaire_inscription() {
    if (is_user_logged_in()) {
        return 'Vous êtes déjà connecté.';
    }

    $output = '
    <form id="formulaire-inscription" action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">
        <div>
            <label for="user_login">Identifiant</label>
            <input type="text" name="user_login" id="user_login" required>
        </div>
        <div>
            <label for="user_email">Adresse e-mail</label>
            <input type="email" name="user_email" id="user_email" required>
        </div>
        <div>
            <label for="user_firstname">Prénom</label>
            <input type="text" name="user_firstname" id="user_firstname" required>
        </div>
        <div>
            <label for="user_lastname">Nom</label>
            <input type="text" name="user_lastname" id="user_lastname" required>
        </div>
        <div>
            <label for="user_pass">Mot de passe</label>
            <input type="password" name="user_pass" id="user_pass" required>
        </div>
        <div>
            <label for="user_pass_confirm">Confirmer le mot de passe</label>
            <input type="password" name="user_pass_confirm" id="user_pass_confirm" required>
        </div>
        ' . wp_nonce_field('inscription_utilisateur_nonce', '_wpnonce', true, false) . '
        <input type="submit" value="S\'inscrire">
    </form>';

    return $output;
}



function theme_enqueue_styles() {
    wp_enqueue_style('style', get_stylesheet_uri());
  }
  add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
  

  function custom_user_login() {
    if (isset($_POST['login'])) {
        $username = sanitize_user($_POST['username']);
        $password = $_POST['password'];

        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true
        );

        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            echo 'Erreur de connexion : ' . $user->get_error_message();
        } else {
            wp_redirect(home_url()); // Redirige vers la page d'accueil après connexion réussie
            exit;
        }
    }
}
 
function custom_menu_items($items, $args) {
    // Vérifie si l'utilisateur est connecté
    if (is_user_logged_in()) {
        // Enlève le lien de connexion du menu
        $items = preg_replace('/<li><a href=".*?wp-login.php.*?">Connexion<\/a><\/li>/', '', $items);
        
        // Enlève le lien d'inscription du menu
        $items = preg_replace('/<li><a href=".*?\/inscription.*?">Inscription<\/a><\/li>/', '', $items);

        // Ajoute le lien de déconnexion avec une classe personnalisée pour le style
        $items .= '<li class="menu-item logout-menu-item"><a href="' . wp_logout_url(home_url()) . '">Déconnexion</a></li>';
    } else {
        // Ajoute le lien de connexion s'il n'est pas connecté
        $items .= '<li class="menu-item"><a href="' . site_url('/Connexion') . '">Connexion</a></li>';
        
        // Ajoute le lien d'inscription s'il n'est pas connecté
        $items .= '<li class="menu-item"><a href="' . site_url('/inscription') . '">Inscription</a></li>';
    }
    
    return $items;
}
add_filter('wp_nav_menu_items', 'custom_menu_items', 10, 2);