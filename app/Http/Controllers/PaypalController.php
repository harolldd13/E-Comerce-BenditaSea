<?php

namespace App\Http\Controllers;

use App\Mail\OrderPaid;
use App\Models\Order;
use Srmklive\PayPal\Services\PayPal as PayPalClient; // Uso correcto de la clase PayPal
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Cart; // Cambiado a CodersFree\Shoppingcart

class PaypalController extends Controller
{
    public function getExpressCheckout($orderId)
    {
        $checkoutData = $this->checkoutData($orderId);
        $provider = new PayPalClient; // Uso de la clase PayPalClient
        $response = $provider->setExpressCheckout($checkoutData);
        return redirect($response['paypal_link']);
    }

    public function getExpressCheckoutSuccess(Request $request, $orderId)
    {
        $provider = new PayPalClient; // Uso de la clase PayPalClient
        $token = $request->token;
        $payerID = $request->PayerID;
        $checkoutData = $this->checkoutData($orderId);
        $response = $provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $payment_status = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

            if (in_array($status, ['Completed', 'Processed'])) {
                $order = Order::find($orderId);
                $order->is_paid = 1;
                $order->save();
                Mail::to($order->user->email)->send(new OrderPaid($order));
                Cart::destroy();
                return redirect()->route('shop.index')->withMessage('pago exitoso');
            }
        }
        return redirect()->route('shop.index')->withError('pago fallido');
    }

    public function cancelPage()
    {
        dd("cancelado");
    }

    public function checkoutData($orderId)
    {
        $cartItems = Cart::content()->map(function ($item) {
            return [
                'name' => $item->name,
                'price' => $item->price,
                'qty' => $item->qty,
            ];
        })->toArray();

        $checkoutData = [
            'items' => $cartItems,
            'invoice_id' => uniqid(),
            'invoice_description' => "descripcion de la orden",
            'return_url' => route('paypal.success', $orderId),
            'cancel_url' => route('paypal.cancel'),
            'total' => Cart::total(),
        ];
        return $checkoutData;
    }
}
