import $ from "jquery"
  $(document).ready(function () {
      console.log("ok, JQuery fonctionne !");
  });

$('select').on('change', function() {
    var valType = $('#Type').val();
    var dataType = (valType == '') ? '' : '[data-Type="'+valType +'"]';
    $('.test').show();
    $('.test').not(dataType).hide();
});

