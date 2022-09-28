@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <!-- <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <img style="border-radius: 20px;" src="{{ asset('images/logo.png') }}" alt="Coach Permis">
        </div><br> -->
                
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button class="col-md-9" type="submit" style="font-size: 20px; color:white;border-radius: 18px;  background-color: #f44336;">
                                    {{ __('Login') }}
                                </button>

                                
                            </div>
                        </div>
                        <div class="form-group row" style="visibility: hidden;">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Reste connecté') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                       
                    </form>
                </div>
            </div><br>
          
       
        
<!-- debut -->
<!-- <div class="col-md-12"> -->

<!-- <div class="antialiased" >
    
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0" > -->
            

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                


                
               
                
               
               <!--  -->
            </div>
           
        <!-- </div> -->
                    
                    
    <!-- </div> -->
<!-- </div > -->
<!-- fin -->
</div>
    </div>
</div>

@endsection

