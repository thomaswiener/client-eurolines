<?php
/**
 * Author: Thomas Wiener
 * Author Website: http://wiener.io
 * Date: 18/09/14 15:20
 *
 * @category None
 * @package  Rocket\Bus\Europe\SharedBundle\Component\BookingEngine\Infobus\Service
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */

namespace EurolinesClient\Endpoint;

use GuzzleHttp\Message\Response as GuzzleResponse;
use EurolinesClient\ClientInterface;
use EurolinesClient\Data\Response;
use stdClass;

/**
 * Class BaseService
 *
 * @category None
 * @package  Rocket\Bus\Europe\SharedBundle\Component\BookingEngine\Service
 * @author   Thomas Wiener <wiener.thomas@googlemail.com>
 * @license  rocket internet
 * @link     unknown
 */
abstract class AbstractEndpoint
{
    /**
     * @var \GuzzleHttp\ClientInterface Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $sessionName = 'ASP.NET_SessionId';

    protected $successCodes = array(
        'e0000_NoError',
        'e0009_TripSold'
    );

    protected $errorCodes  = array(
        'e0002_BadGetOnStop',
        'e0003_BadGetOffStop',
        'e0004_BadTicketTariffCode',
        'e0005_UnauthorizedTicketType',
        'e0006_ErrorBySavingPassenger',
        'e0007_ErrorByProcessingTicket',
        'e0008_TicketNumberWasAlreadyUsed',
        'e0009_TripSold',
        'e0010_BadDepartureBack',
        'e0011_SystemErrorBySavingTicketsFromDriver',
        'e0012_ErrorByIdentificationOfUser',
        'e0013_TicketNumberIsntInSeries',
        'e0014_BadTicketType',
        'e0015_SaleOnTripWasStopped',
        'e0016_ErrorByProcessingTicket_BadNumber',
        'e0017_ErrorByUpdatingTicket',
        'e0018_TicketNotAccessible',
        'e0019_BadDeparture',
        'e0020_BadBusStopCode',
        'e0021_MissingBusStop',
        'e0022_NotSupportedTicketType',
        'e0023_UsedSeatNumberThere',
        'e0024_UsedSeatNumberBack',
        'e0025_DepartureDateOutOfInterval',
        'e0026_DepartureDateBackOutOfInterval',
        'e0027_SaleOnTripWasClosed',
        'e0028_TicketMustBeConfirm',
        'e0029_TicketNotConfirmed',
        'e0030_BadTimeReservation',
        'e0031_ErrorBySavingReservation',
        'e0032_ErrorBySavingWebReservation',
        'e0033_BusFull1',
        'e0034_BusFull2',
        'e0035_BusFull3',
        'e0036_ErrorByWritingInvoiceNumber',
        'e0040_ErrorByGettingFreeSeatThere',
        'e0041_NoFreeSeatInBusThere',
        'e0042_ErrorByGettingFreeSeatBack',
        'e0043_NoFreeSeatInBusBack',
        'e0044_NotAllowedNumberOfTicketsForFamilyTariff',
        'e0045_NotAllowedSaleByFamilyTariff',
        'e0046_TicketsLimitExceeded',
        'e2001_UnexpectedError',
        'e2002_IncorrectNumberFormat',
        'e2003_DifferentCountTickets',
        'e2004_DifferentCurrencys',
        'e2005_MaxLoyaltyCountTicket',
        'e2006_MaxCountTicket',
        'e2007_NoAllowedTicketType',
        'e2008_ErrorByConnectingToDatabase',
        'e2009_PaymentVerificationFailed',
        'e2010_PaymentWritingToDBFailed',
        'e2011_ErrorByConnectingToCardAuthorizationService',
        'e2012_MaxCountTicketForFamillyTariff',
        'e2013_MaxOneTicketSet',
        'e2014_NoDeparturesFound',
        'e2015_NoTariffsFound',
        'e2016_CancelTicketAccessDenied',
        'e2017_WrongTimeForCancel',
        'e2018_WrongCancelTariff',
        'e2019_TicketAlreadyCancelled',
        'e2020_TicketNotCancelled',
        'e2021_TicketNumberNotFoundInTicketSet',
        'e2022_CanNotReverseCancelReservation',
        'e2023_CanNotReverseCancelSeatReservation',
        'e3001_UserNotLoggedIn',
        'e3002_GettingBusStopsForUserFailed',
        'e3003_GettingAllBusStopsFailed',
        'e3004_GettingSaleFailed',
        'e3005_NotImplemented',
        'e3006_SavingSaleFailedUnexpected',
        'e3007_TicketNotFound',
        'e3008_CancelingSaleFailedUnexpected',
        'e3009_GetPrintTemplatesFailedUnexpected',
        'e3010_GetTicketNumberBySequenceFailedUnexpected',
        'e3011_GetTicketFailedUnexpected',
        'e3012_WrongTicketNumber',
        'e3013_SaveTicketNumberFailedUnexpected',
        'e3014_GetReservationsFailedUnexpected',
        'e3015_ConfirmPrintFailedUnexpected',
        'e3016_CancelPrintFailedUnexpected',
        'e3017_ProcessReservationFailedUnexpected',
        'e3018_ReservationNotFound',
        'e3019_TicketNotHavePrintTemplate',
        'e3020_GetPrintDataFailedUnexpected',
        'e3021_PrintTemplateNotFound',
        'e3022_TicketNumberNotSet',
        'e3023_GetTariffsFailedUnexpected',
        'e3024_GetCancelTariffsFailedUnexpected',
        'e3025_GetTicketTypeByUserFailedUnexpected',
        'e3026_GetPaymentTypesFailedUnexpected',
        'e3027_SearchJourneyFailedUnexpected',
        'e3028_SearchAnotherDepartureFailedUnexpected',
        'e3029_ReverseCancelTicketFailedUnexpected',
        'e3030_ChangeTicketFailedUnexpected',
        'e3031_DriverTicketOnlyOneWay',
        'e3032_GettingAllCountriesFailed',
        'e3033_UnknownCurrencyCode',
        'e3034_TicketsCurrenciesDiffer',
        'e3035_BookingIsNotAllowedInThisMethod',
        'e3036_TicketIsNotValid',
        'e3037_OpenTicketWasBooked',
        'e3038_CheckOpenTicketFailedUnexpected',
        'e3039_SaveBookingFailedUnexpected',
        'e3040_WrongManualPrice',
        'e3041_SaveServiceFeeFailedUnexpected',
        'e3042_AlreadySaveServiceFee',
        'e3043_TicketMustBeConfirmed',
        'e3044_SearchJourneyLuggageFailedUnexpected',
        'e3045_SearchAnotherDepartureLuggageFailedUnexpected'
    );


    /**
     * Constructor
     *
     * @param ClientInterface $client The client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Do request
     *
     * @param $method
     * @param $data
     * @param bool $addHeaders
     * @return GuzzleResponse|Response
     */
    protected function doRequest($method, $data, $addHeaders = true)
    {
        $headers = array();
        if ($addHeaders) {
            $headers = $this->getHeaders();
        }
        $response = $this->client->request($method, $data, $headers);

        return $this->getResponse($response, $this->getResponseFieldName($method));
    }

