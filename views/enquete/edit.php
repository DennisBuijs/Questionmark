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
						<label for="">Open vraag</label>
						<input class="form-control" type="text">
					</div>

					<div class="enquete-element">
						<label for="">Open vraag (lang)</label>
						<textarea class="form-control" rows="5"></textarea>
					</div>

					<div class="enquete-element">
            <label for="">Checkbox</label>
          </div>

          <div class="enquete-element">
            <label for="">Radio</label>
          </div>

          <div class="enquete-element">
						<label for="">Select</label>
					</div>

				</div>

    	</div>

    </div>
    
    <div class="col-md-8">

    	<div class="enquete-container">

        <div class="form-group">
          <label for="">Introductietekst</label>
          <textarea class="form-control enquete-introduction"><?= $enquete->introduction; ?></textarea>
        </div>

				<? foreach ($enquete->questions as $question) : ?>

            <?php

              switch($question->type) {

                case "textfield":

                  ?>

                  <div 
                    class="panel panel-default enquete-element"
                    data-type="<?= $question->type ?>"
                    data-required="<?= $question->required ?>"
                    data-question="<?= $question->question ?>"
                    data-id="<?= $question->id ?>"
                    <?php
                      foreach($question->attributes as $attribute) {
                        if($attribute['attribute_type'] == "placeholder") {
                          echo "data-placeholder=\"".$attribute['attribute']."\"";
                          echo "data-placeholder-id=\"".$attribute['id']."\"";
                        } elseif($attribute['attribute_type'] == "input_type") {
                          echo "data-input-type=\"".$attribute['attribute']."\"";
                        }
                      }
                    ?>
                    >
                    <div class="panel-heading"><input class="question-label" value="<?= $question->question ?>"></label></div>
                    <div class="panel-body">
                      <strong>Open vraag</strong><br><br>

                      <div class="form-group">
                        <label for="">Plaatshouder</label>
                        <input 
                          class="form-control"
                          <?php
                            foreach($question->attributes as $attribute) {
                              if($attribute['attribute_type'] == "placeholder") {
                                echo "value=\"".$attribute['attribute']."\"";
                              }
                            }
                          ?>
                        >
                      </div>
                    </div>
                  </div>
                <? break;

                case "textarea": 

                  ?>

                  <div
                    class="panel panel-default enquete-element"
                    data-type="<?= $question->type ?>"
                    data-required="<?= $question->required ?>"
                    data-question="<?= $question->question ?>"
                    data-id="<?= $question->id ?>"
                    <?php
                      foreach($question->attributes as $attribute) {
                        if($attribute['attribute_type'] == "placeholder") {
                          echo "data-placeholder=\"".$attribute['attribute']."\"";
                          echo "data-placeholder-id=\"".$attribute['id']."\"";                        }
                      }
                    ?>>
                    <div class="panel-heading"><input class="question-label" value="<?= $question->question ?>"></div>
                    <div class="panel-body">
                      <strong>Open vraag (lang)</strong><br><br>

                      <div class="form-group">
                        <label for="">Plaatshouder</label>
                        <input 
                          class="form-control"
                          <?php
                            foreach($question->attributes as $attribute) {
                              if($attribute['attribute_type'] == "placeholder") {
                                echo "value=\"".$attribute['attribute']."\"";
                              }
                            }
                          ?>
                        >
                      </div>
                    </div>
                  </div>
                <? break;

                
                case "checkbox":
                case "radio":
                case "select": ?>
                  <div 
                    class="panel panel-default enquete-element"
                    data-type="<?= $question->type ?>"
                    data-required="<?= $question->required ?>"
                    data-id="<?= $question->id ?>">
                    <div class="panel-heading">
                      <input class="question-label" value="<?= $question->question ?>">
                    </div>
                    <div class="panel-body">
                      <div class="option-group">
                        <? foreach ($question->attributes as $attribute) : ?>
                          <div class="input-group" data-attribute-id="<?= $attribute['id']; ?>">
                            <input class="form-control" value="<?= $attribute['attribute']; ?>" data-option-id="<?= $attribute['id']; ?>">
                            <span class="input-group-btn">
                              <button class="btn btn-default delete-option" type="button">&times;</button>
                            </span>
                          </div>
                        <? endforeach ?>
                      </div>
                      <button class="btn btn-default add-option">Optie toevoegen</button>

                      <hr>

                      <div class="question-meta">

                        <div class="form-group col-md-6">
                          <label for="">Type veld</label><br>
                          <select class="form-control" name="" id="">
                            <option value="">Checkbox</option>
                            <option value="">Keuzerondje</option>
                            <option value="">Select</option>
                          </select>
                        </div>

                        <div class="form-group col-md-6">
                          <label for="">Verplicht</label><br>
                          <input type="checkbox"> Verplicht
                        </div>

                      </div>
                    
                    </div>

                  </div>
                <? break;

              }

            ?>

          <? endforeach ?>

	  	</div>

	  	<button class="btn btn-primary enquete-save">Opslaan</button>

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