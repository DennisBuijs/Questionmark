<div class="row">

  <div class="col-md-8 col-md-push-2">

    <h1 class="page-title pull-left"><a href="<?= URL; ?>">Questionmark?</a></h1>

    <div class="btn-group btn-group-lg pull-right" style="margin-top:20px;">

      <a href="<?= URL . "enquete/make" ?>" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>

      <div class="btn-group btn-group-lg">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-wrench"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="<?= URL . "user/index" ?>">Bewerk gebruikers</a></li>
          <li><a href="<?= URL . "contacts/index" ?>">Bewerk contacten</a></li>
          <li><a href="<?= URL . "index/logout" ?>">Log uit</a></li>
        </ul>
      </div>

    </div>

  </div>




</div>

<div class="row content">

  <div class="col-md-8 col-md-push-2">

    <div class="panel-group" id="accordion">
      <? if (isset($this->enquetes)) : ?>
        <? foreach ($this->enquetes as $enquete) : ?> 

          <div class="panel panel-default enquete-meta">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $enquete->id; ?>">
                  <?= $enquete->name; ?>
                </a>
              </h4>
            </div>
            <div id="collapse<?= $enquete->id; ?>" class="panel-collapse in" style="height: auto;">
              <div class="panel-body">
                <div class="col-md-12" style="margin: 0 0 15px 0; padding:0">
                  <?= $enquete->introduction; ?>
                </div>
                <div class="col-md-6" style="margin: 0 0 15px 0; padding:0">
                  <strong>Gemaakt door:</strong> <?= $enquete->creator; ?><br>
                  <strong>Gemaakt op:</strong> <?= $enquete->creation_date; ?><br>
                </div>
                <div class="col-md-6" style="margin: 0 0 15px 0; padding:0">
                  <strong>Gestart op:</strong> <?= $enquete->start_date; ?><br>
                  <strong>Eindigt op:</strong> <?= $enquete->end_date; ?><br>
                </div>

                <div class="button-group">

                  <a class="btn btn-primary btn-sm" href="results/" style="opacity:0;">Resultaten</a>

                  <div class="btn-group pull-right">
                    <a class="btn btn-primary btn-sm" href="enquete/edit/<?= $enquete->id; ?>">Bewerken</a> 
                    <a class="btn btn-primary btn-sm" href="enquete/delete/<?= $enquete->id; ?>">Verwijderen</a>
                  </div>

                </div>

                <div class="input-group">
                  <input type="text" class="input-sm form-control" value="<?= URL; ?>enquete/index/<?= $enquete->id; ?>">
                  <a href="<?= URL . "enquete/send/" . $enquete->id; ?>" class="btn btn-default btn-sm input-group-addon">Verzenden</a>
                </div> 
              </div>
            </div>
          </div>

        <? endforeach; ?>
      <? endif; ?>

    </div>

  </div>

</div>