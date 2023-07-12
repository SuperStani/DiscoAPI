<?php


namespace DiscoAPI\Core\Controllers;

use DiscoAPI\Core\Services\ElementsService;
use DiscoAPI\Core\Services\EventsService;
use DiscoAPI\Core\Services\RegistersService;
use DiscoAPI\Core\Services\GeneralSettingsService;

class APIController
{
    private ?string $action;

    private array $response;

    private EventsService $eventsService;

    private ElementsService $elementsService;

    private RegistersService $registersService;

    private GeneralSettingsService $generalSettingsService;

    public function __construct(EventsService $eventsService, ElementsService $elementsService, RegistersService $registersService, GeneralSettingsService $generalSettingsService)
    {
        $this->response = [
            "result" => false,
            "message" => "Bad request"
        ];
        $this->eventsService = $eventsService;
        $this->elementsService = $elementsService;
        $this->registersService = $registersService;
        $this->generalSettingsService = $generalSettingsService;
    }

    public function init()
    {
        header("Content-Type: application/json");
        $this->action = $_GET['action'] ?? null;
    }

    public function process()
    {
        switch ($this->action) {
            case 'saveEvent':
                $this->saveEvent();
                break;
            case 'getEvents':
                $this->getEvents();
                break;
            case 'updateEvents':
                $this->updateEvents();
                break;
            case 'deleteEvent':
                $this->deleteEvent();
                break;
            case 'updateElement':
                $this->updateElement();
                break;
            case 'updateElementsFile':
                $this->updateElementsFile();
                break;
            case 'getElements':
                $this->getElements();
                break;
            case 'updateRegister':
                $this->updateRegister();
                break;
            case 'updateRegistersFile':
                $this->updateRegistersFile();
                break;
            case 'getRegisters':
                $this->getRegisters();
                break;
            case 'updateSettings':
                $this->updateSettings();
                break;
        }
    }

    private function saveEvent()
    {
        $this->response['message'] = "L'evento non è stato salvato, riprova!";
        if (isset($_POST['event'])) {
            $data = json_decode($_POST['event'], true);
            if (!empty($data['title']) && !empty($data['description']) && !empty($data['price']) && !empty($data['airDate'])) {
                if ($this->eventsService->saveEvent($data)) {
                    $this->response = [
                        "result" => true,
                        "message" => "L'evento è stato salvato con successo!"
                    ];
                    $this->eventsService->updateEventsFile();
                }
            } else {
                $this->response['message'] = "Mancano dei parametri dell'evento, riprova!";
            }

        }
    }

    private function getEvents()
    {
        $this->response = [
            "result" => true,
            "events" => json_decode($this->eventsService->getEventsRaw())
        ];
    }

    private function updateEvents()
    {
        if ($this->eventsService->updateEventsFile()) {
            $this->response = [
                "result" => true,
                "message" => "Events has been successfully updated"
            ];
        }
    }

    public function deleteEvent()
    {
        if (isset($_GET['id'])) {
            if ($this->eventsService->deleteEvent($_GET['id'])) {
                $this->response = [
                    "result" => true,
                    "message" => "L'evento è stato eliminato!"
                ];
                $this->eventsService->updateEventsFile();
            }
        }
    }

    private function updateElementsFile() {
        if($this->elementsService->updateElementsFile()) {
            $this->response = [
                "result" => true,
                "message" => "Elements file has been successfully updated"
            ];
        }
    }

    private function updateElement()
    {
        $this->response['message'] = "Missing parameters from the request";
        if (isset($_POST['element'])) {
            $data = json_decode($_POST['element'], true);
            if(!empty($data['name']) && !empty($data['status']))
            {
                $this->elementsService->updateElement($data);
                $this->response = [
                    "result" => true,
                    "message" => "Element has been successfully updated"
                ];
            }
        }
    }

    private function getElements()
    {
        $this->response = [
            "result" => true,
            "events" => json_decode($this->elementsService->getElementsRaw())
        ];
    }

    private function updateRegistersFile() {
        if($this->registersService->updateRegistersFile()) {
            $this->response = [
                "result" => true,
                "message" => "Registers file has been successfully updated"
            ];
        }
    }

    private function updateRegister()
    {
        $this->response['message'] = "Missing parameters from the request";
        if (isset($_POST['register'])) {
            $data = json_decode($_POST['register'], true);
            if(!empty($data['id']) && !empty($data['status']))
            {
                $this->registersService->updateRegister($data);
                $this->response = [
                    "result" => true,
                    "message" => "Register has been successfully updated"
                ];
            }
        }
    }

    private function getRegisters()
    {
        $this->response = [
            "result" => true,
            "events" => json_decode($this->registersService->getRegistersRaw())
        ];
    }

    public function response(): void
    {
        echo json_encode($this->response);
    }

    private function updateSettings()
    {
        $this->response['message'] = "Missing parameters from the request";
        if (isset($_POST['settings'])) {
            //eviterei di fare un controllo con !empty, tanto non bisogna mai fare INSERT ma UPDATE nella table settings
            $data = json_decode($_POST['settings'], true);
             $this->generalSettingsService->updateSettings($data);
             $this->response = [
                 "result" => true,
                 "message" => "Settings has been successfully updated"
              ];
        }
    }

}