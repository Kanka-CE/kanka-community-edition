@can('update', $entity)
<a href="{{ route('entities.attributes.edit', [$campaign, 'entity' => $entity]) }}" class="btn2 btn-sm">
    <x-icon class="fa-solid fa-list" />
    {{ __('entities/attributes.actions.manage') }}
</a>
@endif
