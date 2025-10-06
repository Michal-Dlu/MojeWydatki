
      @extends('layouts.appIndex')
      @section('content')
        <!-- Masthead-->
      <header class="masthead bg-primary text-white text-center" style="padding:10px">
                <div class="container d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                <img class="masthead-avatar mb-0" src="assets/img/portfolio/skarbonka.png" style="height:100px; width:100px" alt="..." />
                <!-- Masthead Heading-->
                <h1 class="masthead-heading text-uppercase mb-0" href="{{route ('index')}}" style="font-size:30px; padding:3px">Moje wydatki</h1>
                <!-- Icon Divider-->
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line" style="font-size:20px; padding:3px"></div>
                    <div class="divider-custom-icon" style="font-size:20px; padding:3px"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line" style="font-size:20px; padding:3px"></div>
                </div>
                <!-- Masthead Subheading-->
                <p class="masthead-subheading font-weight-light mb-0" style="font-size:20px; padding:3px">Pomagam kontrolować Twoje wydatki</p>
            </div>
        </header>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio" style="padding:20px">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0" style="font-size:30px">Menu</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
                    <!-- Portfolio Item 1-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto"><a class="navbar-brand" href="{{ route('shops.shopList') }}">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <div class="bg-dark bg-opacity-50 text-white p-3">
                            Sklepy
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/sklep.jpg" style="height:257px; width:370px" alt="..." /></a>
                        </div>
                    </div>
                    <!-- Portfolio Item 2-->
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto"><a class="navbar-brand" href="{{ route('expenses.expensesList') }}">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <div class="bg-dark bg-opacity-50 text-white p-3">
                            Wydatki
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/kasa.png" style="width:370px; height:257px" alt="..." /></a>
                        </div>
                    </div>                  
                </div>
            </div>
        </section>

         
      @endsection
   