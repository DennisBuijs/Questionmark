<div class="row">

  <div class="col-md-8 col-md-push-2">

    <h1>Questionmark?</h1>

  </div>

</div>

<div class="row content">

  <div class="col-md-8 col-md-push-2">

    <div>


      <form class="form-inline" role="form" method="post" action="<?= URL ?>contacts/save">
        <input type="hidden" class="form-control" name="type" value="create">
        <input type="text" class="form-control" placeholder="Voornaam" name="first_name"><!-- required -->
        <input type="text" class="form-control" placeholder="Achternaam" name="last_name"><!-- required -->
        <input type="email" class="form-control" placeholder="Email address" name="email">
        <button type="submit" class="btn btn-default">Registreer</button>
      </form>


      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Email adres</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>          
          <? foreach ($this->contacts as $contact) : ?>
            <tr>
              <td><?= $contact['id']; ?></td>
              <td><?= $contact['first_name']; ?></td>
              <td><?= $contact['last_name']; ?></td>
              <td><?= $contact['email']; ?></td>
              <td><a href="<?= URL . "contacts/edit/" . $contact['id']; ?>">bewerk</a></td>
              <td><a href="<?= URL . "contacts/delete/" . $contact['id']; ?>">verwijder</a></td>


            </tr>
          <? endforeach; ?>
        </tbody>

      </table>

    </div>

  </div>

</div>