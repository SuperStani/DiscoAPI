<?php


namespace DiscoAPI\Core\Controllers;

use DiscoAPI\Core\Services\ElementsService;
use DiscoAPI\Core\Services\EventsService;

class APIController
{
    private ?string $action;

    private array $response;

    private EventsService $eventsService;

    private ElementsService $elementsService;

    public function __construct(EventsService $eventsService, ElementsService $elementsService)
    {
        $this->response = [
            "result" => false,
            "message" => "Bad request"
        ];
        $this->eventsService = $eventsService;
        $this->elementsService = $elementsService;
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
        if (isset($_POST['name']) && isset($_POST['status'])) {
            $this->elementsService->updateElement($_POST['name'], $_POST['status']);
            $this->response = [
                "result" => true,
                "message" => "Element has been successfully updated"
            ];
            return;
        }
        $this->response = [
            "result" => false,
            "message" => "Missing parameters from the request"
        ];
    }


    public function response(): void
    {
        echo json_encode($this->response);
    }
}