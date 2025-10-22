@extends('layouts.app')
      @section('content')
@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/shops.js'])
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}">Moje Wydatki</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('expenses.form')}}">Dodaj Wydatek</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('expenses.expensesList')}}">Lista Wydatków</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <section class="masthead page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                 <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{$expense->customer->name}} Edytujesz Wydatek {{$expense->sklep}}</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                       
                        <form id="contactForm" method="POST" action="{{ route('expenses.update',['id'=>$expense->id]) }}">                      
                            @csrf                     
                            @method('PUT')
                            
                            @error('sklep')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('kwota')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('data_zakupu')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            @error('customer_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="customer_id" id="customer_id"  >
                                <option >Wybierz użytkownika</option>
                                @foreach($customers as $customer)   
                                <option value="{{$customer->id}}"  selected = "{{$customerName}}"  >{{$customer->name}}</option>
                                @endforeach
                                </select>
                                <div class="invalid-feedback" data-sb-feedback="customer_id:required">Użytkownik jest wymagany</div>   
                                                  
                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="sklep" id="shop_name" >
                                <option value="{{$expense->sklep}}" selected = $sklepName>{{$sklepName}}</option>                               
                                                           
                                </select>
                             
                            </div>
                         
                            <div class="form-floating mb-3">
                                <input class="form-control" id="kwota" type="text" name="kwota" placeholder="100,00" value="{{$expense->kwota}}" />
                                <label for="kwota">Kwota</label>                               
                            </div>
                           
                            <div class="form-floating mb-3">
                                <input class="form-control" id="date" type="date" name="data_zakupu" placeholder="" value="{{$expense->data_zakupu}}" />
                                <label for="date">Data_zakupu</label>                               
                            </div>
                  
                         
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                    
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary btn-xl " id="submitButton" type="submit">Zapisz</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </section>

      
        
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
   
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection