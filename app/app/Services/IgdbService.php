<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class IgdbService
{
    private string $clientId;
    private string $clientSecret;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->clientId = config('services.igdb.client_id');
        $this->clientSecret = config('services.igdb.client_secret');
    }

    private function getToken(): string
    {
      return Cache::remember('igbd_token', now()->addDays(50), function () {
        $response = Http::post('https://id.twitch.tv/auth2/token', [
          'client_id' => $this->clientId,
          'client_secret' => $this->clientSecret,
          'grant_type' => 'client_credentials',
        ]);
        return $response->json()['access_token'];
      });
    }

    private function query(string $endpoint, string $body): array
    {
      $response = Http::withHeaders([
        'Client-ID' => $this->clientId,
        'Authorization' => 'Bearer ' . $this->getToken(),
      ])->withBody($body, 'text/plain')
      ->post('https://api.igdb.com/v4/' . $endpoint);
      return $response->json() ?? [];
    }

    public function searchGames(string $term, int $limit = 20): array
    {
      return $this->query('games', "search \"{$term}\"; fields name, cover.url, first_release_date, rating, slug; limit {$limit};");
    }

    public function find(int $igbdId): array
    {
      $results = $this->query('games', "where id = {$igbdId}; fields name, cover.url, first_release_date, rating, slug;limit 1;");
      return $results[0] ?? [];
    }

    public function popular(int $limit = 20): array
    {
      return $this->query('games', "fields name, cover.url, first_release_date, rating, slug; sort popularity desc; limit {$limit};");
    }
}
