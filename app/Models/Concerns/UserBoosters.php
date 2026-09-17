<?php

namespace App\Models\Concerns;

use App\Models\Pledge;
use Illuminate\Support\Arr;

/**
 * @property
 * @property int $booster_count
 */
trait UserBoosters
{
    /**
     * Get available boosts for the user
     */
    public function availableBoosts(): int {
        return 100;
    }

    /**
     * Get amount of campaigns the user is boosting
     */
    public function boosting(): int
    {
        if ($this->hasBoosterNomenclature()) {
            return $this->boosts->count();
        }

        return $this->boosts->groupBy('campaign_id')->count();
    }

    /**
     * Get max number of boosts a user can give
     */
    public function maxBoosts(): int {
        return 100;
    }
}
