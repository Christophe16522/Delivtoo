<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <title>Hello, world!</title>
</head>

<body style="background-color: whitesmoke">
    <div class="content">
        <div class="container">
            <br>
            <br>
            <br>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-6 contents" style="background-color: white;border-radius: 5px">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <br> <img class="logo_login_register" src="{{ URL::to('/assets/images/logo/logo.png') }}"
                                alt="Image" />
                            <br>

                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" placeholder="Mot de passe">
                                </div>
                            </div>
                            <br>
                            <div class="mb-3 row">
                                <div class="col-sm-12 text-center">
                                    <a href="#">Mot de passe oublié</a>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <button type="button" style="width: 100%; border-radius: 10px"
                                        class="btn btn-primary">Se Connecter</button>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <button type="button" style="width: 100%; border-radius: 10px"
                                        class="btn btn-success">Créer un compte</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
