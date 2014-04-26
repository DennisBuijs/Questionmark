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

                case "textfield":

                  ?>

                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <input 
                      class="form-control"
                      data-type="<?= $question->type ?>"
                      data-required="<?= $question->required ?>"
                      data-question="<?= $question->question ?>"
                      data-input-type="text"
                      data-temp-id=""
                      <?php
                        foreach($question->attributes as $attribute) {
                          if($attribute['attribute_type'] == "placeholder") {
                            echo "data-placeholder=\"".$attribute['attribute']."\"";
                            echo "placeholder=\"".$attribute['attribute']."\"";
                          } elseif($attribute['attribute_type'] == "input_type") {
                            echo "data-input-type=\"".$attribute['attribute']."\"";
                            echo "type=\"".$attribute['attribute']."\"";
                          }
                        }
                      ?>
                    >
                  </div>
                <? break;

                case "textarea": 

                  ?>

                  <div class="enquete-element">
                    <label><?= $question->question ?></label>
                    <textarea 
                      class="form-control" 
                      resizable="false"
                      data-type="<?= $question->type ?>"
                      data-required="<?= $question->required ?>"
                      data-question="<?= $question->question ?>"
                      data-temp-id=""
                      <?php
                        foreach($question->attributes as $attribute) {
                          if($attribute['attribute_type'] == "placeholder") {
                            echo "data-placeholder=\"".$attribute['attribute']."\"" ;
                            echo "placeholder=\"".$attribute['attribute']."\"";
                          }
                        }
                      ?>
                    ></textarea>
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
                    <select 
                      class="form-control"
                      data-type="<?= $question->type ?>"
                      data-required="<?= $question->required ?>"
                      data-question="<?= $question->question ?>"
                      data-temp-id=""
                      >
                      <? foreach ($question->attributes as $attribute) : ?>
                        <option><?= $attribute['attribute']; ?></option>
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

<div class="modal fade" id="edit-question-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Bewerk vraag</h4>
      </div>
      <div class="modal-body">



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
        <button type="button" class="btn btn-primary" id="save-question-modal" data-dismiss="modal">Opslaan</button>
      </div>
    </div>
  </div>
</div>