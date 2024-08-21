<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Set Your server key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');

        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;


        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => 94000, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => 18000,
            'quantity' => 3,
            'name' => "Apple"
        );

        // Optional
        $item2_details = array(
            'id' => 'a2',
            'price' => 20000,
            'quantity' => 2,
            'name' => "Orange"
        );

        // Optional
        $item_details = array($item1_details, $item2_details);

        // Optional
        $customer_details = array(
            'first_name'    => "Andri",
            'last_name'     => "Litani",
            'email'         => "andri@litani.com",
            'phone'         => "081122334455",
        );

        // Optional, remove this to display all available payment methods
        $enable_payments = array('credit_card', 'cimb_clicks', 'mandiri_clickpay', 'echannel');

        // Fill transaction details
        $transaction = array(
            'enabled_payments' => $enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        try {
            $snap_token = Snap::getSnapToken($transaction);

            return $this->sendResponse($snap_token, 'Payment successfully created.');
        } catch (\Exception $e) {
            return $this->sendError(self::UNPROCESSABLE, null, $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function callback(Request $request)
    {
        // Set Your server key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');

        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;

        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            return $this->sendError(self::UNPROCESSABLE, null, $e->getMessage());
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            // For credit card transactions, check whether the transaction is challenged by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO: Set payment status in the merchant's database to 'Challenge by FDS'
                    // TODO: The merchant should decide whether this transaction is authorized or not in MAP
                    $message = "Transaction is challenged by FDS";
                } else {
                    // TODO: Set payment status in the merchant's database to 'Success'
                    $message = "Transaction successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO: Set payment status in the merchant's database to 'Settlement'
            $message = "Transaction successfully transferred using " . $type;
        } else if ($transaction == 'pending') {
            // TODO: Set payment status in the merchant's database to 'Pending'
            $message = "Waiting for the customer to finish the transaction using " . $type;
        } else if ($transaction == 'deny') {
            // TODO: Set payment status in the merchant's database to 'Denied'
            $message = "Payment using " . $type . " is denied.";
        } else if ($transaction == 'expire') {
            // TODO: Set payment status in the merchant's database to 'Expired'
            $message = "Payment using " . $type . " has expired.";
        } else if ($transaction == 'cancel') {
            // TODO: Set payment status in the merchant's database to 'Canceled'
            $message = "Payment using " . $type . " has been canceled.";
        }

        return $this->sendResponse([
            'order_id' => $order_id,
            'status' => $transaction,
        ], $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
