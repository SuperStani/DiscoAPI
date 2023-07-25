<?php

namespace DiscoAPI\Core\Services;

use DiscoAPI\Configs\GeneralConfigurations;
use DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\ORM\Entities\Cocktail;
use DiscoAPI\Core\ORM\Repositories\CocktailsRepository;

class CocktailsService
{
    private CocktailsRepository $cocktailsRepository;
    private LoggerInterface $logger;
    private static string $cocktailsRawJsonPath = __DIR__ . "/../../assets/common/cocktails.json";

    public function __construct(LoggerInterface $logger, CocktailsRepository $cocktailsRepository)
    {
        $this->logger = $logger;
        $this->cocktailsRepository = $cocktailsRepository;
    }

    public function saveCocktail(array $data): ?int
    {
        $hasImg = isset($_FILES['img']['tmp_name']);
        $imgName = time() . ".jpg";
        if (empty($data['id']) && !$hasImg) {
            $this->logger->error("Save cocktail failed 1", json_encode($data));
            return null;
        } elseif (
            $hasImg &&
            !move_uploaded_file($_FILES['img']['tmp_name'], GeneralConfigurations::IMG_PATH . $imgName)
        ) {
            $this->logger->error("Save cocktail failed 2", json_encode($data));
            return null;
        }
        $cocktail = new Cocktail();
        $cocktail->setName($data['name']);
        $cocktail->setId(!empty($data['id']) ? $data['id'] : null);
        $cocktail->setPrice($data['price']);
        $cocktail->setQuantita($data['quantita']);
        $cocktail->setSconto($data['sconto']);
        $cocktail->setVendite($data['vendite']);
        $cocktail->setImg($hasImg ? $imgName : null);
        $cocktail->setDescrizione($data['descrizione']);
        return $this->cocktailsRepository->saveCocktail($cocktail);
    }

    public function getCocktailsRaw()
    {
        if(!file_exists(self::$cocktailsRawJsonPath)) {
            $this->updateCocktailsFile();
        }
        return file_get_contents(self::$cocktailsRawJsonPath);
    }

    public function updateCocktailsFile(): bool
    {
        $offset = 0;
        $limit = 20000;
        $data = [];
        do {
            $cocktails = $this->cocktailsRepository->getCocktails($offset, $limit);
            foreach($cocktails as $rawCocktail) {
                $cocktail = new Cocktail($rawCocktail['id'], $rawCocktail['name'], $rawCocktail['price'], $rawCocktail['quantita'], $rawCocktail['sconto'], $rawCocktail['vendite'], $rawCocktail['img'], $rawCocktail['descrizione']);
                $data[] = [
                    'id' => $cocktail->getId(),
                    'name' => $cocktail->getName(),
                    'price' => $cocktail->getPrice(),
                    'quantita' => $cocktail->getQuantita(),
                    'sconto' => $cocktail->getSconto(),
                    'vendite' => $cocktail->getVendite(),
                    'img' => $cocktail->getImg(),
                    'descrizione' => $cocktail->getDescrizione()
                ];
            }
            $offset += $limit;
        } while ($cocktails !== null && $cocktails->rowCount() > 0);
        return file_put_contents(self::$cocktailsRawJsonPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function deleteCocktail(int $id): bool
    {
        return $this->cocktailsRepository->deleteCocktail($id);
    }
}