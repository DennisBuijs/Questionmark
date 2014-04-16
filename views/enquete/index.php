<?php 

	$enquete = $this->enquete; 

?>

  <div class="row">

    <div class="col-md-8 col-md-push-2">

      <h1 class="page-header">
      	
  			<?= $enquete->name; ?>

      </h1>

    </div>

  </div>

  <div class="row content">

  	<div class="col-md-8 col-md-push-2">
  		
  		<?= $enquete->introduction; ?>

  	</div>

  	<form action="<?= URL; ?>enquete/<?= $enquete->id; ?>">

	  	<div class="col-md-8 col-md-push-2">
	  		
	  		<? foreach ($enquete->questions as $question) : ?> 

	  			VRAAG?

	  		<? endforeach ?>

	  	</div>

	  	<div class="col-md-8 col-md-push-2">
	  		
				<input class="btn btn-primary pull-right" type="submit" value="Verzenden">

	  	</div>

	  </form>

  </div>