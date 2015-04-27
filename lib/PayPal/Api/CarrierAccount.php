<?php

namespace PayPal\Api;

use PayPal\Common\PayPalResourceModel;
use PayPal\Validation\ArgumentValidator;
use PayPal\Rest\ApiContext;
use PayPal\Transport\PayPalRestCall;

/**
 * Class CarrierAccount
 *
 * A resource representing a carrier account that can be used to fund a payment.
 *
 * @package PayPal\Api
 *
 * @property string id
 * @property string phone_number
 * @property string phone_source
 * @property string external_customer_id
 * @property string valid_until
 * @property \PayPal\Api\CountryCode country_code
 */
class CarrierAccount extends PayPalResourceModel
{
    /**
     * ID of the carrier account being saved for later use.
     *
     * @param string $id
     * 
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * ID of the carier account being saved for later use.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Phone number.
     *
     * @param string $number
     * 
     * @return $this
     */
    public function setPhoneNumber($number)
    {
        $this->phone_number = $number;
        return $this;
    }

    /**
     * Phone number.
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * The method of obtaining the phone number.
     *
     * @param string $type
     * 
     * @return $this
     */
    public function setPhoneSource($source)
    {
        $this->phone_source = $source;
        return $this;
    }

    /**
     * The method of obtaining the phone number.
     *
     * @return string
     */
    public function getPhoneSource()
    {
        return $this->phone_source;
    }

    /**
     * A unique identifier of the customer to whom this carrier account belongs to. Generated and provided by the facilitator. This is required when creating or using a stored funding instrument in vault.
     *
     * @param string $external_customer_id
     * 
     * @return $this
     */
    public function setExternalCustomerId($external_customer_id)
    {
        $this->external_customer_id = $external_customer_id;
        return $this;
    }

    /**
     * A unique identifier of the customer to whom this carrier account belongs to. Generated and provided by the facilitator. This is required when creating or using a stored funding instrument in vault.
     *
     * @return string
     */
    public function getExternalCustomerId()
    {
        return $this->external_customer_id;
    }

    /**
     * Country code represenating the customers country.
     *
     * @param \PayPal\Api\CountryCode $country_code
     * 
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->country_code = $country_code;
        return $this;
    }

    /**
     * Country code represenating the customers country.
     *
     * @return \PayPal\Api\Address
     */
    public function getCountryCode()
    {
        return $this->country_code;
    }

    /**
     * Date/Time until this resource can be used fund a payment.
     *
     * @param string $valid_until
     * 
     * @return $this
     */
    public function setValidUntil($valid_until)
    {
        $this->valid_until = $valid_until;
        return $this;
    }

    /**
     * Date/Time until this resource can be used fund a payment.
     *
     * @return string
     */
    public function getValidUntil()
    {
        return $this->valid_until;
    }


    /**
     * Creates a new Carrier Account Resource (aka Tokenize).
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return CarrierAccount
     */
    public function create($apiContext = null, $restCall = null)
    {
        $payLoad = $this->toJSON();
        $json = self::executeCall(
            "/v1/vault/carrier-accounts",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }

    /**
     * Obtain the Carrier Account resource for the given identifier.
     *
     * @param string $carrierAccountId
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return CarrierAccount
     */
    public static function get($carrierAccountId, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($carrierAccountId, 'carrierAccountId');
        $payLoad = "";
        $json = self::executeCall(
            "/v1/vault/carrier-accounts/$carrierAccountId",
            "GET",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $ret = new CarrierAccount();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Delete the Carrier Account resource for the given identifier.
     *
     * @param ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return bool
     */
    public function delete($apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        $payLoad = "";
        self::executeCall(
            "/v1/vault/carrier-accounts/{$this->getId()}",
            "DELETE",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        return true;
    }

    /**
     * Confirms the Carrier Account (after PIN code received by customer)
     *
     * @param CarrierAccountConfirmation $carrierAccountConfirmation
     * @param \PayPal\Rest\ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @param PayPalRestCall $restCall is the Rest Call Service that is used to make rest calls
     * @return CarrierAccount
     */
    public function confirm($carrierAccountConfirmation, $apiContext = null, $restCall = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($carrierAccountConfirmation, 'carrierAccountConfirmation');

        $payLoad = $carrierAccountConfirmation->toJSON();
        $json = self::executeCall(
            "/v1/vault/carrier-accounts/{$this->getId()}/confirm",
            "POST",
            $payLoad,
            null,
            $apiContext,
            $restCall
        );
        $this->fromJson($json);
        return $this;
    }


}
