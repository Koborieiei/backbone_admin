
showTable();

function showTable(){
  $.get( "ajax/showTable.php")
  .done(function( data ) {
    $("#showTable").html( data );
  });
}

function showForm(value="",id=""){
  $.post("ajax/formRoles.php",{value:value,id:id})
    .done(function( data ) {
      $('#myModal').modal('toggle');
      $('#show-form').html(data);
  });
}

function delModule(id){
  $.smkConfirm({
    text:'Are You Sure Delete Roles?',
    accept:'Yes',
    cancel:'No'
  },function(res){
    // Code here
    if (res) {
      $.post("ajax/AEDRoles.php",{action:'DEL',role_id:id})
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

$('#formAddRoles').on('submit', function(event) {
  event.preventDefault();
  if($(".content_select").val() == '2'){
    var editor1 = CKEDITOR.instances['editor1'].getData();
    var a = $('#editor').val(editor1);
  }
  if ($('#formAddRoles').smkValidate()) {
    $.ajax({
        url: 'ajax/AEDRoles.php',
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
        $('#formAddRoles').smkClear();
        showTable();
        showSlidebar();
        $.smkAlert({text: data.message,type: data.status});
        $('#myModal').modal('toggle');
      }, 1000);
    });
  }
});
