<?php
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
                <h2>Invoices</h2>
                 <div class="row">
                    <div class="table-responsive">
                      <table class="table align-items-center" id="invoiceTable">
                          <thead class="thead-light">
                              <tr>
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Invoice Total</th>
                                <th>Amount Paid</th>
                                <th>Due Amount</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php
                                if( !empty( $invoices ) ){
                                    foreach ($invoices as $value) {
                            ?>
                            <tr>
                                <th scope="row"><?= isset($value['id']) ? $value['id'] : '-' ?> </th>
                                <td>Smart Invoice</td>
                                <td> <?= isset($value['invoice_total']) ? $value['invoice_total'] : '-' ?> </td>
                                <td> <?= isset($value['amount_paid']) ? $value['amount_paid'] : '-' ?> </td>
                                <td> <?= isset($value['amount_due']) ? $value['amount_due'] : '-' ?> </td>
                            </tr>
                            <?php } } else { ?>
                            <tr colspan="4">
                                <td>No Invoice Found</td>
                            </tr>
                            <?php } ?>
                          </tbody>
                      </table>
                    </div>
                </div>
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