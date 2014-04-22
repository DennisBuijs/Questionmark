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
  		
  		<p><?= $enquete->introduction; ?></p>

  	</div>

	  	<div class="col-md-8 col-md-push-2">

        <form class="enquete-form" action="<?= URL; ?>enquete/<?= $enquete->id; ?>" method="post">
  	  		
  	  		<? foreach ($enquete->questions as $question) : ?> 

          <div class="question">

    	  		<?php

              switch($question->type) {

                case "textfield": ?>
                  <label><?= $question->question ?></label>
                  <input class="form-control" type="text" name="question_<?= $question->order; ?>">
                <? break;

                case "textarea": ?>
                  <label><?= $question->question ?></label>
                  <textarea class="form-control" name="question_<?= $question->order; ?>" resizable="false"></textarea>
                <? break;

                case "checkbox": ?>
                  <label><?= $question->question ?></label>
                  <? foreach ($question->attributes as $attribute) : ?>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="question_<?= $question->order; ?>">
                          <?= $attribute['attribute'] ?>
                        </label>
                      </div>
                  <? endforeach ?>
                <? break;

                case "radio": ?>
                  <label><?= $question->question ?></label>
                  <? foreach ($question->attributes as $attribute) : ?>
                      <div class="radio">
                        <label>
                          <input type="radio" name="question_<?= $question->order; ?>">
                          <?= $attribute['attribute'] ?>
                        </label>
                      </div>
                  <? endforeach ?>
                <? break;

                case "select": ?>
                  <label><?= $question->question ?></label>
                  <select class="form-control" name="question_<?= $question->order; ?>">
                    <? foreach ($question->attributes as $attribute) : ?>
                      <option><?= $attribute['attribute'] ?></option>
                    <? endforeach ?>
                  </select>
                <? break;

              }

            ?>

          </div>

  	  		<? endforeach ?>

	  	</div>

	  	<div class="col-md-8 col-md-push-2">
	  		
				<input class="btn btn-primary pull-right" type="submit" value="Verzenden">

	  	</div>

	  </form>

  </div>

