@extends('platform::auth')
@section('title',__('Sign in to your account'))

@section('content')
    <h1 class="h4 text-black mb-4">{{__('Forgot password')}}</h1>

    <form class="m-t-md"
          role="form"
          method="POST"
          action="{{route ('password.email')}}">
        @csrf

        <div class="form-group">

            <label class="form-label">
                {{__('Email address')}}
            </label>

            {!!  \Orchid\Screen\Fields\Input::make('email')
                ->type('email')
                ->required()
                ->tabindex(1)
                ->autofocus()
                ->placeholder(__('Enter your email'))
            !!}
        </div>

        <div class="row">
            <div class="form-group col-md-6 col-xs-12">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="3">
                    <x-orchid-icon path="login" class="text-xs mr-2"/>
                    {{__('Reset password')}}
                </button>
            </div>
        </div>

    </form>
@endsection
