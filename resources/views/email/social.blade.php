<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Registration</h2>
        <div>
            Thanks {{ $user->name }} for creating an account with the verification demo app.<br/>
            Please follow the link below to verify your email address
            {{ URL::to('register/activation/' . $confirmation_code['confirmation_code']) }}.<br/>
        </div>
    </body>
</html>

