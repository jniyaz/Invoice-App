<?php

require_once('configuration.php');
global $con;

// Save Invoice
function saveInvoice(array $data) {
    echo "<pre>";
    print_r($data);
    die();
}

// Save Invoice Details to an Invoice
function saveInvoiceDetails(array $data, $id) {

}

// Get Invoices
function getInvoices(){

}

// Get single invoice
function getInvoice($id){
    $data = [];
    $query = "SELECT * FROM invoices";
    if($results = mysqli_query($con, $query)) {
        while($row = mysqli_fetch_assoc($results)) {
            array_push($data, $row);
        }
    }
    return $data;
}
