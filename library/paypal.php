<?php


namespace Equity\Library {

    use Equity\Model\Invest,
        Equity\Model\Project,
        Equity\Model\User,
        Equity\Library\Feed,
        Equity\Core\Redirection;

	/*
	 * Clase para usar los adaptive payments de paypal
         * Reference used: https://www.x.com/adaptive-payments-2
	 */
    class Paypal {

	/*
	*******************************************************************
	PayPal API Credentials
	Replace <API_USERNAME> with your API Username
	Replace <API_PASSWORD> with your API Password
	Replace <API_SIGNATURE> with your Signature
	*******************************************************************
	*/
        public $main = array(
		'api_endpoint' => '', 
		'wsdl' => '',
		'API_UserName' => 'sbapi_1287090601_biz_api1.paypal.com', //replace with values from Equity
		'API_Password' => '1287090610', //replace with values from Equity
		'API_Signature' => 'ANFgtzcGWolmjcm5vfrf07xVQ6B9AsoDvVryVxEQqezY85hChCfdBMvY', //replace with values from Equity
		'API_AppID' => 'APP-80W284485P519543T', //replace with values from Equity
		'API_MessageProtocol' => 'SOAP11',
	);
	public $RequestEnvelope = array(
		'detailLevel' => '',
		'errorLanguage' => '',
	);
	public $PreapprovalRequest = array(
		'cancelUrl' => '',
		'currencyCode' => '',
		'dateOfMonth' => '',
		'dayofWeek' => '',
		'endingDate' => '',
		'ipnNotificationUrl' => '',
		'maxAmountPerPayment' => '',
		'maxNumberOfPayments' => '',
		'maxNumberOfPaymentsPerPeriod' => '',
		'maxTotalAmountOfAllPayments' => '',
		'memo' => '', 
		'paymentPeriod' => '',
		'pinType' => '',
		'returnUrl' => '',
		'startingDate' => '',
	);

        /**
         * @param object invest instancia del aporte: id, usuario, proyecto, cuenta, cantidad
         *
         * Método para crear un preapproval para un aporte
         * va a mandar al usuario a paypal para que confirme
         *
         * @TODO poner límite máximo de dias a lo que falte para los 40/80 dias para evitar las cancelaciones
         */
        public static function preapproval($invest, &$errors = array()) {
		error_log(print_r($invest,1));
		$this->$PreapprovalRequest['cancelUrl'] = 'http://www.ebay.com'; //replace with values from Equity
		$this->$PreapprovalRequest['currencyCode'] = 'EUR'; //replace with values from Equity
		$this->$PreapprovalRequest['returnUrl'] = 'http://www.ebay.com'; //replace with values from Equity
		$this->$PreapprovalRequest['endingDate'] = '2012-12-30T08:00:00'; //replace with values from Equity
		$this->$PreapprovalRequest['maxTotalAmountOfAllPayments'] = '500.0'; //replace with values from Equity
		$this->$PreapprovalRequest['memo'] = 'preapproval';
		$this->$PreapprovalRequest['startingDate'] = '2012-11-20T08:00:00'; //replace with values from Equity
		$http_headers = "X-PAYPAL-SECURITY-USERID: " . $this->main['API_UserName'] . "\r\n" .
                    "X-PAYPAL-SECURITY-SIGNATURE: " . $this->main['API_Signature'] . "\r\n" .
                 	"X-PAYPAL-SECURITY-PASSWORD: " . $this->main['API_Password'] . "\r\n" .
                   	"X-PAYPAL-APPLICATION-ID: " . $this->main['API_AppID'] . "\r\n" .
   	                "X-PAYPAL-MESSAGE-PROTOCOL: " .$this->main['API_MessageProtocol']. "\r\n";
		$opts = array('http' => array('method' => 'POST', 'header' => $http_headers));
		$ctx = stream_context_create($opts);
		try {
			$soapClient = new SoapClient($wsdl,
				array('location' => $this->main['api_endpoint'],
					'uri' => 'urn:Preapproval',
					'soap_version' => SOAP_1_1,
					'trace' => 1,
					'stream_context' => $ctx));
		} catch (SoapFault $e) {
			   echo "Error Id : ||" . $e->detail->FaultMessage->error->errorId. "<br/>";
			   echo "Error Message : ||" . $e->detail->FaultMessage->error->message;	
		}
		$response = $soapClient->Preapproval($params);
		$preapprovalKey = $response->preapprovalKey;
		$ackCode = $response->responseEnvelope->ack;
		$paypalURL = "https://www.sandbox.paypal.com/webscr?cmd=_ap-preapproval&preapprovalkey=" .$preapprovalKey;
		echo '<p><a href="' . $paypalURL . '" target="_blank">' . $paypalURL . '</a></p>';
        }


        /*
         *  Metodo para ejecutar pago (desde cron)
         * Recibe parametro del aporte (id, cuenta, cantidad)
         *
         * Es un pago encadenado, la comision del 8% a Equity y el resto al proyecto
         *
         */
        public static function pay($invest, &$errors = array()) {
            if (\EQUITY_FREE) {
                return false;
            }
        }


        /*
         *  Metodo para ejecutar pago secundario (desde cron/dopay)
         * Recibe parametro del aporte (id, cuenta, cantidad)
         */
        public static function doPay($invest, &$errors = array()) {
            if (\EQUITY_FREE) {
                return false;
            }
        }


        /*
         * Llamada a paypal para obtener los detalles de un preapproval
         */
        public static function preapprovalDetails ($key, &$errors = array()) {
            if (\EQUITY_FREE) {
                return false;
            }
        }

        /*
         * Llamada a paypal para obtener los detalles de un cargo
         */
        public static function paymentDetails ($key, &$errors = array()) {
            if (\EQUITY_FREE) {
                return false;
            }
        }


        /*
         * Llamada para cancelar un preapproval (si llega a los 40 sin conseguir el mínimo)
         * recibe la instancia del aporte
         */
        public static function cancelPreapproval ($invest, &$errors = array()) {
            if (\EQUITY_FREE) {
                return false;
            }
        }

	}
	
}
