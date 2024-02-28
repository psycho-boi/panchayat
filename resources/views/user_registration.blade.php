@extends('layouts.master')

@section('content')

<h1>Registration form</h1>
<div class="form-container">
  <form name="registerForm">
    <label for="firstName">First Name *</label>
    <input type="text" id="firstName" name="firstName" placeholder="John" required/><p class="error-message"></p>
    <label for="lastName">Last Name *</label>
    <input type="text" id="lastName" placeholder="Doe" required/>
    <p class="error-message"></p>
    <label for="e-mail">E-mail address *</label>
    <input type="text" id="e-mail" placeholder="john-doe@net.com" required/>
    <p class="error-message"></p>
    <label for="phoneNumber">Phone Number</label>
    <input type="text" id="phoneNumber" maxlength="9" pattern=".{9,}"   required title="9 characters length"placeholder="223587972"/>
    <p class="error-message"></p>
    <label for="country">Country</label>
    <input type="text" id="country" placeholder="United Kingdom"/>
    <p class="error-message"></p>
    <label for="password">Password *</label>
    <input type="password" id="password" pattern=".{8,}"   required title="8 characters minimum"/>
    <p class="error-message"></p>
    <p class="password-rules">Your password should contain at least 8 characters and 1 number.</p>
    <input class="button" type="submit" value="submit" name="submit" onClick="formValidation()" />
   </form>
</div>
    
@endsection