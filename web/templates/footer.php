</section>
  <script type="text/javascript">
      $(document).ready(function(){
          // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();
      });

      $(".ddd").on("click", function () {

          var $button = $(this);
          var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();
          var cenaJidla = $(this).closest('div.polozka').find('input.prize-of-food').val();
          var cenaPolozka = $(this).closest('div.polozka').find('h5.cena');
          var cena = document.getElementsByClassName('cena');
          var suma = 0;

          if ($button.text() == "+") {
              var newVal = parseFloat(oldValue) + 1;
          } else {
              // Don't allow decrementing below zero
              if (oldValue > 0) {
                  var newVal = parseFloat(oldValue) - 1;
              } else {
                  newVal = 0;
              }
          }

          $button.closest('.sp-quantity').find("input.quntity-input").val(newVal);
          cenaPolozka.html(newVal*cenaJidla+" Kč");

          for (var i = 0; i < cena.length; i++) {
            var mystring = cena[i].innerHTML
            mystring = mystring.replace(' Kč','');

            suma = Number(suma)+Number(mystring);
            console.log('upravena suma'+suma);

            document.getElementById('cenacelkem').innerHTML = suma+" Kč";
          }



      });


      $('.carousel.carousel-slider').carousel({fullWidth: true});
      $(".button-collapse").sideNav();
  </script>
  </body>
</html>
