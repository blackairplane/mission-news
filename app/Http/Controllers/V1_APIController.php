<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Config;
use Illuminate\Http\Response;

abstract class V1_APIController extends Controller {

    use DispatchesCommands, ValidatesRequests;

    public $apiUser = 'codesmith';
    public $apiPass = 'bd017a70a9eecbaa90c4e38a565d2a11ae58d0a4';

    public $outputType = 'application/json';
    public $httpCode = 500;
    public $errorType = null;
    public $errorMessage = null;
    public $output = [];

    public function __construct() {
        $this->output = '';

//        if ( ! $this->authenticated())
//        {
//            $this->set_error('authentication_failed', 'Basic HTTP authentication is required.');
//            $this->response();
//        }
    }

    /**
     * Check authentication based upon HTTP basic authentication standard
     *
     * @author Jamie Howard <jhoward@rethinkgroup.org>
     * @link http://tools.ietf.org/html/rfc2617
     * @return Bool
     */
    public function authenticated()
    {
        // TODO: make this DB driven with api tokens and secret keys.
        // We did this so as to have at least one layer of protection, albeit a very weak one. - jhoward
        if ( isset(apache_request_headers()['Authorization'])):
            $auth = apache_request_headers()['Authorization'];
            $formattedAuth = substr($auth, strpos($auth, " ")+1);
            $correctAuth = $this->apiUser . ":" . $this->apiPass;
            if ((base64_decode($formattedAuth)) == $correctAuth):
                return true;
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    public function response() {

        if (is_null($this->errorType)):
            $this->httpCode = 200;
        elseif (! is_null($this->errorType)):
            $this->output['response']['error'] = array(
                'type' => $this->errorType,
                'message' => $this->errorMessage
            );
        else:
            $this->httpCode = 500;
            $this->output['response']['error'] = array(
                'type' => 'api_error',
                'message' => 'General failure'
            );
        endif;

        return \Response::json($this->output, 200, array('Content-type' => 'application/javascript'));
//        http_response_code($this->httpCode);
//        header("Content-type: " . $this->outputType);
//        echo json_encode($this->output);
        exit();
    }

    /**
     * Make a RESTful call to CRMText's API using Guzzle
     *
     * @author Jamie Howard <jhoward@rethinkgroup.org>
     * @link http://crmtext.com/api/docs
     * @link http://guzzle.readthedocs.org/en/latest/
     * @param string $type The corresponding API endpoint method to call
     * @param string $message An array structure of parameters to be passed to API
     * @return Bool
     */
    public function set_error($type = null, $message = null)
    {
        // TODO: This can probably handled with constants and an array - jhoward
        if ($type == 'invalid_request_error'): // If malformed request
            $this->httpCode = 400;
        elseif ($type == 'authentication_failed'): // If authentication failure
            $this->httpCode = 401;
        elseif ($type == 'third_party_error'): // If third-party failure
            $this->httpCode = 500;
        elseif ($type == 'phone_not_found'): // If phone number not found
            $this->httpCode = 404;
        else:
            $this->httpCode = 500;
        endif;

        $this->errorType = $type;

        if ( ! is_null($message)):
            $this->errorMessage = $message;
        else:
            // This is to help us catch generic server errors if they arise - jhoward
            $this->errorMessage = 'Server error';
        endif;

        return true;
    }
}
