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

        <form class="enquete-form" action="<?= URL; ?>enquete/run" method="post">
          <input type="hidden" name="type" value="normal">
          <input type="hidden" name="enquete_name" value="<?= $enquete->name; ?>">
          <input type="hidden" name="enquete_id" value="<?= $enquete->id; ?>">
            <? $counter = 0; ?>
            <? if(!empty($enquete->questions)): ?>
  	  		  <? foreach ($enquete->questions as $question) : ?> 
            
          <div class="question">

    	  		<?php

              switch($question->type) {

                case "textfield": ?>
                  <div class="enquete-element"
                      data-required="<?= $question->required; ?>"
                      data-type="<?= $question->type; ?>">
                    <label><?= $question->question ?></label>
                  <input type="hidden" name="questions[<?= $counter ?>][question]" value="<?= $question->question ?>">
                  <input type="hidden" name="questions[<?= $counter ?>][id]" value="<?= $question->id ?>">
                    <input 
                      class="form-control" 
                      type="text" 
                      name="questions[<?= $counter ?>][answer] ?>]"
                      data-type="<?= $question->type; ?>"
                      <?php
                        foreach($question->attributes as $attribute) {
                          echo "placeholder=\"".$attribute['attribute']."\"";
                        }
                      ?>
                    >
                  </div>
                <? break;

                case "textarea": ?>
                  <div class="enquete-element"
                      data-required="<?= $question->required; ?>">
                    <label><?= $question->question ?></label>
                  <input type="hidden" name="questions[<?= $counter ?>][question]" value="<?= $question->question ?>">
                  <input type="hidden" name="questions[<?= $counter ?>][id]" value="<?= $question->id ?>">
                    <textarea 
                      class="form-control" 
                      name="questions[<?= $counter ?>][answer]" 
                      resizable="false" 
                      data-type="<?= $question->type; ?>"
                      <?php
                        foreach($question->attributes as $attribute) {
                          echo "placeholder=\"".$attribute['attribute']."\"";
                        }
                      ?>></textarea>
                  </div>
                <? break;

                case "checkbox": ?>
                  <input type="hidden" name="questions[<?= $counter ?>][question]" value="<?= $question->question ?>">
                  <input type="hidden" name="questions[<?= $counter ?>][id]" value="<?= $question->id ?>">
                  <div class="enquete-element"
                      data-required="<?= $question->required; ?>">
                    <label><?= $question->question ?></label>
                    <? foreach ($question->attributes as $attribute) : ?>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="questions[<?= $counter ?>][answer][]" value="<?= $attribute['attribute']; ?>">
                            <?= $attribute['attribute']; ?>
                          </label>
                        </div>
                    <? endforeach ?>
                  </div>
                <? break;

                case "radio": ?>
                  <input type="hidden" name="questions[<?= $counter ?>][question]" value="<?= $question->question ?>">
                  <input type="hidden" name="questions[<?= $counter ?>][id]" value="<?= $question->id ?>">
                  <div class="enquete-element"
                      data-required="<?= $question->required; ?>">
                    <label><?= $question->question ?></label>
                    <? foreach ($question->attributes as $attribute) : ?>
                        <div class="radio">
                          <label>
                            <input type="radio" name="questions[<?= $counter ?>][answer]" value="<?= $attribute['attribute']; ?>">
                            <?= $attribute['attribute']; ?>
                          </label>
                        </div>
                    <? endforeach ?>
                  </div>
                <? break;

                case "select": ?>
                  <input type="hidden" name="questions[<?= $counter ?>][question]" value="<?= $question->question ?>">
                  <input type="hidden" name="questions[<?= $counter ?>][id]" value="<?= $question->id ?>">
                  <div class="enquete-element"
                      data-required="<?= $question->required; ?>">
                    <label><?= $question->question ?></label>
                    <select class="form-control" name="questions[<?= $counter ?>][answer]">
                      <? foreach ($question->attributes as $attribute) : ?>
                        <option value="<?= $attribute['attribute']; ?>"><?= $attribute['attribute']; ?></option>
                      <? endforeach ?>
                    </select>
                  </div>
                <? break;

              }

            ?>

          </div>
            <? $counter++; ?>
  	  		<? endforeach; ?>
          <? endif; ?>

	  	</div>

	  	<div class="col-md-8 col-md-push-2">
	  		
				<input class="btn btn-primary pull-right" type="submit" value="Verzenden">

	  	</div>

	  </form>

  </div>