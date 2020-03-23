<?php $title = 'GBAF | Contact'; ?>

<?php ob_start(); ?>
	<?php require('model/include/flash.php'); ?>
	<?php require('model/include/errorsMessage.php'); ?>

    <section class="container">
        <!-- head -->
        <div>
        <h1 class="primary_h1">Nous contacter</h1>
        <h3 class="primary_h3">Pour toute demande vous trouverez ci-dessous, un formulaire de contact et notre numéro de l'assistance téléphonique.</h3>
        </div>
        
        <!-- Contact méthod -->
        <div class="row justify-content-between">
        	<div id="block_contact_phone" class="div_contact col-md-5">
	            <h2>Assistance téléphonique</h2>

	            <p>Vous serez mis en relation avec un de nos conseillers qui vous répondra dans les meilleurs délais. <br>Une réponse vous seras transmise sur votre boite mail, de l'adresse indiqué.</p>

	            <?php if (isset($_GET['through']) && $_GET['through'] == 'phone') :?>
	            <p id='contact_phone'>03 29 12 12 12</p>
	            <?php else :?>
	                <a href="index.php?page=contact&amp;through=phone&amp;#block_contact_phone">Voir le numéro</a>
	            <?php endif;?>
            </div>

        	<div class="div_contact col-md-5">
	            <h2>Nous envoyer un mail</h2>

	            <p>Vous avez consulté notre Centre d’aide et souhaitez néanmoins échanger avec l’un de nos conseillers ? <br> Vous pouvez contacter notre équipe support ou notre équipe commerciale.</p>

	            <a href="index.php?page=contact&amp;through=mail&amp;#div_contact_form">Envoyer un email</a>
            </div>
        </div>

        <!-- contact form -->
        <?php if (isset($_GET['through']) && $_GET['through'] == 'mail') :?>
        <?php $footer = 'static-bottom';?>
        <div id="div_contact_form">
			<h2>Contacter directement un conseiller</h2>
			
        	<form method="post" action="index.php?page=sendmail" class="was-validated">
				
        		<div class="row">
					<div class="col-md-5">
						<label for="name">Nom</label>
                        <input class="form-control is-invalid" id="name" name="name" <?= (isset($_SESSION['input']['name'])) ? "value=\"" . $_SESSION['input']['name'] . "\"" : "placeholder=\"Nom\"";?> required>
                        <div class="invalid-feedback">Veuillez saisir votre nom.</div> 
					</div>

					<div class="col-md-7">
						<label for="mail">Adresse email :</label>
                        <div class="input-group">
                    		<input type="email" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="mail" id="mail" <?= (isset($_SESSION['input']['mail'])) ? "value=\"" . $_SESSION['input']['mail'] . "\"" : "placeholder=\"Adresse email\"";?> required>
	                    	<div class="invalid-feedback">
	                        	Veuillez saisir votre adresse mail.
	                    	</div>
                		</div>
            		</div>
				</div>
        		<div class="row">

        			<div class="col-md-12">
						<label for="subject">Objet :</label>
                        <div class="input-group">
                    		<input type="text" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="subject" id="subject"  <?= (isset($_SESSION['input']['subject'])) ? "value=\"" . $_SESSION['input']['subject'] . "\"" : "placeholder=\"Objet\"";?> required>
	                    	<div class="invalid-feedback">
	                        	Veuillez saisir l'objet de votre objet.
	                    	</div>
                		</div>
					</div>
				</div>

				<div class="row">
					<div class="primary_input col-md-12">
						<label for="message">Votre message :</label>
                        <div class="input-group">
                    		<textarea rows="15" class="form-control form-control-md" aria-describedby="inputGroupPrepend" name="message" id="message"  <?= (isset($_SESSION['input']['message'])) ? "value=\"" . $_SESSION['input']['message'] . "\"" : "placeholder=\"Votre message\"";?> minlength="5" required></textarea>
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
        endif;?>
	</section>
<?php $footer = 'static';  ?>

<?php unset($_SESSION['input']); ?>	

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>