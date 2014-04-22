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
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <input class="form-control" type="text" name="question_<?= $question->order; ?>" 
                    placeholder="<?php if(!empty($question->attributes['placeholder'][0])) { 
                      echo $question->attributes['placeholder'][0]; 
                    } ?>">
                  </div>
                <? break;

                case "textarea": ?>
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <textarea class="form-control" name="question_<?= $question->order; ?>" resizable="false" placeholder="<?php if(!empty($question->attributes['placeholder'][0])) { 
                        echo $question->attributes['placeholder'][0]; 
                      } ?>"></textarea>
                  </div>
                <? break;

                case "checkbox": ?>
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <? foreach ($question->attributes['options'] as $attribute) : ?>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="question_<?= $question->order; ?>">
                            <?= $attribute; ?>
                          </label>
                        </div>
                    <? endforeach ?>
                  </div>
                <? break;

                case "radio": ?>
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <? foreach ($question->attributes['option'] as $attribute) : ?>
                        <div class="radio">
                          <label>
                            <input type="radio" name="question_<?= $question->order; ?>">
                            <?= $attribute; ?>
                          </label>
                        </div>
                    <? endforeach ?>
                  </div>
                <? break;

                case "select": ?>
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <select class="form-control" name="question_<?= $question->order; ?>">
                      <? foreach ($question->attributes['option'] as $attribute) : ?>
                        <option><?= $attribute; ?></option>
                      <? endforeach ?>
                    </select>
                  </div>
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