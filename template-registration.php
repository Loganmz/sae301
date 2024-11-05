<?php

/*
Template Name: inscription
*/
get_header(); // Inclut l'en-tête du site
// Vérifier si le formulaire d'inscription a été soumis
if (isset($_POST['submit'])) {
    // Récupérer et assainir les données du formulaire
    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];
    $email = sanitize_email($_POST['email']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);

    // Vérifier si l'utilisateur existe déjà
    if (username_exists($username) || email_exists($email)) {
        echo '<div class="error">Erreur : Le nom d’utilisateur ou l’adresse e-mail est déjà utilisé.</div>';
    } else {
        // Créer un nouvel utilisateur
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password, // Le mot de passe sera automatiquement haché
            'first_name' => $first_name,
            'last_name' => $last_name,
            'role' => 'contributor' // Définir le rôle comme contributeur
        );

        // Insérer l'utilisateur dans la base de données
        $user_id = wp_insert_user($userdata);

        // Vérifier si l'utilisateur a été créé avec succès
        if (!is_wp_error($user_id)) {
            // Enregistrement réussi
            echo '<div class="success">Enregistrement réussi. Vous pouvez vous connecter maintenant.</div>';
            // Rediriger vers la page de connexion par défaut de WordPress après l'inscription
            wp_redirect(home_url('/connexion'));
            exit; // Arrêter l'exécution du script
        } else {
            echo '<div class="error">Erreur : ' . $user_id->get_error_message() . '</div>';
        }
    }
}
?>

<!-- Formulaire d'inscription -->
<form method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" required>
    
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    
    <label for="email">Adresse e-mail :</label>
    <input type="email" name="email" required>
    
    <label for="first_name">Prénom :</label>
    <input type="text" name="first_name" required>
    
    <label for="last_name">Nom :</label>
    <input type="text" name="last_name" required>
    
    <input type="submit" name="submit" value="Inscription">
</form>

<?php get_footer(); // Inclut le pied de page du site ?>