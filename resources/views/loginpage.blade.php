<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        /* BAGIAN BACKGROUND */
        .bg-section {
    flex: 1;
    background-size: 80%;
    background-position: center;
    background-repeat:no-repeat;
    background-image: url("{{ asset('images/logoace.png') }}");
}

        /* BAGIAN LOGIN */
        .login-section {
            flex: 1;
            background: #ffffffd2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 100%;
            max-width: 350px;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-box input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #130ca0c8;
            border-radius: 6px;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background: #0d366cff;
            border: none;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }

        .login-box button:hover {
            background: #0057b3f6;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .bg-section {
                display: none;
            }
            .login-section {
                flex: 1;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="bg-section" style="background-color: #ffffff;"></div>

    <div class="login-section" >
        <div class="login-box">
            <h2>Login</h2>
<form method="POST" action="{{ route('login.process') }}">
    @csrf

    <input type="email" name="email" required>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>
            </form>
        </div>
    </div>
</div>

</body>
</html>





