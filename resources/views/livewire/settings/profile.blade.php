<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your profile information')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <!-- Avatar Upload -->
            <div>
                <flux:input type="file" wire:model="avatar" :label="__('Avatar')" accept="image/*" />

                <div class="mt-3 flex items-center gap-4">
                    @if (auth()->user()->avatar)
                        <div>
                            <flux:label class="text-sm">{{ __('Current avatar:') }}</flux:label>
                            <div class="mt-2">
                                <flux:avatar
                                    :src="asset('storage/' . auth()->user()->avatar)"
                                    :name="auth()->user()->full_name"
                                    size="xl"
                                />
                            </div>
                        </div>
                    @endif

                    @if ($avatar)
                        <div>
                            <flux:label class="text-sm">{{ __('Preview:') }}</flux:label>
                            <div class="mt-2">
                                <flux:avatar
                                    :src="$avatar->temporaryUrl()"
                                    :name="auth()->user()->full_name"
                                    size="xl"
                                />
                            </div>
                        </div>
                    @endif

                    @if (!auth()->user()->avatar && !$avatar)
                        <div>
                            <flux:label class="text-sm">{{ __('Current avatar:') }}</flux:label>
                            <div class="mt-2">
                                <flux:avatar
                                    :name="auth()->user()->full_name"
                                    size="lg"
                                    color="auto"
                                    :color:seed="auth()->user()->id"
                                />
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="first_name" :label="__('First Name')" type="text" required autofocus autocomplete="given-name" />
                <flux:input wire:model="last_name" :label="__('Last Name')" type="text" required autocomplete="family-name" />
            </div>

            <flux:input wire:model="username" :label="__('Username')" type="text" required autocomplete="username" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <flux:input wire:model="phone" :label="__('Phone')" type="text" autocomplete="tel" />

            <flux:textarea wire:model="address" :label="__('Address')" rows="3" />

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="birth_date" :label="__('Birth Date')" type="date" />
                <flux:select wire:model="gender" :label="__('Gender')">
                    <option value="">{{ __('Select Gender') }}</option>
                    <option value="male">{{ __('Male') }}</option>
                    <option value="female">{{ __('Female') }}</option>
                    <option value="other">{{ __('Other') }}</option>
                </flux:select>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
