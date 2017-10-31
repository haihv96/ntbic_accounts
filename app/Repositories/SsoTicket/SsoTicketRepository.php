<?php

namespace App\Repositories\SsoTicket;

use App\Repositories\BaseRepository;
use App\Models\SsoTicket;

class SsoTicketRepository extends BaseRepository implements SsoTicketInterface
{
    public function __construct(SsoTicket $ssoTicket)
    {
        parent::__construct($ssoTicket);
    }

    public function createUniqueTicketSecret()
    {
        do {
            $sso_ticket_secret = str_random(190);
        } while ($this->where("sso_ticket_secret", $sso_ticket_secret)->get()->isNotEmpty());

        return $sso_ticket_secret;
    }
}
