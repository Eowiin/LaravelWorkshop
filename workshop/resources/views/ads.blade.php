<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/ads.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <!-- Scripts -->
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="{{ url('/') }}">Accueil</a>
            </div>
            <div class="buttons">
                @guest
                    @if (Route::has('login'))
                            <a class="login-btn" style="margin-right: 0.5vw;" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                    @if (Route::has('register'))
                            <a class="login-btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a id="add-post-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn">Ajouter un post</a>
                    <a class="login-btn" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </header>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une annonce</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('create') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="title" style="font-weight: 600;">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="">All categories</option>
                                    <option value="sport">Sport</option>
                                    <option value="tech">Tech</option>
                                    <option value="clothing">Clothing</option>
                                </select>
                            </div>
                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="description" style="font-weight: 600;">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="location" style="font-weight: 600;">Location</label>
                                <input type="number" class="form-control" name="location" id="location">
                            </div>
                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="price" style="font-weight: 600;">Price</label>
                                <input type="number" class="form-control" name="price" id="price">
                            </div>
                            <div class="form-group" style="padding-bottom: 20px;">
                                <label for="photo" style="font-weight: 600;">Photo</label>
                                <input type="file" class="form-control" name="photo" id="photo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Publier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 70px;">
            <form action="{{ route('search') }}" method="POST" class="form-inline" style="margin-top: 4vh;">
                @csrf
                <div class="input-group w-75">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" name="search" class="form-control" placeholder="Recherche...">
                </div>
            </form>
        </div>

        <div class="row">
            <div class="sidebar col-3">
                <h3>Filters</h3>
                <form action="{{ route('filter') }}" method="POST">
                    @csrf
                    <div class="form-group" style="padding-bottom: 30px;">
                        <label for="category" style="padding-bottom: 10px;">Category</label>
                        <select class="form-control" id="category" name="category">
                          <option value="">All categories</option>
                          <option value="sport">Sport</option>
                          <option value="tech">Tech</option>
                          <option value="clothing">Clothing</option>
                        </select>
                    </div>
                    <div class="form-group" style="padding-bottom: 30px;">
                      <label for="location" style="padding-bottom: 10px;">Location</label>
                      <input type="number" class="form-control" name="location" id="location" placeholder="Enter a number">
                    </div>
                    <div class="form-group" style="padding-bottom: 30px;">
                        <label for="price" style="padding-bottom: 10px;">Price range</label>
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" name="lower_price" id="lower_price" placeholder="Min">
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" name="upper_price" id="upper_price" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="padding-bottom: 30px;">
                        <label style="padding-bottom: 10px;">Condition</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="new" name="condition" value="new">
                            <label class="form-check-label" for="new">New</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="good" name="condition" value="good">
                            <label class="form-check-label" for="good">Good</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="used" name="condition" value="used">
                            <label class="form-check-label" for="used">Used</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply filters</button>
                </form>
            </div>
            <div id="ads-container" class="col-6" style="margin-left: 10vw;">
                @foreach ($ads as $ad)
                    <div class="card">
                        <div class="card-content">
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $ad['photo']) }}" alt="Ad photo">
                            </div>
                            <div class="col-6">
                                <h4>{{ $ad['title'] }}</h4>
                                <p>{{ $ad['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="pagination">
                @for ($i = 0; $i < $pages; $i++)
                    @if ($i == 10)
                        <button class="button-pagination" onclick="changePage({{ $page + 1 }})">
                            next
                        </button>
                        @break
                    @endif
                    <button class="button-pagination" onclick="changePage({{ $i + 1 }})">
                        {{ $i + 1 }}
                    </button>
                @endfor
            </div>

        </div>

        <!-- Load jQuery from a CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/ads.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        @if ($errors->any())
            <script>document.getElementById("add-post-btn").click();</script>
        @endif
    </body>
</html>