<?php
/**
 * Created by PhpStorm.
 * User: iuppiter NUC
 * Date: 29-5-2017
 * Time: 11:34
 */

namespace AppBundle\Twig;



class AppExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('documentLink', [$this, 'documentLinkFunction']),
            new \Twig_SimpleFunction('currency', [$this, 'currencyFunction']),

        ];
    }

    public function documentLinkFunction($_description, $entity, $id, $hash)
    {
        $description = \str_replace(' ', '', \ucwords($_description));
        return sprintf('/check/%s/%s/%s/hash/%s', $description, $entity, $id, $hash);
    }

    public function currencyFunction($currency)
    {
        if ($currency == 'EUR') return '€';
        if ($currency == 'GBP') return '£';
        return $currency;
    }
}