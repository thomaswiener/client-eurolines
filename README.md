## Eurolines Client
======

Sample Code

```php
$loader = require_once __DIR__ . "/./vendor/autoload.php";

$config = array(
    'wsdl'     => 'http://rezervari.eurolines.ro/emlines_api/api.asmx?WSDL',
    'username' => 'username',
    'password' => 'PA$$W0RD'
);

$originCode      = 'BUC'; //Bucuresti
$destinationCode = 'MUN'; //Munich

$client          = new \EurolinesClient\Client($config, 'log');
$securityService = new \EurolinesClient\Endpoint\Security($client);
$stationService  = new \EurolinesClient\Endpoint\Station($client);
$journeyService  = new \EurolinesClient\Endpoint\Journey($client);
$ticketService   = new \EurolinesClient\Endpoint\Ticket($client);

session_start();

$user = new \EurolinesClient\Data\User();
$user
    ->setUsername($config['username'])
    ->setPassword($config['password'])
    ->setLanguageCode('en');

//====================
//login
//====================
$response = $securityService->login($user);

//set session id
$_SESSION['ASP.NET_SessionId'] = $response->getSessionId();

//check if logged in
$response = $securityService->isLoggedIn();
if (!$response->getData()->IsLoggedInResult) {
    echo 'not logged in'; exit();
}

//====================
//get stations
//====================
$response = $stationService->getAll();

foreach ($response->getData()->busStopCollection->Stop as $stationService) {
    if ($stationService->Code == $originCode) {
        $busStopFrom = $stationService;
    }
    if ($stationService->Code == $destinationCode) {
        $busStopTo = $stationService;
    }
}

//====================
//search journeys
//====================
$journeySearchData = new \EurolinesClient\Data\JourneySearch();
$journeySearchData
    ->setJourneyType(EurolinesClient\Data\JourneySearch::TYPE_ONE_WAY)
    ->setBusStopCodeFrom($busStopFrom->Code)
    ->setBusStopCodeTo($busStopTo->Code)
    ->setDepartureDate((new \DateTime())->setDate(2014, 12, 5))
    #->setBusStopCodeBackFrom($busStopTo->Code)
    #->setBusStopCodeBackTo($busStopFrom->Code)
    #->setDepartureBackDate((new \DateTime())->setDate(2014, 12, 20))
    ->setSearchInterval(3);
$response = $journeyService->search($journeySearchData);

//select first leg (trip)
foreach ($response->getData()->journeyCollection->ArrayOfLeg as $leg) {
    break;
}
//====================
//get templates of leg
//====================
if ($leg->FreePlaces == 0) {
    echo "bus fully booked"; exit();
}

$response = $journeyService->getTemplatesByLineId($leg->LineId);
$template = $response->getData()->printTemplateCollection->PrintTemplate[1];
$template = json_decode(json_encode($template), true);
#$template['NumberingType'] = 'Sequence';
//====================
//get tariff of leg
//====================
$journeyData = new \EurolinesClient\Data\Journey();
foreach ($leg as $fieldName => $value) {
    $method = sprintf('set%s', $fieldName);
    if ($value instanceof \stdClass) {
        $value = json_decode(json_encode($value), true);
    }
    $journeyData->$method($value);
}
$response = $journeyService->getTariff($journeyData);

//===============
//purchase ticket
//===============
//get regular price for an adult
foreach ($response->getData()->priceCollection->Price as $price) {
    if ($price->TariffCode == 'EURv01') {
        break;
    }
}
//set price object
$priceData = new \EurolinesClient\Data\Price();
foreach ($price as $fieldName => $value) {
    $method = sprintf('set%s', $fieldName);
    if ($value instanceof \stdClass) {
        $value = json_decode(json_encode($value), true);
    }
    $priceData->$method($value);
}
//set passenger object
$passengerData1 = new \EurolinesClient\Data\Passenger();
$passengerData1->setFirstName('John');
$passengerData1->setLastName('Doe');
$passengerData1->setStreet('Chausseestrasse 123');
$passengerData1->setCity('Berlin');
$passengerData1->setCountry('Germany');
$passengerData1->setPhoneNumber('+491711234567');
$passengerData1->setZipCode('10001');
$passengerData1->setBirthDate('01/01/1990');
$passengerData1->setNote('');
$passengerData1->setPrice(0);
$passengerData1->setPassengerId(0);
$passengerData1->setEmail('asdf@asdfd.de');
$passengerData1->setTax(0);
$passengerData1->setPassport('asdf');

//set passenger object
/*$passengerData2 = new \EurolinesClient\Data\Passenger();
$passengerData2->setFirstName('Jane');
$passengerData2->setLastName('Doe');
$passengerData2->setStreet('Chausseestrasse 123');
$passengerData2->setCity('Berlin');
$passengerData2->setCountry('Germany');
$passengerData2->setPhoneNumber('+491711234567');
$passengerData2->setZipCode('10001');
$passengerData2->setBirthDate('03/02/1990');
$passengerData2->setNote('');
$passengerData2->setPrice(0);
$passengerData2->setPassengerId(0);
$passengerData2->setEmail('asdf@aadfsdsdfd.de');
$passengerData2->setTax(0);
$passengerData2->setPassport('asdf');*/

//set ticket object
$ticketData = new \EurolinesClient\Data\Ticket();
$ticketData->setTicketType(EurolinesClient\Data\Ticket::TICKET_TYPE_SELL);
$ticketData->setJourneyType(EurolinesClient\Data\JourneySearch::TYPE_ONE_WAY);
$ticketData->addJourney($journeyData);
$ticketData->addPassenger($passengerData1);
#$ticketData->addPassenger($passengerData2);
$ticketData->addPrice($priceData);
#$ticketData->addPrice($priceData);
$ticketData->setInvoiceNumber('');
//call purchase
$response = $ticketService->purchase($ticketData);
$sale = $response->getData()->Sale;
//================
//obtain ticket no
//================
$response = $ticketService->saveTicketNumber($sale->SaleId, $template, ''); //for every passenger and every leg
$ticketNumber = $response->getData()->ticketNumber;
//================
//get sale
//================
$response = $ticketService->getSale($sale->SaleId);
//================
//get print data
//================
$response = $ticketService->getPrintData($sale->SaleId);
//================
//confirm print
//================
//$response = $ticketService->confirmPrint($sale->SaleId);
//================
//cancel tariffs
//================
$tariffs = [];
foreach ($sale->Passengers as $passenger) {
    foreach ($passenger->Tickets as $ticket) {
        $tariffs[$ticket->TicketId] = $ticketService->cancelTariffs($ticket->TicketId);
    }
}
//================
//cancel ticket
//================
foreach ($tariffs as $ticketId => $tariffCollection) {
    $tariff = $tariffCollection->getData()->priceCollection->Price[1];
    $ticketData = new \EurolinesClient\Data\Ticket();
    $ticketData->setReferenceNumber($sale->SaleId);
    $ticketData->setTicketNumber($ticketNumber);
    $ticketData->setTariffId($tariff->TariffId);
    $ticketData->setCancelOnlyBackWay(false);
    $response = $ticketService->cancel($ticketData);
}

//======
//logout
//======
$response = $securityService->logout();
//=============
//is logged out
//=============
$response = $securityService->isLoggedIn();
if ($response->getData()->IsLoggedInResult) {
    echo 'error logging out'; exit();
}

```