<?php

namespace PayWayDev\EasyPayment\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayWayDev\EasyPayment\Services\MolliePaymentService;

class EasyPayTestController extends Controller
{
    public function testEasyPay (Request $request) {
        $paymentService = new MolliePaymentService();
        $data = $paymentService->createPayment('9.00', 'EUR', 'https://zim-3qym.localhost.run/red', 'https://zim-3qym.localhost.run/hook', 'test', '13123');
        return redirect($data['payment']->getCheckoutUrl(), 303);
    }
}
