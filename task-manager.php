<!doctype html>
<html>

<head>
  <base href="/">
  <script src="dmxAppConnect/dmxAppConnect.js"></script>
  <meta charset="UTF-8">
  <title>Untitled Document</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="bootstrap/5/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="dmxAppConnect/dmxBootstrap5TableGenerator/dmxBootstrap5TableGenerator.css" />
  <script src="dmxAppConnect/dmxBootstrap5Modal/dmxBootstrap5Modal.js" defer></script>
</head>

<body is="dmx-app" id="taskmanager">



  <header>
    <div class="d-flex"><a><img alt="logo" width="80" height="80" class="mt-3 ms-3" src="assets/images/checkbox.png"></a>
      <h1 class="mt-3 ms-3">Task Manager</h1>
    </div>






  </header>
  <dmx-serverconnect id="table_query" url="dmxConnect/api/query.php" dmx-param:sort=""></dmx-serverconnect>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>Item</th>
          <th>Description</th>
          <th>Due date</th>
          <th></th>
        </tr>
      </thead>
      <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="table_query.data.query" id="tableRepeat2">
        <tr>
          <td>
            <div class="form-check">
              <input class="form-check-input ms-3" type="checkbox" id="state_checkbox" name="state[]" dmx-bind:checked="state" value="1">
            </div>
          </td>
          <td dmx-text="item"></td>
          <td dmx-text="description"></td>
          <td dmx-text="due_date"></td>
          <td>
            <div class="d-flex">



              <dmx-serverconnect id="edit_query" url="dmxConnect/api/single%20query.php" dmx-param:id="id" noload="true" dmx-on:success="edit_modal.show()"></dmx-serverconnect>
              <div class="modal" id="edit_modal" is="dmx-bs5-modal" tabindex="-1">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form is="dmx-serverconnect-form" id="edit_form" method="post" action="dmxConnect/api/update.php" dmx-generator="bootstrap4" dmx-form-type="horizontal" dmx-populate="edit_query.data.query">
                      <div class="form-group row">
                        <legend class="col-sm-2 col-form-label">State</legend>
                        <div class="col-sm-10">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="inp_state" name="state" dmx-bind:value="edit_query.data.query.state">
                            <label class="form-check-label" for="inp_state">State</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inp_item" class="col-sm-2 col-form-label">Item</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inp_item" name="item" dmx-bind:value="edit_query.data.query.item" aria-describedby="inp_item_help" placeholder="Enter Item">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inp_description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inp_description" name="description" dmx-bind:value="edit_query.data.query.description" aria-describedby="inp_description_help" placeholder="Enter Description">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inp_due_date" class="col-sm-2 col-form-label">Due date</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inp_due_date" name="due_date" dmx-bind:value="edit_query.data.query.due_date" aria-describedby="inp_due_date_help" placeholder="Enter Due date">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inp_id" class="col-sm-2 col-form-label">Id</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inp_id" name="id" dmx-bind:value="edit_query.data.query.id" aria-describedby="inp_id_help" placeholder="Enter Id">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-2">&nbsp;</div>
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary" dmx-bind:value="edit_query.data.query.Save" dmx-bind:disabled="state.executing">Save <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span></button>
                        </div>
                      </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div><button id="edit_button" class="btn bg-secondary me-2" dmx-on:click="edit_query.load({})"><i class="fas fa-edit"></i>Edit</button>

              <button id="del_button" class="btn bg-danger ms-2" dmx-on:click="delete_form.delete_modal.show()"><i class="fas fa-trash-alt"></i></button>

              <form is="dmx-serverconnect-form" id="delete_form" method="post" action="dmxConnect/api/delete.php">
                <div class="modal fade" id="delete_modal" is="dmx-bs5-modal" tabindex="-1">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-body">

                        <p><input id="id" name="id" type="hidden" value="" dmx-bind:value="id_var.value"></p>
                        <h3>are you sure you want to delete this item?</h3>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary bg-danger" data-bs-dismiss="modal" dmx-on:click="delete_form.submit();table_query.load({})">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>






          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-center align-items-center">
    <form is="dmx-serverconnect-form" id="new_item_form" method="post" action="dmxConnect/api/create.php">
      <div class="modal" id="modal1" is="dmx-bs5-modal" tabindex="-1">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">New Item</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p><label for="item">Item:</label><input id="item" name="item" type="text" value=""></p>
              <p><label for="description">Description:</label><input id="description" name="description" type="text" value=""></p>
              <p><label for="due_date">Due date:</label><input id="due_date" name="due_date" type="date" value=""></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" dmx-on:click="new_item_form.submit();table_query.load({})">Add</button>
            </div>
          </div>
        </div>
      </div>


    </form>
    <button id="add_new" class="btn text-start btn-lg" dmx-on:click="new_item_form.modal1.show()"><i class="fas fa-plus-circle fa-4x"></i></button>
  </div>

  <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>
</body>

</html>