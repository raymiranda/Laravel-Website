<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $fillable = [
    	'first_name', 'last_name', 'address1', 'address2', 'city', 'state', 'zip', 'phone', 'email', 'companyName', 'companyAddress', 'companyCity', 'companyState', 'companyZip', 'companyPhone', 'captcha'
	];
}
