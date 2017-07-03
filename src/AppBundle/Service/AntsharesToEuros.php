<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 28-6-2017
 * Time: 09:37
 */

namespace AppBundle\Service;

use Buzz\Browser as Buzz;

class AntsharesToEuros
{
    private $buzz;

    /**
     * fixerExchangeRates constructor.
     * @param $buzz
     */
    public function __construct(Buzz $buzz)
    {
        $this->buzz = $buzz;
    }

    public function getPrice()
    {
        $result['ans'] = 1547;
        $result['ANSBTC'] = json_decode($this->buzz->get('https://bittrex.com/api/v1.1/public/getticker?market=btc-ans')->getContent())->result->Last;

        $result['btc'] = $result['ans'] * $result['ANSBTC'];
        $market['bitonic'] = json_decode($this->buzz->get('https://bitonic.nl/api/sell?btc=' . $result['btc'])->getContent());
        $result['eur'] = $market['bitonic']->eur;
        $result['BTCEUR'] = $market['bitonic']->price;

        $market['ANCCNY'] = json_decode($this->buzz->get('https://www.19800.com/api/v1/ticker?market=cny_anc')->getContent())->data->LastPrice;
        $market['CNYEUR'] = json_decode($this->buzz->get('http://api.fixer.io/latest?base=CNY&symbols=EUR')->getContent())->rates->EUR;

        $result['eur_day'] = 0.7128576 * $market['ANCCNY'] * $market['CNYEUR'];
        $result['eur_month'] = $result['eur_day'] * 30.5;

        return $result;
    }
}