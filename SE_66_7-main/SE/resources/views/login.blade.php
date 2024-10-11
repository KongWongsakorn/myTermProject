<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SE Group 7</title>
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="leftContainer">
            <div class="logoContainer">
                <img src="assets/images/ku.png" alt="Logo" class="logo">
            </div>
            <div class="contentContainer">
                <h4>Nice to see you</h4>
                <h1>Welcome to Online Leave System</h1>
                <hr>
                <p>This is a project in the course software engineering</p>
                <p>We are very determined to do it. Hope you like it and thank you.</p>
            </div>
        </div>
        <div class="rightContainer">
            <div class="login-container">
                <div class="login-form">
                    <h1>Login Account</h1>
                    <p>For government teachers in Kasetsart schools</p>
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert" style="background-color: #f44336; color: white; padding: 10px;" >
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        
        </div>
    </div>
    
</body>

</html>
