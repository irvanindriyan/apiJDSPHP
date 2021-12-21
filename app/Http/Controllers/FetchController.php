<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Fungsi;
use GuzzleHttp\Client;

class FetchController extends Controller
{
	protected $apiKey, $client, $usdidr;

	public function __construct(Request $request)
    {
        // $this->apiKey = '9d1482decb27369c687c';
        $this->apiKey = 'd1ded944220ca6b0c442';
        $this->client = new Client();
    }

	public function getData()
	{
		try {
			$products = $this->fetchData('https://60c18de74f7e880017dbfd51.mockapi.io/api/v1/jabar-digital-services/product');
			$currency = $this->fetchData('https://free.currencyconverterapi.com/api/v5/convert?q=USD_IDR&compact=ultra&apiKey='.$this->apiKey);
	        
	        $data = array();

	        foreach ($products as $product) {
	        	$product->price_idr = $this->convert($product->price, $currency->USD_IDR);

	        	$data[] = $product;
	        }

	        return $data;
	    } catch (\Exception $e){
            return response()->json(
	            Fungsi::resError($e->getMessage())
	        , 500);
        }
	}

	public function getDataOrder()
	{
		try {
			$products = $this->getData();

			foreach ($products as $product) {
				unset($product->id);
				unset($product->createdAt);
				unset($product->price);
			}

			usort($products, function($a, $b) {
				return (float) str_replace(',', '', $a->price_idr) <=> (float) str_replace(',', '', $b->price_idr);
			});

	        return $products;
	    } catch (\Exception $e){
            return response()->json(
	            Fungsi::resError($e->getMessage())
	        , 500);
        }
	}

	public function fetchData($url)
	{
		$data = $this->client->get($url);

	    $res = $data->getBody();

	    return json_decode($res);
	}

	public function convert($amount, $currency)
	{
		return Fungsi::idrFormat($currency * $amount, 2);
	}
}