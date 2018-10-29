<?php

    require_once('configuration.php');

    // Save Invoice
    function saveInvoice(array $data) {

        // echo "<pre>";
        // print_r($data);
        // die;

        if(!empty($data)){
            global $con;
            $count=0;
            if(isset($data['data'])){
                foreach ($data['data'] as $value) {
                    if(!empty($value['product_id'])){
                        $count++;
                    }
                }
            }

            if($count == 0) throw new Exception("Please add one product to create invoice!", 1);

            if(!empty($data)) {

                $client_id = mysqli_real_escape_string( $con, trim( $data['client_id'] ) );
                $invoice_total = mysqli_real_escape_string( $con, trim( $data['invoice_total'] ) );
                $invoice_subtotal = mysqli_real_escape_string( $con, trim( $data['invoice_subtotal'] ) );
                $tax = mysqli_real_escape_string( $con, trim( $data['tax'] ) );
                $amount_paid = mysqli_real_escape_string( $con, trim( $data['amount_paid'] ) );
                $amount_due = mysqli_real_escape_string( $con, trim( $data['amount_due'] ) );
                $notes = mysqli_real_escape_string( $con, trim( $data['notes'] ) );

                // hard coded data
                $client_id = 1;

                $id = mysqli_real_escape_string( $con, trim( $data['id'] ) );

                if(empty($id)) {
                    $uuid = uniqid();
                    $query = "INSERT INTO invoices (client_id, invoice_total, invoice_subtotal, tax, amount_paid, amount_due, notes, created_at, uuid)
                    VALUES($client_id, $invoice_total, $invoice_subtotal, $tax, $amount_paid, $amount_due, $notes, CURRENT_TIMESTAMP(), $uuid)";
                } else {
                    $uuid = $data['uuid'];
                    $query = "UPDATE invoices SET 'client_id' = $client_id, 'invoice_total' = $invoice_total, 'invoice_subtotal' = $invoice_subtotal, 'tax' = $tax,
                    'amount_paid' = $amount_paid, 'amount_due' = $amount_due, 'notes' = $notes, 'updated_at' = CURRENT_TIMESTAMP WHERE id = $id";
                }

                if(!mysqli_query($con, $query)) {
                    throw new Exception( mysqli_error($con) );
                } else {
                    if(empty($id)) $id = mysqli_insert_id($con);
                }

                if(isset($data['data']) && !empty($data['data'])) {
                    // Save invoice details to invoice details table

                }
            } else {
                throw new Exception("Please check, Required fields are mandatory!", 1);
            }
        } else {
            throw new Exception( "Please check, some of the required fileds missing" );
        }
    }

    // Save Invoice Details to an Invoice
    function saveInvoiceDetails(array $data, $id) {

    }

    // Get Invoices
    function getInvoices(){

    }

    // Get single invoice
    function getInvoice($id){
        global $con;
        $data = [];
        $query = "SELECT * FROM invoices";
        if($results = mysqli_query($con, $query)) {
            while($row = mysqli_fetch_assoc($results)) {
                array_push($data, $row);
            }
        }
        return $data;
    }
