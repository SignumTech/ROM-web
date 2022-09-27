<?php

namespace App\Http\Controllers;

use Chapa\Chapa\Facades\Chapa as Chapa;
use Illuminate\Http\Request;
class ChapaController extends Controller
{
    /**
     * Initialize Rave payment process
     * @return void
     */
    protected $reference;

    public function __construct(){
        $this->reference = Chapa::generateReference();

    }
    public function initialize()
    {
        $this->validate($request, [
            "amount" => "required"
        ]);
        //This generates a payment reference
        $reference = $this->reference;
        

        // Enter the details of the payment
        $data = [
            
            'amount' => $request->amount,
            'email' => 'fnote.md@gmail.com',
            'tx_ref' => $reference,
            'currency' => "ETB",
            'callback_url' => route('callback',[$reference]),
            'return_url' => route('return_url',[$reference]),
            'first_name' => auth()->user()->f_name,
            'last_name' => auth()->user()->l_name,
            "customization" => [
                "title" => 'Product purchase',
                "description" => "A product purchase"
            ]
        ];
        

        $payment = Chapa::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return $payment;
        }

        return redirect($payment['data']['checkout_url']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback($reference)
    {
        
        $data = Chapa::verifyTransaction($reference);
        dd($data);

        //if payment is successful
        if ($data['status'] ==  'success') {
        

        dd($data);
        }

        else{
            //oopsie something ain't right.
        }


    }

    public function return_url($reference)
    {
        
        $data = Chapa::verifyTransaction($reference);

        //if payment is successful
        if ($data['status'] ==  'success') {
            
        }

        else{
            //oopsie something ain't right.
        }


    }
}