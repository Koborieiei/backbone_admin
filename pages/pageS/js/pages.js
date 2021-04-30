
showTable();

function showTable(){
  $.get( "ajax/showTable.php")
  .done(function( data ) {
    $("#showTable").html( data );
  });
}

function showForm(value="",id=""){
  $.post("ajax/formPages.php",{value:value,id:id})
    .done(function( data ) {
      $('#myModal').modal('toggle');
      $('#show-form').html(data);
  });
}

function delModule(id){
  $.smkConfirm({
    text:'Are You Sure Delete Pages?',
    accept:'Yes',
    cancel:'No'
  },function(res){
    // Code here
    if (res) {
      $.post("ajax/AEDPages.php",{action:'DEL',page_id:id})
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

$('#formAddPages').on('submit', function(event) {
  event.preventDefault();
  if ($('#formAddPages').smkValidate()) {
    $.ajax({
        url: 'ajax/AEDPages.php',
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
        $('#formAddPages').smkClear();
        showTable();
        showSlidebar();
		//alert(data.sql);
        $.smkAlert({text: data.message,type: data.status});
        $('#myModal').modal('toggle');
      }, 1000);
    });
  }
});
