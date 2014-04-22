<?php 

	$enquete = $this->enquete; 

?>

  <div class="row">

    <div class="col-md-4">

      <h1>Questionmark?</h1>

    </div>

    <div class="col-md-8">
    	
			<input class="enquete-title" type="text" value="<?= $enquete->name; ?>">

    </div>

  </div>

  <div class="row content">

    <div class="col-md-4">

    	<div class="well enquete-elements-container">
    		
				<h3 class="page-header">Formulierelementen</h3>

				<div class="enquete-elements">

					<div class="enquete-element">
						<label for="">Tekst</label>
					</div>

					<div class="enquete-element">
						<label for="">Open vraag</label>
						<input class="form-control" type="text">
					</div>

					<div class="enquete-element">
						<label for="">Open vraag (lang)</label>
						<textarea class="form-control" rows="5"></textarea>
					</div>

					<div class="enquete-element">
						<label for="">Checkbox</label>
						<input type="checkbox"> 
					</div>

				</div>

    	</div>

    </div>
    
    <div class="col-md-8">

    	<div class="enquete-container" style="min-height:400px;">



	  	</div>

	  	<a href="enquete/save/" class="btn btn-primary pull-right">Opslaan</a>

    </div>

  </div>