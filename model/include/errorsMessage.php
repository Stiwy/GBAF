<?php
    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        if (isset($errors)){
            echo '<div class="alert alert-danger"><p>Saissie inccorecte veuillez veriffier vos informations</p><ul>';
                foreach($errors as $error){
                    echo '<li>' . $error . '</li>';
                }
            echo '</ul></div>';
        }
    }
    unset($_SESSION['errors']);  
?>
