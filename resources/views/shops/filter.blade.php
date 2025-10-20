@extends('layouts.app')
      @section('content')   
   
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}">Moje Wydatki</a>
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
     
      
        <!-- Portfolio Section-->
        <section class="masthead page-section portfolio" id="portfolio">
            <div class="container">
    
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Lista Sklepów {{$customer? $customer->name : ''}}</h2>
                <!-- Icon Divider-->
                                          @if(session()->has('success'))
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session()->get('success') }}
      <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close">
        </div>
        @endif

                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
              
<form action="{{ route('shops.filter') }}" method="GET">
                
                <select name="customer_id" id="customer_id" class="form-select mb-3">
                    <option value="">Wybierz klienta</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mb-3">Filtruj</button>
</form>
                <div class="row justify-content-center">

          <table class="table table-hover" class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sklep</th>
      <th scope="col">Akcje</th>      
    </tr>
  </thead>
  <tbody>
    @php $index = 1; @endphp
    @foreach($shops as $shop)
    <tr>
      <td scope="row">{{$index++}}</td>
      <td>{{$shop->name}}</td>
      <td>
        <a href="{{route('shops.edit',$shop->id)}}" class="btn btn-primary btn-sm">Edytuj</a>
        <form action="{{route('shops.destroy',$shop->id)}}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć ten sklep?')">Usuń</button>        
        </form>
      </td>  
    </tr>
    @endforeach
    
  </tbody>
</table>                  
                    </div>
                
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>

        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
    @endsection