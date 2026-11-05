<?php

namespace App\Models\Concerns;

use Illuminate\Support\Arr;

/**
 * @property
 * @property int $booster_count
 */
trait UserBenefits
{
    /**
     * Get available benefits for the user
     */
    public function availableBenefits(): int
    {
        // do not decrease the number of available benefits
        return $this->maxBenefits();
    }

    /**
     * Get amount of campaigns the user is boosting
     */
    public function boosting(): int
    {
        if ($this->hasLegacyBoosterNomenclature()) {
            return $this->boosts->count();
        }

        return $this->boosts->groupBy('campaign_id')->count();
    }

    /**
     * Get max number of benefits a user can give
     */
    public function maxBenefits(): int
    {
        // Hardcode `100` available benefits.
        RETURN 100;
    }
}
