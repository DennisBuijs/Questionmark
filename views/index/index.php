  <div class="row">

    <div class="col-md-8 col-md-push-2">

      <h1>Questionmark?</h1>

    </div>

  </div>

  <div class="row content">

    <div class="col-md-8 col-md-push-2">

      <div class="panel-group" id="accordion">

      <? foreach ($this->enquetes as $enquete) : ?> 
      
        <div class="panel panel-default enquete-meta">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <?= $enquete->name; ?>
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                <div class="panel-body">
                  <div class="col-md-12" style="margin: 0 0 15px 0; padding:0">
                    <?= $enquete->introduction; ?>
                  </div>
                  <div class="col-md-6" style="margin: 0 0 15px 0; padding:0">
                    <strong>Aantal keer bekeken:</strong> [[AANTAL KEER BEKEKEN]]<br>
                    <strong>Aantal keer ingevuld:</strong> [[AANTAL KEER INGEVULD]]<br>
                  </div>
                  <div class="col-md-6" style="margin: 0 0 15px 0; padding:0">
                    <strong>Gestart op:</strong> <?= $enquete->start_date; ?><br>
                    <strong>Eindigt op:</strong> <?= $enquete->end_date; ?><br>
                  </div>

                  <div class="button-group">

                    <a class="btn btn-primary btn-sm" href="results/">Resultaten</a>

                    <div class="btn-group pull-right">
                      <a class="btn btn-primary btn-sm" href="enquete/edit/<?= $enquete->id; ?>">Bewerken</a> 
                      <a class="btn btn-primary btn-sm" href="enquete/delete/<?= $enquete->id; ?>">Verwijderen</a>
                    </div>

                  </div>

                  <div class="input-group">
                    <input type="text" class="input-sm form-control" value="<?= URL; ?>enquete/<?= $enquete->id; ?>">
                    <a href="verzenden.html" class="btn btn-default btn-sm input-group-addon">Verzenden</a>
                  </div> 
                </div>
              </div>
            </div>

          <? endforeach; ?>

      </div>

    </div>

  </div>