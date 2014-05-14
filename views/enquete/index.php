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
  		
  		<p><? echo nl2br($enquete->introduction); ?></p>

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
                    <input 
                      class="form-control" 
                      type="text" 
                      name="question_<?= $question->order; ?>"
                      <?php
                        foreach($question->attributes as $attribute) {
                          echo "placeholder=\"".$attribute['attribute']."\"";
                        }
                      ?>
                    >
                  </div>
                <? break;

                case "textarea": ?>
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <textarea 
                      class="form-control" 
                      name="question_<?= $question->order; ?>" 
                      resizable="false" 
                      <?php
                        foreach($question->attributes as $attribute) {
                          echo "placeholder=\"".$attribute['attribute']."\"";
                        }
                      ?>></textarea>
                  </div>
                <? break;

                case "checkbox": ?>
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <? foreach ($question->attributes as $attribute) : ?>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="question_<?= $question->order; ?>">
                            <?= $attribute['attribute']; ?>
                          </label>
                        </div>
                    <? endforeach ?>
                  </div>
                <? break;

                case "radio": ?>
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <? foreach ($question->attributes as $attribute) : ?>
                        <div class="radio">
                          <label>
                            <input type="radio" name="question_<?= $question->order; ?>">
                            <?= $attribute['attribute']; ?>
                          </label>
                        </div>
                    <? endforeach ?>
                  </div>
                <? break;

                case "select": ?>
                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <select class="form-control" name="question_<?= $question->order; ?>">
                      <? foreach ($question->attributes as $attribute) : ?>
                        <option><?= $attribute['attribute']; ?></option>
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