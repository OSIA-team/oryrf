</section>
  <script type="text/javascript">
      $(document).ready(function(){
          // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
          $('.modal').modal();
      });

      $(".ddd").on("click", function () {

          var $button = $(this);
          var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();

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

      });

      $('.carousel.carousel-slider').carousel({fullWidth: true});
      $(".button-collapse").sideNav();
  </script>
  </body>
</html>
