<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\File;
use Closure;

class ApiLoggingRequest
{
	/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	private $startTime;

	public function handle($request, Closure $next)
	{
		$this->startTime = microtime(true);

		return $next($request);
	}

	public function terminate($request, $response)
	{
		if ( env('API_DATALOGGER', true) ) {
			$endTime = microtime(true);
			$filename = 'api_log_request_'.date('d-m-y').'.log';
			$dataToLog  = 'Time: '.date("F j, Y, H:i:s")."\n";
			$dataToLog .= 'Duration: '.number_format($endTime, 3)."\n";
			$dataToLog .= 'IP Address: '.$request->ip()."\n";
			$dataToLog .= 'IP Client: '.$this->get_client_ip()."\n";
			$dataToLog .= 'Agent: '.$request->server('HTTP_USER_AGENT')."\n";
			$dataToLog .= 'URL: '.$request->fullUrl()."\n";
			$dataToLog .= 'Method: '.$request->method()."\n";
			$dataToLog .= 'Input: '.$request->getContent()."\n";
			$dataToLog .= 'Output: '.$response->getContent()."\n";

			\File::append( storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $dataToLog . "\n" . str_repeat("=", 20) . "\n\n");
		}
	}

	private function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if(isset($_SERVER['HTTP_X_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if(isset($_SERVER['HTTP_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		} else if(isset($_SERVER['REMOTE_ADDR'])) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}
		
		return $ipaddress;
	}
}
