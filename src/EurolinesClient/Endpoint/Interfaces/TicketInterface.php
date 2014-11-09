<?php

namespace EurolinesClient\Endpoint\Interfaces;

use EurolinesClient\Data\Interfaces\TicketInterface as TicketDataInterface;
use EurolinesClient\Data\Interfaces\TicketCancelInterface as TicketCancelDataInterface;
use EurolinesClient\Data\Interfaces\TicketPdfInterface as TicketPdfDataInterface;


interface TicketInterface
{
    /**
     * Get ticket by reference number
     *
     * @param $referenceNumber
     *
     * @return mixed
     */
    public function get($referenceNumber);

    /**
     * Purchase a ticket
     *
     * @param TicketDataInterface $ticket
     *
     * @return array
     */
    public function purchase(TicketDataInterface $ticket);

    /**
     * Cancel a Ticket
     *
     * @param TicketCancelDataInterface $ticket
     *
     * @return array
     */
    public function cancel(TicketCancelDataInterface $ticket);

    /**
     * Before doing a CancelTicket. You must at first GetCancelTariffs.
     * If some error occurs you can use method ReverseCancelTicket to delete cancel.
     *
     * @param $referenceNumber
     *
     * @return mixed
     */
    public function cancelTariffs($referenceNumber, $cancelOnlyBackWay = false);

    /**
     * Get PDF ticket created according to template
     *
     * @param TicketPdfDataInterface $ticket
     *
     * @return array
     */
    public function getPdf(TicketPdfDataInterface $ticket);

    /**
     * Get all data for printing of ticket
     *
     * @param $referenceNumber
     *
     * @return mixed
     */
    public function getPrintData($referenceNumber);

    /**
     * Confirmation, that ticket was successfully printed. It writes who, when and what was printed.
     *
     * @param $referenceNumber
     *
     * @return mixed
     */
    public function confirmPrint($referenceNumber);

    /**
     * Return complete information about sale
     *
     * @param $saleId
     *
     * @return mixed
     */
    public function getSale($saleId);

    /**
     * Get Number by Sequence
     *
     * @param int $lineId
     * @param \stcClass $template
     *
     * @return mixed
     */
    public function getNumberBySequence($lineId, $template);

    /**
     * Save ticket number
     *
     * @param $referenceNumber
     * @param $template
     * @param $ticketNumber
     * @return mixed
     */
    public function saveTicketNumber($referenceNumber, $template, $ticketNumber);
}