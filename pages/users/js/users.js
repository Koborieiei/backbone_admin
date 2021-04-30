
showTable();

function showTable(){
  $.get( "ajax/showTable.php")
  .done(function( data ) {
    $("#showTable").html( data );
  });
}

function showForm(value="",id=""){
  $.post("ajax/formUsers.php",{value:value,id:id})
    .done(function( data ) {
      $('#myModal').modal('toggle');
      $('#show-form').html(data);
  });
}

function CreatePass(){
  var pass = GenPass();
  $('#pass1').val(pass);
  $('#pass2').val(pass);
}

function resetPass(){
  var Newpass = GenPass();

}

function delModule(id){
  $.smkConfirm({
    text:'Are You Sure Delete User?',
    accept:'Yes',
    cancel:'No'
  },function(res){
    // Code here
    if (res) {
      $.post("ajax/AEDUsers.php",{action:'DEL',user_id:id})
        .done(function( data ) {
          $.smkProgressBar({
            element:'body',
            status:'start',
            bgColor: '#000',
            barColor: '#fff',
            content: 'Loading...'
          });
          setTimeout(function(){
            $.smkProgressBar({status:'end'});
            showTable();
            showSlidebar();
            $.smkAlert({text: data.message,type: data.status});
          }, 1000);
      });
    }
  });
}

$('#formAddUsers').on('submit', function(event) {
  event.preventDefault();
  var action = $('#action').val();
  if ($('#formAddUsers').smkValidate()) {

    if(action == 'ADD'){
        if( $.smkEqualPass('#pass1', '#pass2') ){
          // Code here
            $.ajax({
                url: 'ajax/AEDUsers.php',
                type: 'POST',
                data: new FormData( this ),
                processData: false,
                contentType: false,
                dataType: 'json'
            }).done(function( data ) {
              $.smkProgressBar({
                element:'body',
                status:'start',
                bgColor: '#000',
                barColor: '#fff',
                content: 'Loading...'
              });
              setTimeout(function(){
                $.smkProgressBar({status:'end'});
                $('#formAddUsers').smkClear();
                showTable();
                showSlidebar();
                $.smkAlert({text: data.message,type: data.status});
                $('#myModal').modal('toggle');
              }, 1000);
            });
        }
    }else{
        $.ajax({
            url: 'ajax/AEDUsers.php',
            type: 'POST',
            data: new FormData( this ),
            processData: false,
            contentType: false,
            dataType: 'json'
        }).done(function( data ) {
          $.smkProgressBar({
            element:'body',
            status:'start',
            bgColor: '#000',
            barColor: '#fff',
            content: 'Loading...'
          });
          setTimeout(function(){
            $.smkProgressBar({status:'end'});
            $('#formAddUsers').smkClear();
            showTable();
            showSlidebar();
            $.smkAlert({text: data.message,type: data.status});
            $('#myModal').modal('toggle');
          }, 1000);
        });
    }



  }
});
