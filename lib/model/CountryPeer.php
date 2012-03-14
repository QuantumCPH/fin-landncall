<?php

class CountryPeer extends BaseCountryPeer
{
     static public function getSortedCountries() {
        $c = new Criteria();
         $c->addAnd(CountryPeer::ID,65);
        $c->addAscendingOrderByColumn(CountryPeer::NAME);
        $rs = CountryPeer::doSelect($c);
        return $rs;
    }
}
