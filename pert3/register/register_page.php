<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }
        
        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-4">
            <div class="register-container w-100 p-5 shadow rounded-5">
                <h2 class="fw-bold mb-4 text-center">Register</h2>

                

                <form action="register.php" method="post">
                    <div class="form-outline mb-3">
                        <input type="text" name="username" placeholder="Username" id="form2Example1" class="form-control text-black" required />
                    </div>

                    <div class="form-outline mb-3">
                        <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control text-black" required />
                    </div>

                    <button type="submit" value="Sign In" name="submit" class="btn btn-primary btn-block mb-4 text-white fs-6 w-100">Submit</button>
                </form>
                <p class="text-center">Alreardy have an account? <a href="../login/login_page.php">Sign in here</a>.</p>
            </div>
        </div>
    </div>
</body>


</html>