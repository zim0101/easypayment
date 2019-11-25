<?php


namespace PayWayDev\EasyPayment\Interfaces;


interface MolliePaymentInterface
{
    /**
     * @param string $price
     * @param string $currency
     * @param string $redirectUrl
     * @param string $webHookUrl
     * @param string|null $description
     * @param string|null $orderId
     * @return array
     */
    public function createPayment (string $price, string $currency, string $redirectUrl, string $webHookUrl, string $description=null, string $orderId=null) :array ;

    /**
     * @param string $paymentId
     * @return array
     */
    public function getPayment (string $paymentId) :array;

    /**
     * @param string $paymentId
     * @param string $description
     * @param string $redirectUrl
     * @param string $webHookUrl
     * @param string $orderId
     * @return array
     */
    public function updatePayment (string $paymentId, string $description, string $redirectUrl, string $webHookUrl, string $orderId) :array ;

    /**
     * @param string $paymentId
     * @return array
     */
    public function cancelPayment (string $paymentId) :array;
}
