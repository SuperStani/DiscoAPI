<?php

namespace DiscoAPI\Core\Services;

use DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\ORM\Entities\Element;
use DiscoAPI\Core\ORM\Repositories\ElementsRepository;

class ElementsService
{
    private ElementsRepository $elementsRepository;

    private LoggerInterface $logger;

    private static string $elementsRawJsonPath = __DIR__ . "/../../assets/common/elements.json";

    public function __construct(LoggerInterface $logger, ElementsRepository $elementsRepository) {
        $this->logger = $logger;
        $this->elementsRepository = $elementsRepository;
    }

    public function updateElement(array $data): bool
    {
        $element = new Element();
        $element->buildFromArray($data);
        return $this->elementsRepository->updateElement($element);
    }

    public function updateElementsFile(): bool
    {
        $offset = 0;
        $limit = 20000;
        $data = [];
        do {
            $elements = $this->elementsRepository->getElements($offset, $limit);
            while($element = $elements->fetch(\PDO::FETCH_ASSOC)) {
                $data[] = $element;
            }
            $offset += $limit;
        } while ($elements->rowCount() > 0);
        return file_put_contents(self::$elementsRawJsonPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getElementsRaw()
    {
        return file_get_contents(self::$elementsRawJsonPath);
    }
}