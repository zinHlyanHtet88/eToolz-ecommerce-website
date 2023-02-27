<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">

        </x-slot>
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="container col-4 offset-4 shadow px-5 py-3">
            <legend class="fw-bold text-info text-center">e<span class="text-secondary">Toolz</span></legend>
            <hr style="border: 1px solid #D3D3D3">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="phone" value="{{ __('Phone') }}" />
                    <x-jet-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="address" value="{{ __('Address') }}" />
                    <x-jet-input id="address" class="form-control" type="text" name="address" :value="old('address')" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="gender" value="{{ __('Gender') }}" />
                    <select id="gender" class="form-control" wire:model="gender" name="gender" style="border-radius: 4px;border: 1px solid #D3D3D3">
                        <option value="male">
                            Male
                        </option>
                        <option value="female">
                            Female
                        </option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="form-control" type="password" name="password" autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <div class="text-end">
                        <button class="btn btn-success">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

