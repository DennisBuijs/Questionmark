<div class="container">

  <div class="col-md-8 col-md-push-2">

    <h1 class="page-title"><a href="<?= URL; ?>">Questionmark?</a></h1>
    <a href="<?= URL ?>enquete/run" data-action="main-form" class="btn btn-primary pull-right run-form" style="margin-top:-40px;">Verstuur</a>
  
  </div>

  <div class="row">
    
    <div class="col-md-8 col-md-push-2 content">
      
      <ul class="list-group">
        <form class="main-form" action="<?= URL ?>enquete/run" method="post">
          <textarea name="message"  class="form-control" rows="12">
          </textarea>
          <div>U kunt de volgende tags gebruiken: <b>{{first_name}}</b>, <b>{{last_name}}</b> en <b>{{email}}</b></div><br>
          <input type="hidden" class="form-control" name="type" value="send">
          <input type="hidden" class="form-control" name="form_id" value="<?= $this->form_id ?>">
          <? foreach ($this->contacts as $contact) : ?>   
            <li class="list-group-item"><input type="checkbox" name="contacts[]" value="<?= $contact['id'] ?>"> - <?= $contact['first_name'] . " " . $contact['first_name']; ?> <small><?= $contact['email'] ?></small></li>        
          <? endforeach; ?>
        </form>

      </ul>

    </div>

  </div>

</div>