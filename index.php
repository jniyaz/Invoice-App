<?php
  require_once 'configuration.php';
  require_once('functions.php');
  if(!empty($_POST)){
    try {
      $data = saveInvoice($_POST);
      if(isset($data['success']) && $data['success']){
        $_SESSION['success'] = 'Invoice Saved Successfully';
        header('Location: list-invoices.php');
        exit;
      }
    } catch (Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Invoice App with Argon Design</title>
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.1" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>

<body>
  <header class="header-global">
    <nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-default">
      <div class="container">
          <a class="navbar-brand" href="#">Invoice App</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-default">
              <div class="navbar-collapse-header">
                  <div class="row">
                      <div class="col-6 collapse-brand">
                          <a href="/">
                              <img src="./assets/img/brand/blue.png">
                          </a>
                      </div>
                      <div class="col-6 collapse-close">
                          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                              <span></span>
                              <span></span>
                          </button>
                      </div>
                  </div>
              </div>

              <ul class="navbar-nav ml-lg-auto">
                  <li class="nav-item">
                      <a class="nav-link nav-link-icon" href="list-invoices.php">
                          <i class="ni ni-bullet-list-67"></i>
                          <span class="nav-link-inner--text d-lg-none">Invoice List</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link nav-link-icon" href="index.php">
                          <i class="ni ni-fat-add"></i>
                          <span class="nav-link-inner--text d-lg-none">Create Invoice</span>
                      </a>
                  </li>
                  <!-- <li class="nav-item dropdown">
                      <a class="nav-link nav-link-icon" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="ni ni-settings-gear-65"></i>
                          <span class="nav-link-inner--text d-lg-none">Settings</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                  </li> -->
              </ul>

          </div>
      </div>
    </nav>
  </header>

  <main class="profile-page">
    <section class="section">
      <div class="container">
        <?php include_once('messages.php'); ?>
        <form class="form-horizontal invoice-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="invoice-form" role="form" novalidate>
          <div class="row">
            <div class="table-responsive">
              <table class="table align-items-center" id="invoiceTable">
                  <thead class="thead-light">
                      <tr>
                          <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                          <th scope="col">Item No</th>
                          <th scope="col">Item Name</th>
                          <th scope="col">Price</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Total</th>
                      </tr>
                  </thead>
                  <tbody>
                     <tr>
                      <td><input class="case" type="checkbox"/></td>
                      <td><input type="text" data-type="productCode" name="data[0][product_id]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>
                      <td><input type="text" data-type="productName" name="data[0][product_name]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
                      <td><input type="number" name="data[0][price]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                      <td><input type="number" name="data[0][quantity]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                      <td><input type="number" name="data[0][total]" id="total_1" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
                     </tr>
                  </tbody>
              </table>
            </div>
          </div>
          <div class="row">

            <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
              <button id="delete" class="btn btn-sm btn-danger delete" type="button">- Delete</button>
              <button id="addmore" class="btn btn-sm btn-success addmore" type="button">+ Add More</button>
              <h2>Notes: </h2>
              <div class="form-group">
                <textarea class="form-control form-control-alternative" rows='3' name="notes" id="notes" placeholder="Your Notes"></textarea>
              </div>
            </div>

            <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
              <div class="form-group">
                <label>Subtotal: &nbsp;</label>
                <div class="input-group input-group-alternative mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control form-control-alternative" name="invoice_subtotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                </div>
              </div>
              <div class="form-group">
                <label>Tax: &nbsp;</label>
                <div class="input-group input-group-alternative mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control form-control-alternative" name="tax_percent" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                </div>
              </div>
              <div class="form-group">
                <label>Tax Amount: &nbsp;</label>
                <div class="input-group input-group-alternative mb-4">
                  <input type="number" class="form-control form-control-alternative" name="tax" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Total: &nbsp;</label>
                <div class="input-group input-group-alternative mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control" name="invoice_total" id="totalAftertax" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                </div>
              </div>
              <div class="form-group">
                <label>Amount Paid: &nbsp;</label>
                <div class="input-group input-group-alternative mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control" name="amount_paid" id="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                </div>
              </div>
              <div class="form-group">
                <label>Amount Due: &nbsp;</label>
                <div class="input-group input-group-alternative mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control amountDue" name="amount_due" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                </div>
              </div>
              <div class="form-group text-center">
                <button data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" class="btn btn-outline-default submit_btn invoice-save-bottom"><i class="fa fa-floppy-o"></i> Submit</button>
                <button type="button" class="btn btn-outline-warning">Reset</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="row align-items-center justify-content-md-between">
        <div class="col-md-6">
          <div class="copyright">
            &copy; <?php echo date('Y') ?>
            <a href="#" target="_blank">Invoice App</a>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="nav nav-footer justify-content-end">
            <li class="nav-item">
              <a href="https://n-labs.blogspot.com" class="nav-link" target="_blank">More News</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Core -->
  <script src="./assets/vendor/jquery/jquery.min.js"></script>
  <script src="./assets/vendor/popper/popper.min.js"></script>
  <script src="./assets/vendor/bootstrap/bootstrap.min.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.1"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <!-- Main JS -->
  <script src="./assets/js/main.js"></script>
</body>

</html>