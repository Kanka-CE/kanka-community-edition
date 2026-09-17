<?php

namespace Database\Seeders;

use App\Models\EntityType;
use Illuminate\Database\Seeder;

class EntityTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'character' => 'fa-user',
            'family' => 'fa-people-group',
            'location' => 'fa-compass',
            'organisation' => 'fa-users-between-lines',
            'item' => 'fa-gem',
            'note' => 'fa-book-open',
            'event' => 'fa-cake-candles',
            'calendar' => 'fa-calendar',
            'race' => 'fa-person-hiking',
            'quest' => 'fa-sign-hanging',
            'journal' => 'fa-book',
            'tag' => 'fa-tags',
            'dice_roll' => 'fa-dice-d20',
            'conversation' => 'fa-comments',
            'attribute_template' => 'fa-file-export',
            'ability' => 'fa-fire',
            'map' => 'fa-map',
            'timeline' => 'fa-timeline',
            'bookmark' => 'fa-book-bookmark',
            'creature' => 'fa-paw',
            'whiteboard' => 'fa-chalkboard',
        ];
        $position = 1;
        $created = 0;
        foreach ($types as $code => $icon) {
            $type = EntityType::default()->firstOrNew([
                'code' => $code,
            ]);
            //            if (! $type->exists) {
            //                continue;
            //            }
            $type->fill([
                'code' => $code,
                'is_enabled' => true,
                'is_special' => false,
                'position' => $position,
                'icon' => $icon,
            ])->save();
            $created++;
            $position++;
        }
    }
}
