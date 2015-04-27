<?php

namespace PayPal\Api;

use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;

/**
 * Class CarrierAccountConfirmation
 *
 * Let's you confirm a PayPal Carrier Account based Carrier Account resource with the PIN code
 *
 * @package PayPal\Api
 *
 * @property string pin
 */
class CarrierAccountConfirmation extends PayPalModel
{
    /**
     * PIN code, sent to the Mobile number when creating a carrier account.
     * 
     *
     * @param string $pin
     * 
     * @return $this
     */
    public function setPin($pin)
    {
        $this->pin = $pin;
        return $this;
    }

    /**
     * PIN code, sent to the Mobile number when creating a carrier account.
     *
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }
}