<div class="dropdown entity-actions-dropdown">
    <div data-dropdown aria-expanded="false" aria-haspopup="menu" aria-controls="assets-submenu" class="btn2 btn-sm join-item entity-actions-button">
        {{ __('crud.add') }}
        <x-icon class="fa-solid fa-caret-down" />
    </div>
    <div class="dropdown-menu hidden" role="menu" id="assets-submenu">
        <x-dropdowns.item link="#" icon="fa-solid fa-upload" :dialog="route('entities.entity_assets.create', [$campaign, $entity, 'type' => \App\Enums\EntityAssetType::file])">
            {{ __('entities/assets.actions.file') }}
        </x-dropdowns.item>

        <x-dropdowns.item link="#" icon="fa-solid fa-link" :dialog="route('entities.entity_assets.create', [$campaign, $entity, 'type' => \App\Enums\EntityAssetType::link])">
            {{ __('entities/assets.actions.link') }}
        </x-dropdowns.item>
        <x-dropdowns.divider />

        <x-dropdowns.item :link="'https://docs.kanka.io/en/latest/features/assets.html'" icon="fa-solid fa-book">
            <span class="grow">{{ __('general.learn-more') }}</span>
        </x-dropdowns.item>
    </div>
</div>
