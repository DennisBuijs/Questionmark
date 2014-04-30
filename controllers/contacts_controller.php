<?

class Contacts_Controller extends Controller {

  public function __construct() {
    parent::__construct();
  }


  public function index() {

    $this->view->contacts = $this->model->get_all_contacts();

    $this->view->render("header");
    $this->view->render("contacts/index");
    $this->view->render("footer");
  }


  public function edit($id) {
    $this->view->contact = $this->model->get_contact_by_id($id)[0];

    $this->view->render('header');
    $this->view->render('contacts/edit');
    $this->view->render('footer');
  }


  public function save() {
    $data = array(
        "first_name" => $_POST['first_name'],
        "last_name" => $_POST['last_name'],
        "email" => $_POST['email']
    );

    if ($_POST['type'] == 'create') {
      $this->model->create($data);
    }

    if ($_POST['type'] == 'edit') {
      $this->model->edit($data, $_POST['id']);
    }

    header("Location: " . URL . "contacts");
  }


  public function delete($id) {
    $this->model->delete($id);
    header("Location: " . URL . "contacts");
  }


}
