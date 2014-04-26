<div class="row">

  <div class="col-md-8 col-md-push-2">

    <h1>Questionmark?</h1>

  </div>

</div>

<div class="row content">

  <div class="col-md-8 col-md-push-2">

    <div>
      <form class="form-inline" role="form" method="post" action="<?= URL ?>user/save">
        <input type="hidden" class="form-control" name="type" value="edit">
        <input type="hidden" class="form-control" name="id" value="<?= $this->user['id'] ?>">
        <input type="text" class="form-control" placeholder="Naam" value="<?= $this->user['name'] ?>" name="name"><!-- required -->
        <input type="email" class="form-control" placeholder="Email address" value="<?= $this->user['email'] ?>" name="email">
        <input type="password"class="form-control" placeholder="Wachtwoord" name="password">
        <button type="submit" class="btn btn-default">Registreer</button>
      </form>

    </div>

  </div>

</div>