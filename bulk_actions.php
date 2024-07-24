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

<body is="dmx-app" id="bulk_actions">



    <script src="bootstrap/5/js/bootstrap.bundle.min.js"></script>

    <header class="bg-light">

        <div class="d-flex">

            <a><img alt="logo" width="80" height="80" class="mt-3 ms-3" src="assets/images/checkbox.png"></a>
            <h1 class="mt-3 ms-3">Task Manager - Bulk Actions </h1>
            <a href="task-manager.php">
                <button id="btn1" class="btn btn-primary gx-2 mt-4 mb-2 ms-2 me-2">Normal View</button>
            </a>
        </div>






    </header>
    <div class="d-flex justify-content-center mt-1 mb-1">
        <div class="modal" id="blk_del_mdl" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bulk-Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>you are about to delete &lt;X&gt; values</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" dmx-on:click="serverconnect1.load({ids: tableRepeat1.id})">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="blk_date_mdl" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bulk Due-date assignment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>set all &lt;X&gt; values to :</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="blk_name_mdl" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bulk rename</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>rename all entries to :</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Rename</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="blk_state_mdl" is="dmx-bs5-modal" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bulk state update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Change all entries to the following state?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <button id="btn_delete" class="btn btn-danger btn-lg ms-3 me-3" dmx-on:click="blk_del_mdl.show()">Delete</button>
        <button id="btn_set_state" class="btn btn-lg ms-3 me-3 btn-primary">set date</button>
        <button id="btn_set_date" class="btn btn-lg ms-3 me-3 btn-primary">set name</button>
        <button id="btn_set_name" class="btn btn-lg ms-3 me-3 btn-primary">set state</button>
    </div>
    <div class="container">
        <div class="d-flex">
            <dmx-serverconnect id="serverconnect1" url="dmxConnect/api/bulk_delete.php" dmx-param:ids="tableRepeat1.checkbox.value"></dmx-serverconnect>





            <table class="table table-striped w-75 table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Id</th>
                        <th>State</th>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Due date</th>
                    </tr>
                </thead>
                <tbody is="dmx-repeat" dmx-generator="bs5table" dmx-bind:repeat="table_query.data.query" id="tableRepeat1">
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkbox" name="multi-select" dmx-bind:value="id">
                                <label class="form-check-label" for="checkbox"></label>
                            </div>
                        </td>
                        <td dmx-text="id"></td>
                        <td dmx-text="state"></td>
                        <td dmx-text="item"></td>
                        <td dmx-text="description"></td>
                        <td dmx-text="due_date"></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-block w-25 bg-light ms-2 ps-2 pe-2">

                <p class="w-auto">
                    Example of an in depth content breakdown</p><img class="mt-2 mb-2 ms-2 me-2">
                <div class="form-group mb-3 row">
                    <div class="col-sm-10 w-auto">
                        <input type="file" class="form-control" id="input1" name="input1" aria-describedby="input1_help">
                        <small id="input1_help" class="form-text text-muted">Select here your image for upload.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <dmx-serverconnect id="table_query" url="dmxConnect/api/query.php"></dmx-serverconnect>

</body>

</html>