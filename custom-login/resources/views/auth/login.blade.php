<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Authentication</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 "style="margin-top:20px;">
                <h4>Login</h4>
                <hr>
                <form action="{{ route('login-user') }}" method="post">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session :: get('success') }}
                        </div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">
                            {{ Session :: get('fail') }}
                        </div>
                    @endif
                    
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <br>
                        <input type="text" class="from-control" placeholder="Enter Email"name="email" value="{{ old('email') }}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Password</label>
                        <br>
                        <input type="password" class="from-control" placeholder="Enter Password"name="password" value="">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <br>
                        <button class="btn btn-block btn-primary" type="submit">Login</button>
                        <a href="" style="text-decoration: none">forget password?</a>
                    </div>
                </form>
                <a href="registration">New User ! Registration Here</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>