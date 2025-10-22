@extends('layouts.app')
      @section('content')
    
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}">Moje Wydatki</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div  id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('expenses.form')}}">Nowy Wydatek</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('expenses.expensesList')}}">Lista Wydatków</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
      
        <!-- Portfolio Section-->
        <section class="masthead page-section portfolio" id="portfolio">
            <div class="container">
                <div class="row justify-content-center">
<form action="{{route('expenses.suma')}}" method="POST">
                    @csrf   
<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="month">
                                <option disabled selected>Wybierz miesiąc</option>
                                <option value="1" @selected(old('month', now()->month) == 1 )>Styczeń</option>
                                <option value="2" @selected(old('month', now()->month) == 2 )>Luty</option>
                                <option value="3" @selected(old('month', now()->month) == 3 )>Marzec</option>
                                <option value="4" @selected(old('month', now()->month) == 4 )>Kwiecień</option>
                                <option value="5" @selected(old('month', now()->month) == 5 )>Maj</option>
                                <option value="6" @selected(old('month', now()->month) == 6 )>Czerwiec</option>
                                <option value="7" @selected(old('month', now()->month) == 7 )>Lipiec</option>
                                <option value="8" @selected(old('month', now()->month) == 8 )>Sierpień</option>
                                <option value="9" @selected(old('month', now()->month) == 9 )>Wrzesień</option>
                                <option value="10"@selected(old('month', now()->month) == 10)>Październik</option>
                                <option value="11"@selected(old('month', now()->month) == 11)>Listopad</option>
                                <option value="12"@selected(old('month', now()->month) == 12)>Grudzień</option>
</select>

<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="year" > 
                            <option selected>Wybierz rok</option>
                            @for($year = now()->year; $year >= 2023; $year--)
                             <option value="{{$year}}" @selected(old('year', now()->year) == $year)>{{$year}}</option>
                            @endfor 
</select> 

<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="customer_id" id="customer_id" >
                            <option >Wybierz użytkownika</option>
                            @foreach($customers as $customer)
                             
                             <option value="{{$customer->id}}" @selected(old('customer_id',$customer_id) == $customer->id)>{{$customer->name}}</option>
                            @endforeach
</select>

<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"  name="sklep" id="shop_name">
                            <option value="">Wybierz sklep</option>
                            <!--@foreach($shops as $shop)
                             <option value="{{$shop->sklep}}">{{$shop->sklep}}</option>
                            @endforeach-->
</select>

 <button type="submit" class="btn btn-primary">Pokaż sumę wydatków</button>
</form>

                <!-- Portfolio Section Heading-->
<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">
    Lista Wydatków 
 
    @if($customer)
        {{ \App\Models\Customer::find($customer_id)->name ?? '' }} <!-- Jeśli klient jest wybrany, wyświetl jego nazwisko -->
  
    @endif
</h2>
                @if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">

  {{ session()->get('success') }}
      <button type="submit" class="btn-close"  data-bs-dismiss="alert" aria-label="Close">                  
      </button>
                @endif  
</div>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">
    <table class="table table-hover" class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sklep</th>
      <th scope="col">Wydatek</th>
      <th scope="col">Data</th>
      <th scope="col">Akcje</th>
    </tr>
  </thead>
  <tbody>
    @php $index = 1; @endphp
    @foreach ($expenses as $expense)
   
    <tr>
      <th scope="row">{{$index++}}</th>
      <td>{{$expense->sklep}}</td>
      <td>{{$expense->kwota}}</td>
      <td>{{$expense->data_zakupu}}</td>
      <td>
        <a href="{{ route('expenses.edit', ['id' => $expense->id]) }}" class="btn btn-primary btn-sm">Edytuj</a>
        <form action="{{ route('expenses.destroy', ['id' => $expense->id]) }}" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Czy na pewno chcesz usunąć ten wydatek?')">Usuń</button>
        </form>
    </tr> 
    @endforeach
    <tr><td colspan="4">Suma: {{$sum}} zł</td>
    </tr>
  </tbody>
</table>                  
                    </div>
              </div>
            </div>
        </section>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
      @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/shops.js'])
        
    </body>
</html>
    @endsection