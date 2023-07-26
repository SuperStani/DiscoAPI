<?php


namespace DiscoAPI\Core\Controllers;

use DiscoAPI\Core\Services\ElementsService;
use DiscoAPI\Core\Services\EventsService;
use DiscoAPI\Core\Services\NavbarService;
use DiscoAPI\Core\Services\RegistersService;
use DiscoAPI\Core\Services\UsersService;

class APIController
{
    private ?string $action;

    private array $response;

    private EventsService $eventsService;

    private ElementsService $elementsService;

    private RegistersService $registersService;

    private NavbarService $navbarService;

    private UsersService $usersService;

    public function __construct(EventsService $eventsService, ElementsService $elementsService, RegistersService $registersService, NavbarService $navbarService, UsersService $usersService)
    {
        $this->response = [
            "result" => false,
            "message" => "Bad request"
        ];
        $this->eventsService = $eventsService;
        $this->elementsService = $elementsService;
        $this->registersService = $registersService;
        $this->navbarService = $navbarService;
        $this->usersService = $usersService;
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
            case 'updateNavbarJson':
                $this->updateNavbarJson();
                break;
            case 'getNavbarJson':
                $this->getNavbarJson();
                break;
            case 'updateUserStatus':
                $this->updateUserStatus();
                break;
            case 'updateUserInfo':
                $this->updateUserInfo();
                break;
            case 'getUsers':
                $this->getUsers();
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
            if(!empty($data['name']) && isset($data['status']))
            {
                $this->elementsService->updateElement($data);
                $file_update = $this->elementsService->updateElementsFile();
                if(!$file_update) {
                    $this->response['message'] = 'Error updating JSON file';
                    return;
                }
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
            "elements" => json_decode($this->elementsService->getElementsRaw())
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
            if(!empty($data['id']) && isset($data['status']))
            {
                $this->registersService->updateRegister($data);
                /*$file_update = $this->registersService->updateRegistersFile();
                if(!$file_update) {
                    $this->response['message'] = 'Error updating JSON file';
                    return;
                }*/
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
            "registers" => json_decode($this->registersService->getRegistersRaw())
        ];
    }

    private function updateNavbarJson()
    {
        $this->response['message'] = "Missing parameters from the request";
        if(isset($_POST['navbar'])) {
            $data = json_decode($_POST['navbar'], true);
            # Verifica che il JSON sia valido
            if($data !== null) {
                if($this->navbarService->updateNavbarJson($_POST['navbar'])) {
                    $this->response = [
                        "result" => true,
                        "message" => "Navbar successfully updated"
                    ];
                } else {
                    $this->response['message'] = "Couldn't write to file";
                }
            }
        }
    }

    private function getNavbarJson()
    {
        $json = $this->navbarService->getNavbarJson();
        $this->response = [
            'result' => true,
            'navbar' => $json
        ];
    }

    private function updateUserStatus()
    {
        $this->response['message'] = "Missing parameters from the request";
        if (isset($_POST['user'])) {
            $data = json_decode($_POST['user'], true);
            if(isset($data['id']) && isset($data['status']))
            {
                $this->usersService->updateUserStatus($data);
                $this->response = [
                    "result" => true,
                    "message" => "User has been successfully updated"
                ];
            }
        }
    }

    private function updateUserInfo()
    {
        $this->response['message'] = "Missing parameters from the request";
        if (isset($_POST['user'])) {
            $data = json_decode($_POST['user'], true);
            if(isset($data['id']))
            {
                if($this->usersService->updateUserInfo($data)) {
                    $this->response = [
                        "result" => true,
                        "message" => "User has been successfully updated"
                    ];
                }
            }
        }
    }

    private function getUsers()
    {
        $this->response = [
            'result' => true,
            'users' => $this->usersService->getUsers()
        ];
    }

    public function response(): void
    {
        echo json_encode($this->response);
    }
}