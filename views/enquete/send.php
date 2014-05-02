<div class="container">

  <div class="row">

    <div class="col-md-2"></div>

    <div class="col-md-8">

      <div class="page-header">
        <h1>Enquete verzenden</h1>
        <a href="<?= URL ?>enquete/run" data-action="main-form" class="btn btn-primary pull-right run-form" style="margin-top:-40px;">Verstuur</a>
      </div>

      <ul class="list-group">
        <form class="main-form" action="<?= URL ?>enquete/run" method="post">
          <? foreach ($this->contacts as $contact) : ?>   
            <input type="hidden" class="form-control" name="type" value="send">
            <li class="list-group-item"><input type="checkbox" name="<?= $contact['id'] ?>"> - <?= $contact['first_name'] . " " . $contact['first_name']; ?> <small><?= $contact['email'] ?></small></li>        
          <? endforeach; ?>
        </form>

      </ul>
    </div>
    <div class="col-md-2"></div>

  </div>

</div>