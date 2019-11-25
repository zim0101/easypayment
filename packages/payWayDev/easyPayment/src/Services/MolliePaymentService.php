<?php


namespace PayWayDev\EasyPayment\Services;


use Illuminate\Support\Facades\Config;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\Exceptions\IncompatiblePlatform;
use Mollie\Api\MollieApiClient;
use PayWayDev\EasyPayment\Interfaces\MolliePaymentInterface;

class MolliePaymentService implements MolliePaymentInterface
{
    private static $mollieApiClient = null;

    /**
     * @return MollieApiClient|null
     * @throws IncompatiblePlatform
     */
    public static function getMollieApiClientInstance() {
        if (!self::$mollieApiClient) {
            self::$mollieApiClient = new MollieApiClient();
        }

        return self::$mollieApiClient;
    }

    /**
     * @param string $price
     * @param string $currency
     * @param string $redirectUrl
     * @param string $webHookUrl
     * @param string|null $description
     * @param string|null $orderId
     * @return array
     */
    public function createPayment(string $price, string $currency, string $redirectUrl, string $webHookUrl, string $description = null, string $orderId=null) :array {
        try {
            $mollie = MolliePaymentService::getMollieApiClientInstance();
        } catch (IncompatiblePlatform $e) {
            return ['success' => false, 'message' => __($e->getMessage()), 'apiErrorResponse' => $e->getResponse()];
        }

        try {
            $mollie->setApiKey(Config::get('mollie.apiKey'));
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => $currency,
                    "value" => $price
                ],
                "description" => $description,
                "redirectUrl" => $redirectUrl,
                "webhookUrl" => $webHookUrl,
                "metadata" => [
                    "order_id" => $orderId,
                ],
            ]);
        } catch (ApiException $e) {
            return ['success' => false, 'message' => __($e->getMessage()), 'apiErrorResponse' => $e->getResponse()];
        }

        return ['success' => true, 'message' => __('Payment has been created successfully'), 'payment' => $payment];
    }

    /**
     * @param string $paymentId
     * @return array
     */
    public function getPayment(string $paymentId) :array {
        try {
            $mollie = MolliePaymentService::getMollieApiClientInstance();
        } catch (IncompatiblePlatform $e) {
            return ['success' => false, 'message' => __($e->getMessage()), 'apiErrorResponse' => $e->getResponse()];
        }
        try {
            $mollie->setApiKey(Config::get('mollie.apiKey'));
            $payment = $mollie->payments->get($paymentId);
        } catch (ApiException $e) {
            return ['success' => false, 'message' => __($e->getMessage()), 'apiErrorResponse' => $e->getResponse()];
        }

        return ['success' => true, 'message' => __('Fetched mollie payment details successfully'), 'payment' => $payment];
    }

    /**
     * @param string $paymentId
     * @param string $description
     * @param string $redirectUrl
     * @param string $webHookUrl
     * @param string $orderId
     * @return array
     */
    public function updatePayment(string $paymentId, string $description, string $redirectUrl, string $webHookUrl, string $orderId) :array {
        try {
            $mollie = MolliePaymentService::getMollieApiClientInstance();
        } catch (IncompatiblePlatform $e) {
            return ['success' => false, 'message' => __($e->getMessage()), 'apiErrorResponse' => $e->getResponse()];
        }
        try {
            $mollie->setApiKey(Config::get('mollie.apiKey'));
            $payment = $mollie->payments->get($paymentId);
            $payment->description = $description;
            $payment->redirectUrl = $redirectUrl;
            $payment->webhookUrl = $webHookUrl;
            $payment->metadata = ["order_id" => $orderId];
            $payment = $payment->update();

            return ['success' => true, 'payment' => $payment, 'message' => __('Updated mollie payment details successfully')];
        } catch (ApiException $e) {
            return ['success' => false, 'message' => __($e->getMessage()), 'apiErrorResponse' => $e->getResponse()];
        }
    }

    /**
     * @param string $paymentId
     * @return array
     */
    public function cancelPayment(string $paymentId) :array {
        try {
            $mollie = MolliePaymentService::getMollieApiClientInstance();
        } catch (IncompatiblePlatform $e) {
            return ['success' => false, 'message' => __($e->getMessage()), 'apiErrorResponse' => $e->getResponse()];
        }

        try {
            $mollie->setApiKey(Config::get('mollie.apiKey'));
            $canceledPayment = $mollie->payments->delete($paymentId);
            return ['success' => true, 'message' => __('Canceled mollie payment successfully'), 'canceledPayment' => $canceledPayment];
        } catch (ApiException $e) {
            return ['success' => false, 'message' => __($e->getMessage()), 'apiErrorResponse' => $e->getResponse()];
        }
    }
}
