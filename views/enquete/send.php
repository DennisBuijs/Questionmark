<div class="container">

  <div class="row">

    <div class="col-md-2">

      <h1 class="page-title pull-left"><a href="<?= URL ?>">Questionmark?</a></h1>

    </div>

    <div class="col-md-8">

      <div class="page-header">
        <h1>Enquete verzenden</h1>
        <a href="<?= URL ?>enquete/run" data-action="main-form" class="btn btn-primary pull-right run-form" style="margin-top:-40px;">Verstuur</a>
      </div>

      <ul class="list-group">
        <form class="main-form" action="<?= URL ?>enquete/run" method="post">
<textarea name="message"  class="form-control" style="width:100%;height:400px;box-sizing:border-box;padding:12px;">
Beste meneer {{last_name}},

Hoe gaat het eigelijk met u?

Met mij goed hoor, bedankt!

Maar uh, owja, kun je ff deze enquete invullen? owja en jou naam was trouwens {{first_name}} {{last_name}}. En uw email is tog {{email}}

Cool!

Doei
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
    <div class="col-md-2"></div>

  </div>

</div>