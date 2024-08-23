<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payment = Payment::orderBy('created_at', 'desc')->paginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($payment, 'get payment successfull');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $subscription = $this->getSubscription($id);

        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|exists:subscriptions,id',
            'desc' => 'nullable|string',
            'total' => 'required|numeric|min:1',

            'items' => 'nullable|array',
            'items.*.id' => 'nullable|string',
            'items.*.price' => 'nullable|numeric|min:1',
            'items.*.quantity' => 'nullable|integer|min:1',
            'items.*.name' => 'nullable|string',,

            'enabled_payments' => 'nullable|array',
            'enabled_payments.*' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        // Set Your server key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');

        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;

        // Enable sanitization
        Config::$isSanitized = true;

        // Enable 3D-Secure
        Config::$is3ds = true;

        $payment = $subscription->payment()->create([
            'user_id' => Auth::id(),
            'desc' => $request->desc,
            'items' => $request->items,
            'total' => $request->total,
        ]);

        $transaction_details = array(
            'order_id' => $payment->id,
            'gross_amount' => $payment->total,
        );

        $customer_details = array(
            'first_name'    => $payment->user()->name,
            'email'         => $payment->user()->email,
        );

        // Fill transaction details
        $transaction = array(
            'enabled_payments' => $request->enable_payments,
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $payment->items,
        );

        try {
            $snap_token = Snap::getSnapToken($transaction);

            return $this->sendResponse(["snap_token" => $snap_token], 'Payment successfully created.');
        } catch (\Exception $e) {
            return $this->sendError(self::UNPROCESSABLE, null, $e->getMessage());
        }
    }

    /**
     * callback notification.
     */
    public function callback()
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

        $payment = $this->getData($order_id);

        $payment->status = $transaction;
        $payment->method = $type;
        $payment->save();

        return $this->respondWithMessage($message);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $payment = $this->getData($id);

        return $this->sendResponse($payment, 'Payment successfully loaded.');
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

    protected function getSubscription($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string|max:255|exists:subscriptions,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('VALIDATION_ERROR', null, $validator->errors());
        }

        $subscription =  Subscription::find($id);

        if ($subscription == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $subscription;
    }

    protected function getData($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string|max:255|exists:payments,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('VALIDATION_ERROR', null, $validator->errors());
        }

        $payment =  Payment::find($id);

        if ($payment == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $payment;
    }
}
