<?php
/**
 * Author: Thomas Wiener
 * Author Website: http://wiener.io
 * Date: 18/09/14 15:20
 *
 * @category None
 * @package  EurolinesClient\Endpoint
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
namespace EurolinesClient\Endpoint;

use EurolinesClient\Data\Interfaces\TicketInterface as TicketDataInterface;
use EurolinesClient\Data\Interfaces\TicketCancelInterface as TicketCancelDataInterface;
use EurolinesClient\Data\Interfaces\TicketPdfInterface as TicketPdfDataInterface;
use EurolinesClient\Endpoint\Interfaces\TicketInterface;

/**
 * Class Ticket
 *
 * @category None
 * @package  EurolinesClient\Endpoint
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
class Ticket extends AbstractEndpoint implements TicketInterface
{
    const METHOD_GET                  = 'GetTicket';
    const METHOD_SAVE_SALE            = 'SaveSale';
    const METHOD_CANCEL               = 'CancelTicket';
    const METHOD_GET_PDF              = 'GetPDFTicket';
    const METHOD_GET_PRINT_DATA       = 'GetPrintData';
    const METHOD_CONFIRM_PRINT        = 'ConfirmPrint';
    const METHOD_GET_SALE             = 'GetSale';
    const METHOD_GET_TICKET_NO_BY_SEQ = 'GetTicketNumberBySequence';
    const METHOD_SAVE_TICKET_NO       = 'SaveTicketNumber';
    const METHOD_GET_CANCEL_TARIFFS   = 'GetCancelTariffs';

    /**
     * Purchase a ticket
     *
     * @param TicketDataInterface $ticket
     *
     * @return mixed
     */
    public function purchase(TicketDataInterface $ticket)
    {
        $data = [self::METHOD_SAVE_SALE => $ticket->asArray()];

        return $this->doRequest(self::METHOD_SAVE_SALE, $data);
    }

    /**
     * Cancel a Ticket
     *
     * @param TicketCancelDataInterface $ticket
     *
     * @return mixed
     */
    public function cancel(TicketCancelDataInterface $ticket)
    {
        $data = [self::METHOD_CANCEL => $ticket->getTicketCancelAsArray()];

        return $this->doRequest(self::METHOD_CANCEL, $data);
    }

    /**
     * Before doing a CancelTicket. You must at first GetCancelTariffs.
     * If some error occurs you can use method ReverseCancelTicket to delete cancel.
     *
     * @param $referenceNumber
     *
     * @return mixed
     */
    public function cancelTariffs($referenceNumber, $cancelOnlyBackWay = false)
    {
        $data = [self::METHOD_GET_CANCEL_TARIFFS => [
            'referenceNumber'   => $referenceNumber,
            'cancelOnlyBackWay' => $cancelOnlyBackWay
        ]];

        return $this->doRequest(self::METHOD_GET_CANCEL_TARIFFS, $data);
    }

    /**
     * Get PDF ticket created according to template
     *
     * @param TicketPdfDataInterface $ticket
     *
     * @return array
     */
    public function getPdf(TicketPdfDataInterface $ticket)
    {
        $data = [self::METHOD_GET_PDF => $ticket->getTicketPdfAsArray()];

        return $this->doRequest(self::METHOD_GET_PDF, $data);
    }

    /**
     * Get all data for printing of ticket
     *
     * @param $referenceNumber
     *
     * @return mixed
     */
    public function getPrintData($referenceNumber)
    {
        $data = [self::METHOD_GET_PRINT_DATA => ['referenceNumber' => $referenceNumber]];

        return $this->doRequest(self::METHOD_GET_PRINT_DATA, $data);
    }


    /**
     * Confirmation, that ticket was successfully printed. It writes who, when and what was printed.
     *
     * @param $referenceNumber
     *
     * @return mixed
     */
    public function confirmPrint($referenceNumber)
    {
        $data = [self::METHOD_CONFIRM_PRINT => ['referenceNumber' => $referenceNumber]];

        return $this->doRequest(self::METHOD_CONFIRM_PRINT, $data);
    }


    /**
     * Get ticket by reference number
     *
     * @param $referenceNumber
     *
     * @return mixed
     */
    public function get($referenceNumber)
    {
        $data = [self::METHOD_GET => ['referenceNumber' => $referenceNumber]];

        return $this->doRequest(self::METHOD_GET, $data);
    }

    /**
     * Return complete information about sale
     *
     * @param $saleId
     *
     * @return mixed
     */
    public function getSale($saleId)
    {
        $data = [self::METHOD_GET_SALE => ['saleId' => $saleId]];

        return $this->doRequest(self::METHOD_GET_SALE, $data);
    }

    /**
     * Get Number by Sequence
     *
     * @param int $lineId
     * @param \stcClass $template
     *
     * @return mixed
     */
    public function getNumberBySequence($lineId, $template)
    {
        $data = [self::METHOD_GET_TICKET_NO_BY_SEQ => [
            'lineID'        => $lineId,
            'printTemplate' => $template,
        ]];

        return $this->doRequest(self::METHOD_GET_TICKET_NO_BY_SEQ, $data);
    }

    /**
     * Save ticket number
     *
     * @param $referenceNumber
     * @param $template
     * @param $ticketNumber
     * @return mixed
     */
    public function saveTicketNumber($referenceNumber, $template, $ticketNumber = null)
    {
        $data = [self::METHOD_SAVE_TICKET_NO => [
            'referenceNumber' => $referenceNumber,
            'printTemplate'   => $template,
            'ticketNumber'    => $ticketNumber
        ]];

        return $this->doRequest(self::METHOD_SAVE_TICKET_NO, $data);
    }
}
