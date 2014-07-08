<?php

/**
 * Class for exceptions raised by the Console_CommandLine package.
 *
 * @category  Console
 * @package   Console_CommandLine
 * @author    David JEAN LOUIS <izimobil@gmail.com>
 * @copyright 2007 David JEAN LOUIS
 * @license   http://opensource.org/licenses/mit-license. MIT License 
 * @version   Release: 1.2.0
 * @link      http://pear..net/package/Console_CommandLine
 * @since     Class available since release 0.1.0
 */
class Console_CommandLine_Exception extends PEAR_Exception
{
    // Codes constants {{{

    /**#@+
     * Exception code constants.
     */
    const OPTION_VALUE_REQUIRED   = 1;
    const OPTION_VALUE_UNEXPECTED = 2;
    const OPTION_VALUE_TYPE_ERROR = 3;
    const OPTION_UNKNOWN          = 4;
    const ARGUMENT_REQUIRED       = 5;
    const INVALID_SUBCOMMAND      = 6;
    /**#@-*/

    // }}}
    // factory() {{{

    /**
     * Convenience method that builds the exception with the array of params by
     * calling the message provider class.
     *
     * @param string              $code     The string identifier of the
     *                                      exception.
     * @param array               $params   Array of template vars/values
     * @param Console_CommandLine $parser   An instance of the parser
     * @param array               $messages An optional array of messages
     *                                      passed to the message provider.
     *
     * @return object an instance of Console_CommandLine_Exception
     */
    public static function factory(
        $code, $params, $parser, array $messages = array()
    ) {
        $provider = $parser->message_provider;
        if ($provider instanceof Console_CommandLine_CustomMessageProvider) {
            $msg = $provider->getWithCustomMessages(
                $code,
                $params,
                $messages
            );
        } else {
            $msg = $provider->get($code, $params);
        }
        $const = 'Console_CommandLine_Exception::' . $code;
        $code  = defined($const) ? constant($const) : 0;
        return new Console_CommandLine_Exception($msg, $code);
    }

    // }}}
}