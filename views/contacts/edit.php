<div class="row">

  <div class="col-md-8 col-md-push-2">

    <h1 class="page-title pull-left"><a href="<?= URL ?>">Questionmark?</a></h1>

        <div class="btn-group btn-group-lg pull-right" style="margin-top:20px;">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <span class="glyphicon glyphicon-wrench"></span>
      </button>
      <ul class="dropdown-menu">
        <li><a href="<?= URL ?>">Home</a></li>
        <li><a href="<?= URL . "user/index"?>">Bewerk gebruikers</a></li>
        <li><a href="<?= URL . "index/logout"?>">Log uit</a></li>
      </ul>
    </div>
    
  </div>
  


</div>

<div class="row content">

  <div class="col-md-8 col-md-push-2">

    <div>
      <form class="form-inline" role="form" method="post" action="<?= URL ?>contacts/save">
        <input type="hidden" class="form-control" name="type" value="edit">
        <input type="hidden" class="form-control" name="id" value="<?= $this->contact['id'] ?>">
        <span data-required="required"><input type="text" class="form-control" placeholder="Voornaam" value="<?= $this->contact['first_name'] ?>" name="first_name"><!-- required --></span>
        <span data-required="required"><input type="text"  class="form-control" placeholder="Achternaam" value="<?= $this->contact['last_name'] ?>" name="last_name"><!-- required --></span>
        <span data-required="required"><input type="email" class="form-control" placeholder="Emailaddress" value="<?= $this->contact['email'] ?>" name="email"></span>
        <button type="submit" class="btn btn-default">opslaan</button>
      </form>

    </div>

  </div>

</div>