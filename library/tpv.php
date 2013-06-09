<?php


namespace Equity\Library {

    use Equity\Model\Invest,
        Equity\Model\Project,
        Equity\Core\Redirection;

	/*
	 * Clase para usar la pasarela de pago
	 */
    class Tpv {

        /*
         * para ceca no hay preapproval, es el cargo directamente
         */
        public static function preapproval($invest, &$errors = array()) {
            return static::pay($invest, $errors);
        }

        public static function pay($invest, &$errors = array()) {
            if (\EQUITY_FREE) {
                return false;
            }
        }

        public static function cancelPreapproval ($invest, &$errors = array()) {
            return static::cancelPay($invest, $errors);
        }
        public static function cancelPay($invest, &$errors = array()) {
            if (\EQUITY_FREE) {
                return false;
            }
        }

	}
	
}