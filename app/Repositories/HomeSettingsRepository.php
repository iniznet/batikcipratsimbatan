<?php

namespace App\Repositories;

use App\Models\Homepage\Settings;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\HomeSettingsRepository as HomeSettingsRepositoryContract;
use Awcodes\Curator\Models\Media;

class HomeSettingsRepository extends BaseRepository implements HomeSettingsRepositoryContract
{
    public function __construct(Settings $model)
    {
        parent::__construct($model);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->model->where('key', 'home_' . $key)->first()?->value ?? $default;
    }

    public function getFeatureds(): array
    {
        $featuredIds = $this->model->where('key', 'home_featured_images')->first()?->value ?? null;

        if (!$featuredIds) {
            return [];
        }

        $featureds = collect($featuredIds)->map(function ($id) {
            return Media::find($id);
        });

        return $featureds->toArray();
    }

    public function getAboutImage(): ?Media
    {
        $aboutImageId = $this->model->where('key', 'home_about_image')->first()?->value ?? null;

        if (!$aboutImageId) {
            return null;
        }

        return Media::find($aboutImageId);
    }
}