    /**
     * Get the Response
     *
     * @param GuzzleResponse $response Response
     *
     * @return GuzzleResponse|Response
     */
    protected function getResponse($result, $field)
    {
        $response = new Response();
        $response->setSuccess(false);

        if ($result->responseStd instanceof \stdClass) {
            $response->setData($result->responseStd);
            $response->setSessionId($this->getSessionIdFromResult($result));

            if (in_array($result->responseStd->$field, $this->successCodes)) {
                $response->setSuccess(true);
            }
        }

        return $response;
    }

    /**
     * Convert Response to stdClass
     *
     * @param GuzzleResponse $response Response
     *
     * @return mixed
     */
    protected function convertXmlResponseToStdClass(GuzzleResponse $response)
    {
        try {
            $xml = $response->getBody()->__toString();
            $simpleXml = simplexml_load_string($xml);
            $data = json_decode(json_encode($simpleXml));
        } catch (\Exception $ex) {
            return null;
        }

        return $data;
    }

    /**
     * @param $result
     * @return null
     */
    protected function getSessionIdFromResult($result)
    {
        $cookies = $result->cookies;
        $cookieName = 'ASP.NET_SessionId';

        if (isset($cookies[$cookieName]) && isset($cookies[$cookieName][0])) {
            return $cookies[$cookieName][0];
        }

        return null;
    }

    /**
     * @return string
     */
    public function getSessionName()
    {
        return $this->sessionName;
    }

    /**
     * @param string $sessionName
     *
     * @return $this
     */
    public function setSessionName($sessionName)
    {
        $this->sessionName = $sessionName;

        return $this;
    }

    public function getHeaders()
    {
        $headers = [];
        if (isset($_SESSION[$this->sessionName])) {
            $headers  = ['cookies' => [$this->sessionName => $_SESSION[$this->sessionName]]];
        }

        return $headers;
    }

    protected function getResponseFieldName($method)
    {
        return sprintf('%sResult', $method);
    }


} 