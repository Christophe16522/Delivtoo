<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <title>Hello, world!</title>

</head>

<body>
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <img class="logo_front_end" src="{{ URL::to('/assets/images/logo/logo.png') }}" alt="Image" />
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 text-dark text-decoration-none" href="#">Se connecter</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="#">S'inscrire</a>
                    <a class="py-2 text-dark text-decoration-none" href="mailto:sav@delivtoo.com">Nous contacter</a>
                </nav>
            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">Pricing</h1>
                <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with
                    this
                    Bootstrap example. It’s built with default Bootstrap components and utilities with little
                    customization.
                </p>
            </div>
        </header>
        <main>
            <form action="/commander-livraison" method="POST">
                {!! csrf_field() !!}

                <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                    @foreach ($list_delivery_type as $item)
                        <div class="col">
                            <div class="card mb-4 rounded-3 shadow-sm border-primary">
                                <div class="card-header py-3 text-white bg-primary border-primary">
                                    <h4 class="my-0 fw-normal">{{ $item->nom_delivery_type }}</h4>
                                </div>
                                <div class="card-body">
                                    <h1 class="card-title pricing-card-title">{{ $item->prix_ttc_delivery }} € TTC
                                    </h1>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li>Longeur : {{ $item->longeur_cm }} cm</li>
                                        <li>Largeur : {{ $item->largeur_cm }} cm</li>
                                        <li>Hauteur : {{ $item->hauteur_cm }} cm</li>
                                        <li>Poids : {{ $item->poids_kg }} kg</li>
                                    </ul>
                                    <div class="mb-3">
                                        <input type="number" min="0" max="5" class="form-control"
                                          name="nbr-{{$item->id}}" placeholder="Nombre">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="w-100 btn btn-lg btn-primary">Commander</button>

                </div>
            </form>
        </main>
    </div>
</body>

</html>
