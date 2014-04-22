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

    	<div class="enquete-container">

				<? foreach ($enquete->questions as $question) : ?>

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

          <? endforeach ?>

	  	</div>

	  	<a href="<?= URL; ?>enquete/save/" class="btn btn-primary enquete-save">Opslaan</a>

    </div>

  </div>