<?php $title = 'GBAF | Contact'; ?>

<?php ob_start(); ?>
    <!-- <?php require('model/include/flash.php'); ?> -->

    <section class="container">
        <!-- head -->
        <div>
        <h1 class="primary_h1">Nous contacter</h1>
        <h3 class="primary_h3">Pour toute demande vous trouverez ci-dessous, un formulaire de contact et notre numéros de l'assistance téléphonique.</h3>
        </div>
        
        <!-- Contact méthod -->
        <div class="row justify-content-between">
        	<div class="div_contact col-md-5">
	            <h2>Assistance téléphonique</h2>

	            <p>Vous serez mis en relation avec un de nos conseillers qui vous répondra dans les meilleurs délais <br>.Une réponse vous seras transmise sur votre boite mail, de l'adresse indiqué.</p>

	            <?php if (isset($_GET['through']) && $_GET['through'] == 'phone') :?>
	            <p id='contact_phone'>03 29 12 12 12</p>
	            <?php else :?>
	                <a href="http://localhost/GBAF/index.php?action=contact&amp;through=phone">Voir le numéro</a>
	            <?php endif;?>
            </div>

        	<div class="div_contact col-md-5">
	            <h2>Nous envoyer un mail</h2>

	            <p>Vous avez consulté notre Centre d’aide et souhaitez néanmoins échanger avec l’un de nos conseillers ? <br> Vous pouvez contacter notre équipe support ou notre équipe commerciale.</p>

	            <a href="http://localhost/GBAF/index.php?action=contact&amp;through=mail&amp;#div_contact_form">Envoyer un email</a>
            </div>
        </div>

        <!-- contact form -->
        <?php if (isset($_GET['through']) && $_GET['through'] == 'mail') :?>
        <?php $footer = 'static-bottom';?>
        <div id="div_contact_form">
            <h2>Contacter directement un conseiller</h2>
        	<form method="post" action="" class="was-validated">
        		<div class="row">
					<div class="col-md-5">
						<label for="contact_name">Nom et Prénom</label>
                        <?php if (isset($_SESSION['auth'])) : ?> 
                                <input class="form-control is-valid" id="contact_name" name="contact_name" value="<?= $_SESSION['auth']['name'] . ' ' .$_SESSION['auth']['firstname'] ?>" disabled> 
                        <?php else :?> 
                            <input class="form-control is-invalid" id="contact_name" name="contact_name" placeholder="Nom Prénom" required>
                            <div class="invalid-feedback">Veuillez saisir votre nom et prénom.</div> 
                        <?php endif ; ?>
					</div>

					<div class="col-md-7">
						<label for="contact_email">Adresse email :</label>
                        <div class="input-group">
                    		<input type="mail" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="contact_email" id="contact_email" placeholder="Adresse email" required>
	                    	<div class="invalid-feedback">
	                        	Veuillez saisir votre adresse mail.
	                    	</div>
                		</div>
            		</div>
				</div>
        		<div class="row">

        			<div class="col-md-9">
						<label for="contact_object">Objet :</label>
                        <div class="input-group">
                    		<input type="mail" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="contact_object" id="contact_object" placeholder="Objet" required>
	                    	<div class="invalid-feedback">
	                        	Veuillez saisir l'objet de votre objet.
	                    	</div>
                		</div>
            		</div>

					<div class="form-group col-md-3">
						<label for="contact_category">categorie</label>
						<select id="contact_category" class="custom-select" required>
							<option value="">Séléctioner une catégorie</option>
							<option value="Question">Question</option>
							<option value="Avis">Avis</option>
							<option value="Assistance">Assistance</option>
							<option value="Autre">Autre</option>
						</select>
						<div class="invalid-feedback">
                        Veuillez éléctioner une catégorie
                        </div>
					</div>
				</div>

				<div class="row">
					<div class="primary_input col-md-12">
						<label for="contact_message">Votre message :</label>
                        <div class="input-group">
                    		<textarea rows="15" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="contact_message" id="contact_message" placeholder="Enter votre message" required></textarea>
	                    	<div class="invalid-feedback">
	                        	Veuillez saisir votre message.
	                    	</div>
                		</div>
            		</div>
        		</div>

                <div id="button_login">
                    <input class="btn btn-success" type="submit" value="Envoyer">
                </div> 
        	</form>
        </div>
        <?php else : 
        	$footer = 'fixed-bottom'; 
        endif;?>
    </section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>