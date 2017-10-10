<?php

namespace App\Repositories\SsoTicket;

interface SsoTicketInterface
{
    public function create($ssoTicket);

    public function createUniqueTicketSecret();
}
