@extends('layouts.app')
      @section('content')   
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}">Powrót do menu</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('shops.form')}}">Dodaj Sklep</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('shops.filter')}}">Lista Sklepów</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <section class="masthead page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Dodaj nowy sklep</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
             
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN" method="POST" action="{{route('shops.store')}}"   >
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="shop_name" type="text" name="sklep" placeholder="Wpisz nazwę sklepu" />
                                <label for="sklep">Nazwa sklepu</label>
                                <div class="invalid-feedback" data-sb-feedback="Nazwa skepu jest wymagana">Nazwa sklepu jest wymagana</div>
                            </div>
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="customer_id" id="customer_id">
                                <option selected>Wybierz użytkownika</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            @csrf
                            <!-- Submit Button-->
                            <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Zapisz sklep</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!-- Bootstrap core JS-->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
@endsection