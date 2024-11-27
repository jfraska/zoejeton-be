<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subscription = Subscription::orderBy('created_at', 'desc')->paginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($subscription, 'get subscription successfull');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subscription = $this->getData($id);

        if ($subscription == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $this->sendResponse($subscription, 'subscription successfully loaded.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }

    protected function getData($id)
    {
        $subscription =  Subscription::where('invitation_id', $id)->orWhere('id', $id)->first();

        return $subscription;
    }
}
