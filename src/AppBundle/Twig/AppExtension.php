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
            new \Twig_SimpleFunction('documentLink', [$this, 'documentLinkFunction'])
        ];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('currency', [$this, 'currencyFilter']),
        ];
    }

    public function documentLinkFunction($_description, $entity, $id, $hash)
    {
        $description = \str_replace(' ', '', \ucwords($_description));
        return sprintf('/check/%s/%s/%s/hash/%s', $description, $entity, $id, $hash);
    }

    public function currencyFilter($currency)
    {
        if ($currency == 'EUR') return '€';
        if ($currency == 'GBP') return '£';
        return $currency;
    }
}