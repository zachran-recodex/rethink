<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
        </flux:radio.group>
        
        <flux:text class="text-sm text-zinc-600 mt-4">
            {{ __('Dark mode is currently disabled. Only light mode is available.') }}
        </flux:text>
    </x-settings.layout>
</section>
