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
        <div class="row justify-content-center col-sm-12 ">
            <div class="col-md-4 col-md-offset-4 "style="margin-top:20px;">
                <h4>Reset Password</h4>
                <hr>
                <form action="{{ route('change-password') }}" method="post">
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
                        <label for="password">Current Password</label>
                        <br>
                        <input type="password" class="form-control" placeholder="Enter Password"name="password" value="">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <br>
                        <input type="password" class="form-control" placeholder="Enter new Password" name="new-password" value="">
                        <span class="text-danger">@error('new-password'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <br>
                        <input type="password" class="form-control" placeholder="Confirm new Password" name="new-password_confirmation" value="">
                        <span class="text-danger">@error('new-password_confirmation'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <br>
                        <button class="btn btn-block btn-primary" type="submit">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>