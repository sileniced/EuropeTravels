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

    public function getPrice($antshares = 1001)
    {
        $result['anc'] = $antshares;
        $result['ANSBTC'] = json_decode($this->buzz->get('https://bittrex.com/api/v1.1/public/getticker?market=btc-ans')->getContent())->result->Last;
        $result['btc'] = $result['anc'] * $result['ANSBTC'];
        $market['bitonic'] = json_decode($this->buzz->get('https://bitonic.nl/api/sell?btc=' . $result['btc'])->getContent());
        $result['eur'] = $market['bitonic']->eur;
        $result['BTCEUR'] = $market['bitonic']->price;

        return $result;
    }
}