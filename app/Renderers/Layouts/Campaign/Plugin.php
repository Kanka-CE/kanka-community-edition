<?php

namespace App\Renderers\Layouts\Campaign;

use App\Renderers\Layouts\Layout;

class Plugin extends Layout
{
    /**
     * Available columns
     *
     * @return array[]
     */
    public function columns(): array
    {
        $columns = [
            'name' => [
                'key' => 'name',
                'label' => __('campaigns/plugins.fields.name'),
                'render' => function (\App\Models\Plugin $model) {
                    return '<a href="' . $model->libraryUrl() . '" class="text-link">'
                             . $model->name
                            . '</a>';
                },
            ],
            'update' => [
                'key' => 'has_update',
                'label' => __('campaigns/plugins.info.updates'),
                'render' => function ($model) {
                    $base = '';
                    if ($model->obsolete()) {
                        $base = '<i class="fa-solid fa-skull text-neutral-content" aria-hidden="true" data-toggle="tooltip" data-title="'
                            . __('campaigns/plugins.fields.obsolete')
                            . '"></i>';
                    }
                    if (! $model->has_update) {
                        return $base;
                    }

                    if (! auth()->check() || ! auth()->user()->can('recover', $this->campaign)) {
                        return $base;
                    }

                    return '<a href="' . route('campaign_plugins.update-info', [$this->campaign, $model])
                            . '" class="btn2 btn-xs" data-toggle="dialog-ajax" '
                            . 'data-target="plugin-update" data-url="'
                            . route('campaign_plugins.update-info', [$this->campaign, $model]) . '">'
                            . __('campaigns/plugins.actions.update_available')
                            . '</a> ' . $base;
                },
            ],
            'type' => [
                'key' => 'type_id',
                'label' => __('campaigns/plugins.fields.type'),
                'render' => function ($model) {
                    return __('campaigns/plugins.types.' . $model->type());
                },
            ],
            'status' => [
                'key' => 'pivot_is_active',
                'label' => __('campaigns/plugins.fields.status'),
                'render' => function ($model) {
                    if (! $model->isTheme()) {
                        return '<i class="fa-solid fa-infinity" data-title="' .
                            __('campaigns/plugins.status.always') .
                            '" data-toggle="tooltip" aria-hidden="true"></i><span class="sr-only">' . __('campaigns/plugins.status.always') . '</span>';
                    }
                    if ($model->pivot->is_active) {
                        return
                            '<i class="fa-solid fa-check-circle text-green-500" data-title="' .
                            __('campaigns/plugins.status.enabled') .
                            '" data-toggle="tooltip" aria-hidden="true"></i><span class="sr-only">' . __('campaigns/plugins.status.enabled') . '</span>';
                    }

                    return
                        '<i class="fa-solid fa-ban text-red-500" data-title="' .
                        __('campaigns/plugins.status.disabled') .
                        '" data-toggle="tooltip" aria-hidden="true"></i><span class="sr-only">' . __('campaigns/plugins.status.disabled') . '</span>';
                },
            ],
        ];

        return $columns;
    }

    /**
     * Available actions on each row
     */
    public function actions(): array
    {
        return [
            'update' => [
                'label' => 'campaigns/plugins.actions.update',
                'icon' => 'fa-solid fa-download',
                'can' => 'update',
                'type' => 'dialog-ajax',
                'route' => 'campaign_plugins.update-info',
            ],
            'changelog' => [
                'label' => 'campaigns/plugins.actions.changelog',
                'icon' => 'fa-solid fa-list',
                'can' => 'changelog',
                'type' => 'dialog-ajax',
                'route' => 'campaign_plugins.update-info',
            ],
            'disable' => [
                'can' => 'disable',
                'route' => 'campaign_plugins.disable',
                'label' => 'campaigns/plugins.actions.disable',
                'icon' => 'fa-solid fa-ban',
            ],
            'enable' => [
                'can' => 'enable',
                'route' => 'campaign_plugins.enable',
                'label' => 'campaigns/plugins.actions.enable',
                'icon' => 'fa-solid fa-check',
            ],
            'import' => [
                'can' => 'import',
                'route' => 'campaign_plugins.confirm-import',
                'type' => 'dialog-ajax',
                'label' => 'campaigns/plugins.actions.import',
                'icon' => 'fa-solid fa-clone',
            ],
            Layout::ACTION_DELETE,
        ];
    }

    public function bulks(): array
    {
        return [
            [
                'action' => 'enable',
                'label' => 'campaigns/plugins.actions.bulks.enable',
                'icon' => 'fa-solid fa-check',
                'can' => 'campaign:recover',
            ],
            [
                'action' => 'disable',
                'label' => 'campaigns/plugins.actions.bulks.disable',
                'icon' => 'fa-solid fa-ban',
                'can' => 'campaign:recover',
            ],
            [
                'action' => 'update',
                'label' => 'campaigns/plugins.actions.bulks.update',
                'icon' => 'fa-solid fa-download',
                'can' => 'campaign:recover',
            ],
            self::ACTION_DELETE,
        ];
    }
}
