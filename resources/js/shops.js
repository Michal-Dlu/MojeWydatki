import $ from 'jquery';

$(function() {
    // Nasłuchiwanie na zmianę w polu wyboru użytkownika
    $('#customer_id').on('change',function() {
        
        var customer_id = $(this).val();  // Pobranie wybranego ID użytkownika
        if (customer_id) {
            // Wysłanie żądania AJAX do 
            
            $.ajax({
                
                url: 'http://localhost:8000/get-shops-by-customer/' + customer_id , // URL do kontrolera
                method: 'GET',
                
                success: function(data) {
                    console.log('Odpowiedź z serwera:', data);
    
                    $('#shop_name').html('<option selected value="">Wybierz sklep</option>');

                    // Dodaj nowe sklepy do listy
                    data.shops.forEach(function(shop) {
                        $('#shop_name').append(`<option value="${shop.sklep}">${shop.sklep}</option>`);
                        
                    });
                },
                error: function() {
                    alert('Nie udało się pobrać sklepów. Spróbuj ponownie.');
                }
            });
        } else {
            // Jeżeli nie wybrano użytkownika, wyczyść pole sklepów
            $('#shop_name').html('<option selected>Wybierz sklep</option>');
        }
    });
});

