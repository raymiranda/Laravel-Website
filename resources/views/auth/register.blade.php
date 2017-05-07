@extends('layouts.app')

@section('content')
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="store">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                            <label for="address1" class="col-md-4 control-label">Address 1</label>

                            <div class="col-md-6">
                                <input id="address1" type="text" class="form-control" name="address1" value="{{ old('address1') }}">

                                @if ($errors->has('address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                            <label for="address2" class="col-md-4 control-label">Address 2</label>

                            <div class="col-md-6">
                                <input id="address2" type="text" class="form-control" name="address2" value="{{ old('address2') }}">

                                @if ($errors->has('address2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">State</label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}">

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Zip</label>

                            <div class="col-md-6">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}">

                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('companyName') ? ' has-error' : '' }}">
                            <label for="companyName" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="companyName" type="text" class="form-control" name="companyName" value="{{ old('companyName') }}">

                                @if ($errors->has('companyName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('companyAddress') ? ' has-error' : '' }}">
                            <label for="companyAddress" class="col-md-4 control-label">Company Address</label>

                            <div class="col-md-6">
                                <input id="companyAddress" type="text" class="form-control" name="companyAddress" value="{{ old('companyAddress') }}">

                                @if ($errors->has('companyAddress'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companyAddress') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('companyCity') ? ' has-error' : '' }}">
                            <label for="companyCity" class="col-md-4 control-label">Company City</label>

                            <div class="col-md-6">
                                <input id="companyCity" type="text" class="form-control" name="companyCity" value="{{ old('companyNcompanyCityame') }}">

                                @if ($errors->has('companyCity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companyCity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('companyState') ? ' has-error' : '' }}">
                            <label for="companyState" class="col-md-4 control-label">Company State</label>

                            <div class="col-md-6">
                                <input id="companyState" type="text" class="form-control" name="companyState" value="{{ old('companyState') }}">

                                @if ($errors->has('companyState'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companyState') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('companyZip') ? ' has-error' : '' }}">
                            <label for="companyZip" class="col-md-4 control-label">Company Zip</label>

                            <div class="col-md-6">
                                <input id="companyZip" type="text" class="form-control" name="companyZip" value="{{ old('companyZip') }}">

                                @if ($errors->has('companyZip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companyZip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('companyPhone') ? ' has-error' : '' }}">
                            <label for="companyPhone" class="col-md-4 control-label">Company Phone</label>

                            <div class="col-md-6">
                                <input id="companyPhone" type="text" class="form-control" name="companyPhone" value="{{ old('companyPhone') }}">

                                @if ($errors->has('companyPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('companyPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('upload') ? ' has-error' : '' }}">
                            <label for="upload" class="col-md-4 control-label">Company Phone</label>

                            <div class="col-md-6">
                                <input id="companyPhone" type="file" class="form-control" name="upload" value="{{ old('upload') }}">

                                @if ($errors->has('upload'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('upload') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <?php
                              require_once('C:\wamp64\www\intern-project\resources\views\recaptchalib.php');
                              $publickey = "6LeQGSAUAAAAAIavQX0R6JnW7aTlEZSgYAHUnVhK";
                              echo recaptcha_get_html($publickey);
                        ?>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
