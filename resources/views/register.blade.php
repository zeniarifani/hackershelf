{{-- @extends('layout.master') --}}

@extends('layout.auth')
@section('title', 'register account')

@section('content')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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

        .register-container {
            
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
            margin-top: 100px;
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

        .register-form{
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

        .register-button{
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

        .register-button:hover {
            background: linear-gradient(to right, #5a6fd8, #6a4290);
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.15);
        }

         .register-button:active {
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

        .social-register {
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
        <h1>Register Account</h1>
    </div>

    <div class="register-container">
        <div class="image-behind">
            
        </div>

        {{-- <form class ="register-form" id="register-form">   --}}
        <form action="{{route('register')}}" class ="register-form" accept-charset="UTF-8" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-label">Username</div>
                <div class="input-with-icon">
                    <input type="text" id="InputName" name="name" placeholder="Enter your first name" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <span style="color:#ff6b6b;font-size:14px;margin-top:8px;display:block;">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <div class="form-label">Email</div>
                <div class="input-with-icon">
                    <input type="email" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <span style="color:#ff6b6b;font-size:14px;margin-top:8px;display:block;">{{ $message }}</span>
                @enderror
            </div>
            
            
            <div class="input-with-icon">
                <div class="form-label">Password</div>
                <input type="password" id="password" name="password" placeholder="Enter your password (minimum 8 characters)" required>
                @error('password')
                    <span style="color:#ff6b6b;font-size:14px;margin-top:8px;display:block;">{{ $message }}</span>
                @enderror
            </div>
            
                        <div class="form-group">
                            <div class="form-label">Re-Enter Password</div>
                            <div class="input-with-icon">
                                <input type="password" id="password-confirm" name="password_confirmation" placeholder="Re-enter Your Password" required>
                            </div>
                            <div id="password-match-message" style="color:#ff6b6b;font-size:14px;margin-top:8px"></div>
                        </div>
            
            <button type="submit" class="register-button">Create Account</button>
        </form>

        <div class ="signup-link">
            <p>Already have an account? <a href="{{route('login')}}">Sign In</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.querySelector('.register-form');
            var pwd = document.getElementById('password');
            var pwdConfirm = document.getElementById('password-confirm');
            var msg = document.getElementById('password-match-message');

            if (!form || !pwd || !pwdConfirm || !msg) return;

            function validatePasswords() {
                if (pwd.value === '' && pwdConfirm.value === '') {
                    msg.textContent = '';
                    pwdConfirm.style.borderColor = '';
                    return true;
                }

                if (pwd.value !== pwdConfirm.value) {
                    msg.textContent = 'Passwords do not match.';
                    msg.style.color = '#ff6b6b';
                    pwdConfirm.style.borderColor = '#ff6b6b';
                    return false;
                }

                msg.textContent = '';
                pwdConfirm.style.borderColor = '';
                return true;
            }

            pwd.addEventListener('input', validatePasswords);
            pwdConfirm.addEventListener('input', validatePasswords);

            form.addEventListener('submit', function (e) {
                if (!validatePasswords()) {
                    e.preventDefault();
                    pwdConfirm.focus();
                }
            });
        });
    </script>
</body>
</html>

@endsection




