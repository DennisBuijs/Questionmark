<div class="row">

  <div class="col-md-8 col-md-push-2">

    <h1>Questionmark?</h1>

  </div>

</div>

<div class="row content">

  <div class="col-md-8 col-md-push-2">

    <div>
      <form class="form-inline" role="form" method="post" action="<?= URL ?>contacts/save">
        <input type="hidden" class="form-control" name="type" value="edit">
        <input type="hidden" class="form-control" name="id" value="<?= $this->contact['id'] ?>">
        <input type="text" class="form-control" placeholder="Voornaam" value="<?= $this->contact['first_name'] ?>" name="first_name"><!-- required -->
        <input type="text" class="form-control" placeholder="Achternaam" value="<?= $this->contact['last_name'] ?>" name="last_name"><!-- required -->
        <input type="email" class="form-control" placeholder="Emailaddress" value="<?= $this->contact['email'] ?>" name="email">
        <button type="submit" class="btn btn-default">opslaan</button>
      </form>

    </div>

  </div>

</div>