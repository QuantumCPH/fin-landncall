<?php

require_once(sfConfig::get('sf_lib_dir') . '/telintaSoap.class.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Telinta
 * emails are being sent in each of the action and same that is just becuse if Managment needs diffrent messages.
 * @author baran Khan
 */
class Telienta {

    //put your code here

    private static $customerReseller = "R_LandNcall_FIN";
    private static $iParent = 77222;                //Customer Resller ID on Telinta
    private static $companyReseller = '';
    private static $currency = 'EUR';
    private static $AProduct = 'LNC_FIN_CT';
    private static $a_iProduct = 10729;
    private static $CBProduct = '';
    private static $VoipProduct = '';
    private static $telintaSOAPUrl = "https://mybilling.telinta.com";
    private static $telintaSOAPUser = 'API_login';
    private static $telintaSOAPPassword = 'ee4eriny';

    public static function ResgiterCustomer(Customer $customer, $OpeningBalance) {
        $pb = new PortaBillingSoapClient(self::$telintaSOAPUrl, 'Admin', 'Customer');
        $uniqueid = "FLB2C" . $customer->getUniqueid();
        $tCustomer = false;
        $max_retries = 5;
        $retry_count = 0;
        while (!$tCustomer && $retry_count < $max_retries) {
            try {
                $tCustomer = $pb->add_customer(array('customer_info' => array(
                                'name' => $uniqueid, //75583 03344090514
                                'iso_4217' => self::$currency,
                                'i_parent' => self::$iParent,
                                'i_customer_type' => 1,
                                'opening_balance' => -($OpeningBalance),
                                'credit_limit' => 0,
                                'dialing_rules' => array('ip' => '00'),
                                'email' => 'okh@zapna.com'
                                )));
            } catch (SoapFault $e) {
                if ($e->faultstring != 'Could not connect to host') {
                    emailLib::sendErrorInTelinta("Error in Customer Registration", "We have faced an issue in Customer registration on telinta. this is the error for cusotmer with  id: " . $customer->getId() . " and error is " . $e->faultstring . "  <br/> Please Investigate.");

                    return false;
                }
            }sleep(0.5);
            $retry_count++;
        }
        if ($retry_count == $max_retries) {
            emailLib::sendErrorInTelinta("Error in Customer Registration", "We have faced an issue in Customer registration on telinta.with  id: " . $customer->getId() . " Error is Even After Max Retries " . $max_retries . "  <br/> Please Investigate.");
            return false;
        }
        $customer->setICustomer($tCustomer->i_customer);
        $customer->save();
        return true;
    }

    public static function createAAccount($mobileNumber, Customer $customer) {
        return self::createAccount($customer, $mobileNumber, 'a', self::$a_iProduct);
    }

    public static function createCBount($mobileNumber, Customer $customer) {
        return self::createAccount($customer, $mobileNumber, 'cb', self::$b_iProduct);
    }

    public static function terminateAccount(TelintaAccounts $telintaAccount) {

        $account = false;
        $max_retries = 5;
        $retry_count = 0;
        $pb = new PortaBillingSoapClient(self::$telintaSOAPUrl, 'Admin', 'Account');
        while (!$account && $retry_count < $max_retries) {
            try {

                $account = $pb->terminate_account(array('i_account' => $telintaAccount->getIAccount()));
            } catch (SoapFault $e) {
                if ($e->faultstring != 'Could not connect to host') {
                    emailLib::sendErrorInTelinta("Account Deletion: " . $telintaAccount->getIAccount() . " Error!", "We have faced an issue in Customer Account Deletion on telinta. this is the error for cusotmer with  id: " . $telintaAccount->getIAccount() . " error is " . $e->faultstring . "  <br/> Please Investigate.");

                    return false;
                }
            }
            sleep(0.5);
            $retry_count++;
        }
        if ($retry_count == $max_retries) {
            emailLib::sendErrorInTelinta("Account Deletion: " . $telintaAccount->getIAccount() . " Error!", "We have faced an issue in Customer Account Deletion on telinta. Error is Even After Max Retries " . $max_retries . "  <br/> Please Investigate.");
            return false;
        }
        $telintaAccount->setStatus(5);
        $telintaAccount->save();
        return true;
    }

    public static function getBalance(Customer $customer) {
        $cInfo = false;
        $max_retries = 5;
        $retry_count = 0;
        $pb = new PortaBillingSoapClient(self::$telintaSOAPUrl, 'Admin', 'Customer');
        while (!$cInfo && $retry_count < $max_retries) {
            try {
                $cInfo = $pb->get_customer_info(array(
                            'i_customer' => $customer->getICustomer(),
                        ));
                $Balance = $cInfo->customer_info->balance;
            } catch (SoapFault $e) {
                if ($e->faultstring != 'Could not connect to host') {
                    emailLib::sendErrorInTelinta("Error in getBalance", "We have faced an issue on Success in getBalnace on telinta. this is the error for cusotmer with  id: " . $customer->getId() . " error is " . $e->faultstring . "  <br/> Please Investigate.");
                    return false;
                }
            }
            sleep(0.5);
            $retry_count++;
        }
        if ($retry_count == $max_retries) {
            emailLib::sendErrorInTelinta("Error in getBalance cusotmer id: " . $customer->getId(), "We have faced an issue on Success in getBalnace on telinta. Error is Even After Max Retries " . $max_retries . "  <br/> Please Investigate.");
            return false;
        }
        if ($Balance == 0)
            return $Balance;
        else
            return -1 * $Balance;
    }

    public static function charge(Customer $customer, $amount, $description) {
        return self::makeTransaction($customer, "Manual charge", $amount, $description);
    }

    public static function recharge(Customer $customer, $amount) {
        return self::makeTransaction($customer, "Manual payment", $amount, "Refill");
    }

    public static function callHistory(Customer $customer, $fromDate, $toDate) {
        $pb = new PortaBillingSoapClient(self::$telintaSOAPUrl, 'Admin', 'Customer');
        $xdrList = false;
        $max_retries = 5;
        $retry_count = 0;
        while (!$xdrList && $retry_count < $max_retries) {
            try {
                $xdrList = $pb->get_customer_xdr_list(array('i_customer' => $customer->getICustomer(), 'from_date' => $fromDate . " 00:00:00", 'to_date' => $toDate . " 23:59:59"));
            } catch (SoapFault $e) {
                if ($e->faultstring != 'Could not connect to host') {
                    emailLib::sendErrorInTelinta("Customer Call History: " . $icustomer . " Error!", "We have faced an issue with Customer while Fetching Call History  this is the error for cusotmer with  ICustomer: " . $icustomer . " error is " . $e->faultstring . "  <br/> Please Investigate.");
                    return false;
                }
            }sleep(0.5);
            $retry_count++;
        }
        if ($retry_count == $max_retries) {
            emailLib::sendErrorInTelinta("Customer Call History: " . $icustomer . " Error!", "We have faced an issue with Customer while Fetching Call History on telinta. Error is Even After Max Retries " . $max_retries . "  <br/> Please Investigate.");
            return false;
        }
        return $xdrList;
    }

    public static function deactivateFollowMeNumber($VOIPNumber, $CurrentActiveNumber) {

        $url = "https://mybilling.telinta.com/htdocs/zapna/zapna.pl?action=update&name=" . $VOIPNumber . "&active=N&follow_me_number=" . $CurrentActiveNumber . "&type=account";
        $deactivate = file_get_contents($url);
        sleep(0.5);
        if (!$deactivate) {
            emailLib::sendErrorInTelinta("Error in deactivateFollowMeNumber", "Unable to call. We have faced an issue in deactivateFollowMeNumber on telinta. this is the error on the following url: " . $url . "  <br/> Please Investigate.");
            return false;
        }
        parse_str($deactivate);
        if (isset($success) && $success != "OK") {
            emailLib::sendErrorInTelinta("Error in deactivateFollowMeNumber", "We have faced an issue on Success in deactivateFollowMeNumber on telinta. this is the error on the following url:" . $url . " <br/> and error is: " . $deactivate . "  <br/> Please Investigate.");
            return false;
        }
        return true;
    }

    public static function createReseNumberAccount($VOIPNumber, $uniqueId, $currentActiveNumber) {

        $url = "https://mybilling.telinta.com/htdocs/zapna/zapna.pl?type=account&action=activate&name=" . $VOIPNumber . "&customer=" . $uniqueId . "&opening_balance=0&credit_limit=&product=" . self::$VoipProduct . "&outgoing_default_r_r=2034&activate_follow_me=Yes&follow_me_number=" . $currentActiveNumber . "&billing_model=1&password=asdf1asd";
        $reseNumber = file_get_contents($url);
        sleep(0.5);
        if (!$reseNumber) {
            emailLib::sendErrorInTelinta("Error in createReseNumberAccount", "Unable to call. We have faced an issue in createReseNumberAccount on telinta. this is the error on the following url: " . $url . "  <br/> Please Investigate.");
            return false;
        }
        parse_str($reseNumber);
        if (isset($success) && $success != "OK") {
            emailLib::sendErrorInTelinta("Error in createReseNumberAccount", "We have faced an issue on Success in createReseNumberAccount on telinta. this is the error on the following url:" . $url . " <br/> and error is: " . $reseNumber . "  <br/> Please Investigate.");
            return false;
        }
        return true;
    }

    /*
     * $accountType is for a or cb accounts
     */

    private static function createAccount(Customer $customer, $mobileNumber, $accountType, $iProduct, $followMeEnabled='N') {
        $account = false;
        $max_retries = 5;
        $retry_count = 0;
        $pb = new PortaBillingSoapClient(self::$telintaSOAPUrl, 'Admin', 'Account');


        while (!$account && $retry_count < $max_retries) {
            try {
                $accountName = $accountType . $mobileNumber;
                $account = $pb->add_account(array('account_info' => array(
                                'i_customer' => $customer->getICustomer(),
                                'name' => $accountName, //75583 03344090514
                                'id' => $accountName,
                                'iso_4217' => self::$currency,
                                'opening_balance' => 0,
                                'credit_limit' => null,
                                'i_product' => $iProduct,
                                'i_routing_plan' => 2039,
                                'billing_model' => 1,
                                'password' => 'asdf1asd',
                                'h323_password' => 'asdf1asd',
                                'activation_date' => date('Y-m-d'),
                                'batch_name' => "FLB2C" . $customer->getUniqueid(),
                                'follow_me_enabled' => $followMeEnabled
                                )));
            } catch (SoapFault $e) {
                if ($e->faultstring != 'Could not connect to host') {
                    emailLib::sendErrorInTelinta("Account Creation: " . $accountName . " Error!", "We have faced an issue in Customer Account Creation on telinta. this is the error for cusotmer with  id: " . $customer->getId() . " and on Account" . $accountName . " error is " . $e->faultstring . "  <br/> Please Investigate.");

                    return false;
                }
            } sleep(0.5);
            $retry_count++;
        }
        if ($retry_count == $max_retries) {
            emailLib::sendErrorInTelinta("Account Creation: " . $accountName . " Error!", "We have faced an issue in Customer Account Creation on telinta.cusotmer with  id: " . $customer->getId() . " Error is Even After Max Retries " . $max_retries . "  <br/> Please Investigate.");
            return false;
        }

        $telintaAccount = new TelintaAccounts();
        $telintaAccount->setAccountTitle($accountName);
        $telintaAccount->setParentId($customer->getId());
        $telintaAccount->setParentTable("customer");
        $telintaAccount->setICustomer($customer->getICustomer());
        $telintaAccount->setIAccount($account->i_account);
        $telintaAccount->save();
        return true;
    }

    private static function makeTransaction(Customer $customer, $action, $amount, $description) {
        $accounts = false;
        $max_retries = 5;
        $retry_count = 0;
        $pb = new PortaBillingSoapClient(self::$telintaSOAPUrl, 'Admin', 'Customer');
        while (!$accounts && $retry_count < $max_retries) {
            try {
                $accounts = $pb->make_transaction(array(
                            'i_customer' => $customer->getICustomer(),
                            'action' => $action, //Manual payment, Manual charge
                            'amount' => $amount,
                            'visible_comment' => $description
                        ));
            } catch (SoapFault $e) {
                if ($e->faultstring != 'Could not connect to host') {
                    emailLib::sendErrorInTelinta("Customer Transcation: " . $customer->getId() . " Error!", "We have faced an issue with Customer while making transaction " . $action . " with balance:" . $amount . " this is the error for cusotmer with  Customer ID: " . $customer->getId() . " error is " . $e->faultstring . "  <br/> Please Investigate.");

                    return false;
                }
            }
            sleep(0.5);
            $retry_count++;
        }
        if ($retry_count == $max_retries) {
            emailLib::sendErrorInTelinta("Customer Transcation: " . $customer->getId() . " Error!", "We have faced an issue with Customer while making transaction on telinta. " . $action . " with balance:" . $amount . "Error is Even After Max Retries " . $max_retries . "  <br/> Please Investigate.");
            return false;
        }
        return true;
    }

}

?>
