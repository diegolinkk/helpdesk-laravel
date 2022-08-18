<?php

namespace App\Services;
use Illuminate\Support\Collection;

class PriorizeTech
{
    static function priorizeByLessActiveTickets(Collection $techList)
    {
        //add field qtdTickets 
        foreach($techList as  $tech)
        {
            $tech['qtdTickets'] = $tech->tickets->where('finished',false)->count();
        }

        //order list by less qtdTickets
        return $techList->sortBy('qtdTickets');
        
    }
}