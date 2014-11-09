<?php

namespace EurolinesClient\Data\Interfaces;

interface TicketPdfInterface extends BaseInterface
{
    /**
     * Get ticket pdf as array
     *
     * @return mixed
     */
    public function getTicketPdfAsArray();
} 