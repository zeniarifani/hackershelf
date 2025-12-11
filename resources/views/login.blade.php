@extends('layout.auth')
@section('title', 'Login')

@section('content')

   {{-- <div class="col-md-6 offset-md-3 mt-5">
        <h1>Login</h1>
        <form action="{{route('login')}}" accept-charset="UTF-8"  method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="InputEmail">Email</label>
                <input type="email" name="email" class="form-control" id="InputEmail" placeholder="Enter your email" required="required">
            </div>

             <div class="form-group mb-3">
                <label for="InputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Enter your Password" required="required">
            </div>  
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <a href="{{ route('register') }}">Register</a>

    </div> --}}

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href = "https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rek="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://cdn.vercel.app/geist/1.0.0/geist.css');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Geist', sans-serif;
        } 

        /*spotlight*/
        .angular-spotlight{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                180deg,
                #AA661C 0%,
                #8A4E18 2%,
                #6A3A14 5%,
                #4A2810 10%,
                #2A1608 20%,
                #1A0F03 40%,
                #000000 100%
            );
            pointer-events: none;
            z-index: 0;
        }

        body{
            background-color: #000000;
            background: linear-gradient(
                180deg,
                #AA661C 0%,
                #8A4E18 2%,
                #6A3A14 5%,
                #4A2810 10%,
                #2A1608 20%,
                #1A0F03 40%,
                #000000 100%
            );
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .login-container {
            
            max-width: auto;
            width: 700px;
            background: #000;
            border-radius: 30px;
            border: 1px solid rgba(170, 102, 28, 0.59);
            box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
            overflow: visible;
            padding: 40px 35px;
            animation: fadeIn 0.5s ease-out;
            margin: 0 auto;
            margin-top: 50px;
            background-image: url('../assets/images/behind.png');
            background-position: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
            margin: 0 auto;
            margin-top: 100px;
        }

        .logo h1 {
            color: #bea080;
            font-size: 70px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 8px;
            color: color-linear-gradient(90deg, #f8f9fa, #AA661C);
        }

        .logo p {
            color: #AA661C;
            font-size: 14px;
        }


        /*header*/
        header{
            background: rgba(30, 30, 30, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .form-label{
            font-size: 25px;
            color: #fff;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        .login-form{
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-group{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .input-with-icon{
            position: relative;
        }

        .input-with-icon input{
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid rgba(170, 102, 28, 0.29);
            border-radius: 12px;
            font-size: 25px;
            transition: all 0.3s;
            background-color: #000;
            background: linear-gradient(0deg, #0B0909 0%, #0B0909 100%), rgba(170, 102, 28, 0.59);
            color: #fff;
        }

        ::-ms-reveal {
            filter:invert(100%)
        }

        .input-with-icon input:focus{
            outline: none;
            border-color: #667eea;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-with-icon input::placeholder {
            color: #aaa;
            font-weight: 400;
        }

        .login-button{
            background: #AA661C;
            color: #fff;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            letter-spacing: 0.5px;
            position: relative;
        }

        .login-button:hover {
            background: linear-gradient(to right, #5a6fd8, #6a4290);
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.15);
        }

         .login-button:active {
            transform: translateY(0);
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 25px;
        }

        .signup-link a {
            color: #AA661C;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        .signup-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #999;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider span {
            padding: 0 15px;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .image-behind{
            position: relative;

        }

    </style>
</head>
<body>

    <div class="logo">
        <h1>Login</h1>
    </div>

    <div class="login-container">
        <div class="image-behind">
            
        </div>

        <form class ="login-form" id="login-form" action="{{route('login')}}" accept-charset="UTF-8"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-label">Email</div>
                <div class="input-with-icon">
                    <input type="email" id="InputEmail" name="email" placeholder="Enter your email" required>
                </div>
            </div>
  
                <div class="input-with-icon">
                    <div class="form-label">Password</div>
                    <input type="password" id="InputPassword" name="password" placeholder="Enter your password" required>
                </div>

            <button type="submit" class="login-button">LOGIN</button>
        </form>

        <div class ="signup-link">
            <p>Don't have an account? <a href="{{route('register')}}">Sign Up</a></p>
        </div>
    </div>
</body>
</html>

@endsection




