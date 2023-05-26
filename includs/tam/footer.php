        <div class="footer"></div>

         <script src="/admin/layout/js/backend.js"></script>
        <script src="<?php echo $js;?>backend.js"></script>
        <script src="<?php echo $js;?>bootstrap.min.js"></script>
        <!-- <script src="<?php echo $js;?>jquery-migrate-1.4.1.min.js"></script> -->
        <script src="layout/js/countries.js"></script>
        <script src="layout/phone-number-with-country-code/build/js/intlTelInput.js"></script>
    <script>
    // Vanilla Javascript
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
      // options here
    }));

    $(document).ready(function() {
        $('.iti__flag-container').click(function() { 
          var countryCode = $('.iti__selected-flag').attr('title');
          var countryCode = countryCode.replace(/[^0-9]/g,'')
          $('#phone').val("");
          $('#phone').val("+"+countryCode+" "+ $('#phone').val());
       });
    });
  </script>
    </body>
</html>