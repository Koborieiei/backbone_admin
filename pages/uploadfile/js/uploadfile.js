
    showTable();

    function showTable(){
      $.get( "ajax/showTable.php")
      .done(function( data ) {
        $("#showTable").html( data );
      });
    }

    function showForm(value="",id=""){
      $.post("ajax/formModule.php",{value:value,id:id})
        .done(function( data ) {
          $("#myModal").modal("toggle");
          $("#show-form").html(data);
      });
    }

    function delModule(id){
      $.smkConfirm({
        text:'Are You Sure Delete Module?',
        accept:'Yes',
        cancel:'No'
      },function(res){
        // Code here
        if (res) {
          $.post("ajax/AEDModule.php",{action:'DEL',uf_id:id})
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

    $("#formAddModule").on("submit", function(event) {
      event.preventDefault();
      if ($("#formAddModule").smkValidate()) {
        $.ajax({
            url: "ajax/AEDModule.php",
            type: "POST",
            data: new FormData( this ),
            processData: false,
            contentType: false,
            dataType: "json"
        }).done(function( data ) {
          $.smkProgressBar({
            element:"body",
            status:"start",
            bgColor: "#000",
            barColor: "#fff",
            content: "Loading..."
          });
          setTimeout(function(){
            $.smkProgressBar({status:"end"});
            $("#formAddModule").smkClear();
            showTable();
            showSlidebar();
            $.smkAlert({text: data.message,type: data.status});
            $("#myModal").modal("toggle");
          }, 1000);
        });
      }
    });

    function CopyMessage(value){
      var copyText = document.getElementById(value);
      copyText.select();
      document.execCommand("copy");
      copyText.value;
      $.smkAlert({text: 'Copied',type: 'success'});
    }

    Dropzone.options.dropzoneFrom = {
      autoProcessQueue: false,
      addRemoveLinks:true,
      maxFilesize: 1000, // MB
      parallelUploads:5,
      maxFiles : 5, // ไฟล์สูงสุด 5 ไฟล์
      dictDefaultMessage: "วางไฟล์",
      init: function(){
         var submitButton = document.querySelector('#submit-all');
         myDropzone = this;
         submitButton.addEventListener("click", function(){
          myDropzone.processQueue();
         });
         this.on("complete", function( file ){
           if(this.getQueuedFiles().length == 0)
            {
             var _this = this;
             _this.removeAllFiles();
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

             }, 1000);

            }


         });
        },
      };
