<x-auth-layout title="Login | Welcome back">
    <form-element>
        <form method="POST" action="{{ route('login') }}" class="box">
            @csrf

            <div class="field mb-5">
                <h2 class="title is-size-4">{{ __('Sing in') }}</h2>
            </div>

            <!-- Email Address -->
            <div class="field">
                <label class="label">{{ __('Email address') }}</label>
                <div class="control">
                    <input id="email" type="email" class="input @error('email') is-danger @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Enter your email">

                    <x-input-error :messages="$errors->get('email')" data-error="email" class="mt-2" />
                </div>
            </div>

            <!-- Password -->
            <div class=" field">
                <span class="is-flex is-justify-content-space-between">
                    <label class="label">{{ __('Password') }}</label>
                    @if (Route::has('password.request'))
                        <a class="is-link is-light" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </span>
                <div class="control">
                    <input id="password" type="password" class="input @error('password') is-danger @enderror"
                        name="password" required autocomplete="current-password" placeholder="Enter your password">

                    <x-input-error :messages="$errors->get('password')" data-error="password" class="mt-2" />
                </div>
            </div>

            <!-- Remember Me -->
            <div class="field">
                <div class="control">
                    <label for="remember" class="checkbox">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <!-- Create account & Submit -->
            <div class="field is-grouped is-grouped-right">
                <a class="control" href="{{ route('register') }}">
                    <p class="button is-link is-light">
                        {{ __('Create account') }}
                    </p>
                </a>
                <div class="control">
                    <button type="submit" class="button is-link">{{ __('Sing in') }}</button>
                </div>
            </div>
        </form>
    </form-element>
</x-auth-layout>