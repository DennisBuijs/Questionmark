<?php 

	$enquete = $this->enquete; 

?>

  <div class="row">

    <div class="col-md-4">

    <h1 class="page-title"><a href="<?= URL ?>">Questionmark?</a></h1>

    </div>

    <div class="col-md-8">
    	
			<input class="enquete-title" type="text" value="<?= $enquete->name; ?>">

    </div>

  </div>

  <div class="row content">

    <div class="col-md-4">

      <div class="panel-group sidebar" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                Opties
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">
            
              <div class="form-group">
                <label for="">Introductietekst</label>
                <textarea class="form-control enquete-introduction"><?= $enquete->introduction; ?></textarea>
              </div>

              <div class="form-group">
                <label for="">Startdatum</label>
                <input class="form-control enquete-startdate" type="text" placeholder="jjjj-mm-dd" value="<?= $enquete->start_date; ?>">
              </div>

              <div class="form-group">
                <label for="">Einddatum</label>
                <input class="form-control enquete-enddate" type="text" placeholder="jjjj-mm-dd" value="<?= $enquete->end_date; ?>">
              </div>

            </div>
          </div>
        </div>

        <div class="panel panel-default enquete-elements-container">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                Formulierelementen
              </a>
            </h4>
          </div>
          <div id="collapseTwo" class="panel-collapse collapse in">
            <div class="panel-body">
              <div class="enquete-elements">

                <div class="enquete-element enquete-new-question" data-add-type="textfield">
                  <label for="">Open vraag</label>
                  <input class="form-control" type="text">
                </div>

                <div class="enquete-element enquete-new-question" data-add-type="textarea">
                  <label for="">Open vraag (lang)</label>
                  <textarea class="form-control" rows="5"></textarea>
                </div>

                <div class="enquete-element enquete-new-question" data-add-type="checkbox">
                  <label for="">Checkbox</label><br>
                  <input type="checkbox"> Checkbox
                </div>

                <div class="enquete-element enquete-new-question" data-add-type="radio">
                  <label for="">Radio</label><br>
                  <input type="radio"> Selectierondje
                </div>

                <div class="enquete-element enquete-new-question" data-add-type="select">
                  <label for="">Selectieveld</label><br>
                  <select>
                    <option value="">Selectieveld</option>
                  </select>
                </div>

              </div>

            </div>

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
                case "textarea":

                  ?>

                  <div 
                    class="panel panel-default enquete-element"
                    data-type="<?= $question->type ?>"
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

                      <div class="form-group">
                        <label for="">Plaatshouder</label>
                        <input 
                          class="form-control question-placeholder"
                          <?php
                            foreach($question->attributes as $attribute) {
                              if($attribute['attribute_type'] == "placeholder") {
                                echo "value=\"".$attribute['attribute']."\"";
                              }
                            }
                          ?>
                        >
                      </div>

                      <div class="form-group col-md-6">
                        <label for="">Verplicht</label><br>
                        <?php
                          if($question->required == 0) {
                        ?>
                            <input class="question-required-checkbox" type="checkbox"> Verplicht
                        <?php
                          } elseif($question->required == 1) {
                        ?>
                            <input class="question-required-checkbox" type="checkbox" checked="checked"> Verplicht
                        <?php
                          }
                        ?>
                      </div>

                      <div class="col-md-6">

                        <div class="form-group">

                          <button class="btn btn-primary btn-sm pull-right delete-question">&times;</button>

                        </div>

                      </div>

                    </div>
                  </div>
                <? break;

                case "checkbox":
                case "radio":
                case "select": ?>
                  <div 
                    class="panel panel-default enquete-element"
                    data-type="<?= $question->type; ?>"
                    data-id="<?= $question->id; ?>">
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
                          <select class="form-control question-multiplechoice-type">
                            <option value="checkbox" <?php echo ($question->type == "checkbox" ? "selected" : "");?>>Checkbox</option>
                            <option value="radio" <?php echo ($question->type == "radio" ? "selected" : "");?>>Keuzerondje</option>
                            <option value="select" <?php echo ($question->type == "select" ? "selected" : "");?>>Selectieveld</option>
                          </select>
                        </div>

                        <div class="form-group col-md-3">
                          <label for="">Verplicht</label><br>
                          <?php
                            if($question->required == 0) {
                          ?>
                              <input class="question-required-checkbox" type="checkbox"> Verplicht
                          <?php
                            } elseif($question->required == 1) {
                          ?>
                              <input class="question-required-checkbox" type="checkbox" checked="checked"> Verplicht
                          <?php
                            }
                          ?>
                        </div>

                        <div class="col-md-3"><button class="btn btn-primary btn-sm pull-right delete-question">&times;</button></div>

                      </div>
                    
                    </div>

                  </div>
                <? break;

              }

            ?>

          <? endforeach ?>

	  	</div>

      <div class="enquete-buttons">

  	  	<button class="btn btn-primary enquete-save">Opslaan</button>
        <a class="btn btn-default" href="<?= URL . "enquete/index/" . $enquete->id; ?>" target="_blank">Enquête bekijken</a>

      </div>

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