<div class="row">

  <div class="col-md-8 col-md-push-2">

    <h1 class="pull-left">Questionmark?</h1>

    <div class="btn-group btn-group-lg pull-right" style="margin-top:20px;">
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <span class="glyphicon glyphicon-wrench"></span>
      </button>
      <ul class="dropdown-menu">
        <li><a href="<?= URL ?>">Home</a></li>
        <li><a href="<?= URL . "contacts/index"?>">Bewerk contacten</a></li>
        <li><a href="<?= URL . "index/logout"?>">Log uit</a></li>
      </ul>
    </div>

  </div>

</div>

<div class="row content">

  <div class="col-md-8 col-md-push-2">

    <div>


      <form class="form-inline" role="form" method="post" action="<?= URL ?>user/save">
        <input type="hidden" class="form-control" name="type" value="create">
        <input type="text" class="form-control" placeholder="Naam" name="name"><!-- required -->
        <input type="email" class="form-control" placeholder="Email address" name="email">
        <input type="password"class="form-control" placeholder="Wachtwoord" name="password">
        <button type="submit" class="btn btn-default">Registreer</button>
      </form>


      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Naam</th>
            <th>e-mail</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>          
          <? foreach ($this->users as $user) : ?>
            <tr>
              <td><?= $user['id'] ?></td>
              <td><?= $user['name'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><a href="<?= URL . "user/edit/" . $user['id']; ?>">bewerk</a></td>
              <td><? if (!$user['admin']) : ?><a href="<?= URL . "user/delete/" . $user['id']; ?>">verwijder</a><? endif; ?></td>
            </tr>
          <? endforeach; ?>
        </tbody>

      </table>

    </div>

  </div>

</div>