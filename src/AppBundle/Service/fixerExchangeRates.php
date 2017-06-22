<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 21-6-2017
 * Time: 09:20
 */

namespace AppBundle\Service;

use Buzz\Browser as Buzz;

class fixerExchangeRates
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

    public function getExchangeRates()
    {
        $fixer['EUR'] = json_decode($this->buzz->get('http://api.fixer.io/latest?symbols=IDR,GBP,CZK')->getContent())->rates;
        $fixer['GBP'] = json_decode($this->buzz->get('http://api.fixer.io/latest?base=GBP&symbols=IDR,EUR,CZK')->getContent())->rates;
        $fixer['CZK'] = json_decode($this->buzz->get('http://api.fixer.io/latest?base=CZK&symbols=IDR,EUR,GBP')->getContent())->rates;
        $fixer['IDR'] = json_decode($this->buzz->get('http://api.fixer.io/latest?base=IDR&symbols=EUR,GBP,CZK')->getContent())->rates;


        return $fixer;
    }
}