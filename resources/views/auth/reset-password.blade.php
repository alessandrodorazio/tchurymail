@extends('platform::auth')
@section('title',__('Sign in to your account'))

@section('content')
    <h1 class="h4 text-black mb-4">{{__('Reset password')}}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          action="{{route ('password.update')}}">
        @csrf

        <div class="form-group">


            <input type="hidden" name="email" value="{{ $_GET["email"] }}">
            <input type="hidden" name="token" value="{{ $token }}">

            <label class="form-label">
                {{__('Insert your password')}}
            </label>
            {!!  \Orchid\Screen\Fields\Input::make('password')
                ->type('password')
                ->required()
                ->tabindex(1)
                ->autofocus()
                ->placeholder(__('Enter your new password'))
            !!}

            {!!  \Orchid\Screen\Fields\Input::make('password_confirmation')
                ->type('password')
                ->required()
                ->tabindex(1)
                ->autofocus()
                ->placeholder(__('Re-enter your new password'))
            !!}
        </div>

        <div class="row">
            <div class="form-group col-md-6 col-xs-12">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="3">
                    {{__('Reset password')}}
                </button>
            </div>
        </div>

    </form>
@endsection
