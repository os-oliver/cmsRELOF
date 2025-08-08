<?php
namespace App;

use MeiliSearch\Client;
use Dotenv\Dotenv;

class SearchController
{
    private Client $client;
    private $index;

    public function __construct()
    {
        $env = Dotenv::createImmutable(__DIR__ . '/../');
        $env->load();

        $this->client = new Client($_ENV['MEILI_HOST'], $_ENV['MEILI_KEY'] ?? null);
        $this->index = $this->client->index($_ENV['MEILI_INDEX']);
    }

    /** 
     * Uvezi ili ažuriraj niz dokumenata:
     * svaki dokument je array sa bar ['id','title','body','content_type'] 
     */
    public function importDocuments(array $docs): void
    {
        $this->index->addDocuments($docs);
    }

    /**
     * Traži po indeksu i vraća niz rezultata
     */
    public function search(string $query, int $limit = 20): array
    {
        $result = $this->index->search($query, [
            'limit' => $limit,
            'attributesToHighlight' => ['title', 'body']
        ]);
        return $result['hits'];
    }
}
