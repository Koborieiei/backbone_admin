// JS Login //
//showForm('LOGIN');

function showForm(action){
  $.post("ajax/formLogin.php",{action:action})
    .done(function( data ) {
      $('#action').remove();
      $('#show-form').html(data);
  });
}

function getOTP(){
  $('.icons').remove('span');
  if($('#email').smkValidate()){
    var email = $('#email').val();
    $.post( "ajax/getOTP.php", { email: email })
    .done(function( data ) {
      $.smkAlert({text: data.message,type: data.status});
      if(data.status == 'success'){
        $("#otp").attr("placeholder", 'OTP REF: '+data.REF);
        $("#tl_session").val(data.tl_session);
        $("#email").prop('readonly', true);
        $("#otp").prop('disabled', false);
        $("#sendForm").prop('disabled', false);
      }
    });
  }
}

$('#formLogin').on('submit', function(event) {
  event.preventDefault();
  $('.icons').remove('span');
  if ($('#formLogin').smkValidate()) {
    $.ajax({
        url: 'ajax/AEDLogin.php',
        type: 'POST',
        data: new FormData( this ),
        processData: false,
        contentType: false,
        dataType: 'json'
    }).done(function( data ) {

      // $.smkProgressBar({
      //   element:'body',
      //   status:'start',
      //   bgColor: '#000',
      //   barColor: '#fff',
      //   content: 'Loading...'
      // });
      // setTimeout(function(){
        // $.smkProgressBar({status:'end'});
        $('#formLogin').smkClear();
        $.smkAlert({text: data.message,type: data.status});
        if(data.status == 'success'){
          window.location = '../../pages/home/';
        }
      // }, 1000);
    });
  }
});
