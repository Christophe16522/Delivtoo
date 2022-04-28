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
                    <a class="me-3 py-2 text-dark text-decoration-none" href="/login">Se connecter</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="/register">S'inscrire</a>
                    <a class="py-2 text-dark text-decoration-none" href="#">Nous contacter</a>
                </nav>
            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">Options de livraison</h1>
                <p class="fs-5 text-muted">Liste des commandes
                </p>
            </div>
        </header>
        <main>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Designation</th>
                        <th scope="col">№ Commande</th>
                        <th scope="col">Prix (€ TTC)</th>
                        <th scope="col" colspan="2">Options (Supplements)</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_in_basket as $item)
                        <form>
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $item->nom_delivery_type }}</td>
                                <td>{{ $item->n_commande }}</td>
                                <td>{{ $item->prix_ttc_delivery }}</td>
                                <td> <input class="form-check-input" type="checkbox"
                                        onclick="save_is_etage({{ $item->id }})"
                                        id="is_etage_checkbox_{{ $item->id }}" @if ($item->is_etage == 0)
                                    {{ 'unchecked' }}
                                @elseif($item->is_etage == 1)
                                    {{ 'checked' }}
                    @endif
                    >
                    Livraison etage ({{ $item->prix_ttc_delivery_etage }} € TTC)</td>
                    <td> <input class="form-check-input" type="checkbox" id="is_piece_choice_{{ $item->id }}"
                            onclick="save_is_choice({{ $item->id }})" @if ($item->is_piece_chose == 0) {{ 'unchecked' }} @elseif($item->is_piece_chose == 1) {{ 'checked' }} @endif>
                        Livraison dans la pieces de votre choix ({{ $item->prix_ttc_delivery_choix_piece }} € TTC)</td>
                    <td><a class="btn btn-danger" href="/supprimer-du-pannier/{{ $item->n_commande }}">supprimer</a>
                    </td>
                    </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
            <span style="float: right">Total : <b id="total_commande">{{ $somme_total }}</b> € TTC </span> <br><br>
            <button style="float: right" type="button" class="btn btn-primary">Suivant</button>
        </main>
    </div>
</body>
<script>
    function save_is_etage(n_commande) {
        var checkBox = document.getElementById("is_etage_checkbox_" + n_commande);
        if (checkBox.checked == true) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "/save-is-etage/" + n_commande + "/1");
            xhttp.send();
        } else {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "/save-is-etage/" + n_commande + "/0");
            xhttp.send();
        }
        buildtotal();
    }

    function save_is_choice(n_commande) {
        var checkBox = document.getElementById("is_piece_choice_" + n_commande);
        if (checkBox.checked == true) {
            console.log('oui');
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "/save-is-piece-choice/" + n_commande + "/1");
            xhttp.send();
        } else {
            console.log('non');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "/save-is-piece-choice/" + n_commande + "/0");
            xhttp.send();
        }
        buildtotal();
    }

    function buildtotal() {
        var total = document.getElementById("total_commande");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                total.textContent = this.responseText;
            }
        };
        xhttp.open("GET", "get-total-basket/" + {{ $id_basket }});
        xhttp.send();
    }
</script>

</html>
