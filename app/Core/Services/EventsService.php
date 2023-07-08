<?php


namespace DiscoAPI\Core\Services;


use DiscoAPI\Configs\GeneralConfigurations;
use DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\ORM\Entities\Event;
use DiscoAPI\Core\ORM\Repositories\EventsRepository;

class EventsService
{
    private EventsRepository $eventsRepository;

    private LoggerInterface $logger;

    private static string $eventsRawJsonPath = __DIR__ . "/../../assets/common/events.json";

    public function __construct(LoggerInterface $logger, EventsRepository $eventsRepository)
    {
        $this->logger = $logger;
        $this->eventsRepository = $eventsRepository;
    }

    public function saveEvent(array $data): ?int
    {
        $hasPoster = isset($_FILES['poster']['tmp_name']);
        $posterName = time() . ".jpg";
        if (empty($data['id']) && !$hasPoster) {
            $this->logger->error("Save event failed 1", json_encode($data));
            return null;
        } elseif (
            $hasPoster &&
            !move_uploaded_file($_FILES['poster']['tmp_name'], GeneralConfigurations::POSTER_PATH . $posterName)
        ) {
            $this->logger->error("Save event failed 2", json_encode($data));
            return null;
        }
        $event = new Event();
        $event->setTitle($data['title']);
        $event->setId(!empty($data['id']) ? $data['id'] : null);
        $event->setDescription($data['description']);
        $event->setPosterId($hasPoster ? $posterName : null);
        $event->setAirDate($data['airDate']);
        $event->setPrice($data['price']);
        return $this->eventsRepository->saveEvent($event);
    }

    public function getEventsRaw()
    {
        return file_get_contents(self::$eventsRawJsonPath);
    }

    public function updateEventsFile(): bool
    {
        $offset = 0;
        $limit = 20000;
        $data = [];
        do {
            $events = $this->eventsRepository->getEvents($offset, $limit);
            foreach ($events as $rawEvent) {
                $event = new Event($rawEvent['id'], $rawEvent['title'], $rawEvent['description'], $rawEvent['air_date'], $rawEvent['poster_id'], $rawEvent['price']);
                $data[] = [
                    "id" => $event->getId(),
                    "title" => $event->getTitle(),
                    "description" => $event->getDescription(),
                    "air_date" => $event->getAirDate(),
                    "poster_id" => $event->getPosterId(),
                    "price" => $event->getPrice()
                ];
            }
            $offset += $limit;
        } while ($events !== null && $events->rowCount() > 0);
        return file_put_contents(self::$eventsRawJsonPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function deleteEvent(int $id): bool
    {
        return $this->eventsRepository->deleteEvent($id) !== null;
    }
}