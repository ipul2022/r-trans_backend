{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body style="margin: 100px;">
    <h1>You have requested to reset your password</h1>
    <hr>
    <p>We cannot simply send you your old password. A unique link to reset your
        password has been generated for you. To reset your password, click the
        following link and follow the instructions.</p>
    <h1><a href="http://127.0.0.1:8000/user/get-token/{{$token}}">Click Here to Reset Password</a></h1>
</body>

</html> --}}
{{-- @component('mail::message')
<h1>We have received your request to reset your account password</h1>
<p>You can use the following code to recover your account:</p>

@component('mail::panel')
{{ $code }}
@endcomponent

<p>The allowed duration of the code is one hour from the time the message was sent</p>
@endcomponent
<!DOCTYPE html>
<html>

<head>
    <title>How to send mail using queue in Laravel 5.7? - ItSolutionStuff.com</title>
</head> --}}
<!DOCTYPE html>
<html>

<head>
    <title>How to send mail using queue in Laravel 5.7? - ItSolutionStuff.com</title>
</head>

<body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">
            <div style="border-bottom:1px solid #eee">
                <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Rtrans Apps</a>
            </div>

            <p style="font-size:1.1em">Hi,</p>
            <p>Thank you for choosing Rtrans. You can use the following code to recover your account:</p>
            <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;"> {{$code}}</h2>
            <p style="font-size:0.9em;">Regards,<br />Rtrans Apps</p>
            <hr style="border:none;border-top:1px solid #eee" />
            <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                <p>Toc Studio</p>
                <p>Serang Banten</p>
                <p>Indonesia</p>
            </div>
        </div>
    </div>
</body>

</html>
