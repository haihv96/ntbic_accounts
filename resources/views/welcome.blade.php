@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="account-header">
                <h1>My Services</h1>
                <hr />
            </div>
            <div class="col-md-4">
                <div class=" service-item">
                    <div class="header">
                        <img class="icon" src="{{asset('/images/account.png')}}" />
                        <a href="http://accounts.ntbic.com/sso/login">
                            <h3 class="text-center">
                                Ntbic Accounts
                            </h3>
                        </a>
                    </div>
                    <div class="text-center">
                        <img class="banner" src="{{asset('/images/shield.png')}}" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class=" service-item">
                    <div class="header">
                        <img class="icon" src="{{asset('/images/database.png')}}" />
                        <a href="http://sso.csdl.ntbic.com/sso/login">
                            <h3 class="text-center">
                                Ntbic Database
                            </h3>
                        </a>
                    </div>
                    <div class="text-center">
                        <img class="banner" src="{{asset('/images/database.png')}}" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class=" service-item">
                    <div class="header">
                        <img class="icon" src="{{asset('/images/home.png')}}" />
                        <a href="http://sso.home.ntbic.com/sso/login">
                            <h3 class="text-center">
                                Ntbic Home
                            </h3>
                        </a>
                    </div>
                    <div class="text-center">
                        <img class="banner" src="{{asset('/images/home.png')}}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
