<?php

namespace App\Services;

use App\Models\Game;
use App\Models\User;
use App\Models\Community;

class GlobalSearchService
{
    protected array $models = [
        Game::class,
        User::class,
        Community::class,
    ];
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function search(string $term): array
    {
        $results = [];
        $term = trim($term);
        $lowerTerm = strtolower($term);
        
        foreach ($this->models as $model) {
            $items = $model::whereRaw('LOWER(name) LIKE ?', ["%{$lowerTerm}%"])->get();
            foreach ($items as $item) {
                if (property_exists($item, 'slug')) {
                    $url = strtolower(class_basename($model)) . '/' . $item->slug;
                } else {
                    $url = strtolower(class_basename($model)) . '/' . $item->id;
                }
                $results[] = [
                    'type' => class_basename($model),
                    'title' => $item->name,
                    'url' => $url,
                ];
            }
        }

        return $results;
    }
}
