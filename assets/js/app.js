import $ from "jquery"
  $(document).ready(function () {
      console.log("ok, JQuery fonctionne !");
  });

$('select').on('change', function() {
    var valType = $('#Type').val();
    var dataType = (valType == '') ? '' : '[data-Type="'+valType +'"]';

        console.log(valType);
    if (valType !== '') {
        $('.modalUnique').show();
        $('.modalUnique').not(dataType).hide();
    }else if(valType === ''){
        $('.modalUnique').show();
    }
});


