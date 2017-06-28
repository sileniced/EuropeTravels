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

    public function getPrice(){

        $market = [
            'BTCANS' => json_decode($this->buzz->get('https://bittrex.com/api/v1.1/public/getticker?market=btc-ans')->getContent())->result->Last,
            'USDBTC' => json_decode($this->buzz->get('https://bittrex.com/api/v1.1/public/getticker?market=usdt-btc')->getContent())->result->Last,
            'USDEUR' => json_decode($this->buzz->get('http://api.fixer.io/latest?base=usd&symbols=EUR')->getContent())->rates->EUR
        ];

        $result['anc'] = 1001;
        $result['btc'] = $result['anc'] * $market['BTCANS'];
        $result['usd'] = $result['btc'] * $market['USDBTC'];
        $result['eur'] = $result['usd'] * $market['USDEUR'];

        return $result;
    }
}