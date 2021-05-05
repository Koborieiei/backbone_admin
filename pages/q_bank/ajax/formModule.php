<?php
    session_start();
    include("../../../inc/function/connect.php");
    header("Content-type:text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);

    $action = $_POST["value"];
    $id = $_POST["id"];
    $type=$_POST["type"];

if($type=="qmanage"){


      if($action == "EDIT"){
        $btn = "Update changes";

     
      }
      if($action == "ADD"){
      $btn = "Save changes";
      }
      ?>
      <input type="hidden" name="action" value="<?=$action?>">
      <input type="hidden" name="id" value="<?=@$id?>">
     
      <div class="modal-body">
      <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Type:</label>
              <select name="type" id="type">
                <option value="MutipleChoice">MutipleChoice</option>
                <option value="T/F">T/F</option>
                <option value="Essay">Essay</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Skill:</label>
              <select name="skill" id="skill">
              <option value="0">none</option>
              <?php
        $sql   = "SELECT * FROM tb_skill ORDER BY hs_id DESC";
        $query = DbQuery($sql,null);
        $row  = json_decode($query,true);
        if($row['dataCount'] > 0){
          foreach ($row['data'] as $key => $value) {
      ?>
                <option value=<?=$key+1?> <?php if($id==$value['hs_id']){ echo "selected";} ?>><?=$value['hs_name']?></option>
                <?php } } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" id="Shuffle" name="Shuffle" value='1'> Shuffle Choice
          </label>
          <label>
            <input type="checkbox" id="hidden" name="hidden"  value='1'> hidden
          </label>
        </div>

        <div class="row">
          <div class="col-md-12">         
              <h4>Question</h4>
                  <textarea name="editor" id="editor">
                  <?=$cont_detail?>
                  </textarea>
          </div>
          <input type="hidden" name="question" id="question">
        </div>
        
        <h4>Answers</h4>

        <div class="bg-gray" >
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Choice 1 </label>
                <textarea name="editor1" id="editor1">
                  <?=$cont_detail?>
                  </textarea>
                  <input type="hidden" name="ch1" id="ch1">
                  <label>Grade </label> 
                  <select name="Grade1" id="Grade1">
                  <option value="1">100%</option>
                  <option value="0.5">50%</option>
                  <option value="0" selected>0</option>
                  </select>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gray" style="margin-top:10px;">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Choice 2 </label>
                <textarea name="editor2" id="editor2">
                  <?=$cont_detail?>
                  </textarea>
                  <input type="hidden" name="ch2" id="ch2">
                  <label>Grade </label> 
                  <select name="Grade2" id="Grade2">
                  <option value="1">100%</option>
                  <option value="0.5">50%</option>
                  <option value="0" selected>0</option>
                  </select>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gray" style="margin-top:10px;">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Choice 3 </label>
                <textarea name="editor3" id="editor3">
                  <?=$cont_detail?>
                  </textarea>
                  <input type="hidden" name="ch3" id="ch3">
                  <label>Grade </label> 
                  <select name="Grade3" id="Grade3">
                  <option value="1">100%</option>
                  <option value="0.5">50%</option>
                  <option value="0" selected>0</option>
                  </select>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gray" style="margin-top:10px;">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Choice 4 </label>
                <textarea name="editor4" id="editor4">
                  <?=$cont_detail?>
                  </textarea>
                  <input type="hidden" name="ch4" id="ch4">
                  <label>Grade </label> 
                  <select name="Grade4" id="Grade4">
                  <option value="1">100%</option>
                  <option value="0.5">50%</option>
                  <option value="0" selected>0</option>
                  </select>
              </div>
            </div>
          </div>
        </div>



    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-flat"><?=$btn?></button>
      </div>

      <script type="text/javascript" >  
       CKEDITOR.replace( 'editor',{ height: '200px' } );
       CKEDITOR.replace( 'editor1',{ height: '100px' } );
       CKEDITOR.replace( 'editor2',{ height: '100px' } );
       CKEDITOR.replace( 'editor3',{ height: '100px' } );
       CKEDITOR.replace( 'editor4',{ height: '100px' } );
        </script>
<?php
}else if($type=="imp"){
  $btn = "Save changes";
  ?>
      <input type="hidden" name="action" value="<?=$type?>">
      <input type="hidden" name="id" value="<?=@$id?>">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            
              <label>Import Csv file</label>
    
              <div class="box-body">
                    <form action="ajax/AEDModule.php" class="dropzone" id="dropzoneFrom" enctype="multipart/form-data"></form>
                  </div>
            
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <button type="button" id="submit-all" class="btn btn-success btn-flat ">Upload File</button>
      </div>
      <script>
     
      // DropZone
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
      // DropZone

      // Editor
    



      </script>

  <?php


}
?>

    
