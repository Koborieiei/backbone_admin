<?php
session_start();
include "../../../inc/function/connect.php";
header("Content-type:text/html; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

// All variable name is changed to look more precisely.
$action = $_POST["action"];
$skillId = $_POST["skillId"];
$importType = $_POST["importType"];
$questionId = $_POST["questionId"];

if ($importType == "qmanage") {

  if ($action == "EDIT") {
    $btn = "บันทึก";
    $sqlCommand = 'SELECT *, a.id as choiceid FROM `et_question_choice` as a  INNER JOIN et_question as b on a.question = b.uuid where b.id = ' . $questionId . '
        ORDER BY `a`.`fraction`  DESC ';
    $questionQuery = DbQuery($sqlCommand, null);
    $questionData = json_decode($questionQuery, true);

    // print_r($questionData['data']);
  }
  if ($action == "ADD") {
    $btn = "เพิ่ม";
  }
?>
  <input type="hidden" name="action" value="<?= $action ?>">
  <input type="hidden" name="questionId" value="<?= @$questionId ?>">
  <input type="hidden" name="ch1Id" value="<?= @$questionData['data'][0]['choiceid'] ?>">
  <input type="hidden" name="ch2Id" value="<?= @$questionData['data'][1]['choiceid'] ?>">
  <input type="hidden" name="ch3Id" value="<?= @$questionData['data'][2]['choiceid'] ?>">
  <input type="hidden" name="ch4Id" value="<?= @$questionData['data'][3]['choiceid'] ?>">

  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>ลักษณะคำถาม : </label>
          <!-- Change select name -->
          <select name="questionType" id="type">
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
          <label>ทักษะที่เกี่ยวข้อง : </label>
          <select name="skill" id="skill">
            <option value="0">none</option>
            <?php
            $sql = "SELECT * FROM tb_skill ORDER BY hs_id DESC";
            $query = DbQuery($sql, null);
            $row = json_decode($query, true);
            if ($row['dataCount'] > 0) {
              foreach ($row['data'] as $key => $value) {
            ?>
                <!-- I did change $key to hs_id because value need to be the same as skill id otherwise I won't related to skill -->
                <option value="<?= $value['hs_id'] ?>" <?php if ($skillId == $value['hs_id']) {
                                                          echo "selected";
                                                        } ?>><?= $value['hs_name'] ?></option>
            <?php }
            } ?>
          </select>
        </div>
      </div>
    </div>

    <div class="checkbox">
      <label>
        <input type="checkbox" id="Shuffle" name="Shuffle" value='1' <?= $questionData['data'][0]['shuffle'] == '1' ? 'checked' : '' ?>> สลับคำตอบ
      </label>
      <label>
        <input type="checkbox" id="hidden" name="hidden" value='1' <?= $questionData['data'][0]['hidden'] == '1' ? 'checked' : '' ?>> ซ่อนคำถาม
      </label>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h2><b>คำถาม</b></h2>
        <textarea name="editor" id="editor">
                  <?= $questionData['data'][0]['q_text'] ?>
                  </textarea>
      </div>
      <input type="hidden" name="question" id="question">
    </div>

    <hr>

    <h2><b>คำตอบ</b></h2>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">

          <h3>คำตอบที่ 1</h3>
          <textarea name="editor1" id="editor1">

                  <?= $questionData['data'][0]['c_text'] ?>

                  </textarea>
          <input type="hidden" name="ch1" id="ch1">


          <div style="width: 100%;display: inline-flex;align-items: center;
">

            <h3 class="mt-0">คะแนน</h3>

            <div style="margin-left:10px;">
              <select class="form-control" name="Grade1" id="Grade1">
                <option <?=

                        $questionData['data'][0]['fraction'] == '0.0000000' ? 'selected' : ''
                        ?> value="0">0</option>
                <option <?=

                        $questionData['data'][0]['fraction'] == '0.5000000' ? 'selected' : ''
                        ?> value="0.5">50%</option>
                <option <?=

                        $questionData['data'][0]['fraction'] == '1.0000000' ? 'selected' : ''
                        ?> value="1">100%</option>


              </select>


            </div>




          </div>

        </div>
      </div>
    </div>

    <hr>


    <div class="row">
      <div class="col-md-12">
        <div class="form-group">

          <h3>คำตอบที่ 2</h3>
          <textarea name="editor2" id="editor2">

                  <?= $questionData['data'][1]['c_text'] ?>

                  </textarea>
          <input type="hidden" name="ch2" id="ch2">


          <div style="width: 100%;display: inline-flex;align-items: center;
">

            <h3 class="mt-0">คะแนน</h3>

            <div style="margin-left:10px;">
              <select class="form-control" name="Grade2" id="Grade2">
                <option <?= $selected =

                          $questionData['data'][1]['fraction'] == '0.0000000' ? 'selected' : ''
                        ?> value="0">0</option>
                <option <?= $selected =

                          $questionData['data'][1]['fraction'] == '0.5000000' ? 'selected' : ''
                        ?> value="0.5">50%</option>
                <option <?= $selected =

                          $questionData['data'][1]['fraction'] == '1.0000000' ? 'selected' : ''
                        ?> value="1">100%</option>


              </select>


            </div>




          </div>

        </div>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">

          <h3>คำตอบที่ 3</h3>
          <textarea name="editor3" id="editor3">

                  <?= $questionData['data'][2]['c_text'] ?>

                  </textarea>
          <input type="hidden" name="ch3" id="ch3">


          <div style="width: 100%;display: inline-flex;align-items: center;
">

            <h3 class="mt-0">คะแนน</h3>

            <div style="margin-left:10px;">
              <select class="form-control" name="Grade3" id="Grade3">
                <option <?= $selected =

                          $questionData['data'][2]['fraction'] == '0.0000000' ? 'selected' : ''
                        ?> value="0">0</option>
                <option <?= $selected =

                          $questionData['data'][2]['fraction'] == '0.5000000' ? 'selected' : ''
                        ?> value="0.5">50%</option>
                <option <?= $selected =

                          $questionData['data'][2]['fraction'] == '1.0000000' ? 'selected' : ''
                        ?> value="1">100%</option>


              </select>


            </div>




          </div>

        </div>
      </div>
    </div>

    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">

          <h3>คำตอบที่ 4</h3>
          <textarea name="editor4" id="editor4">

                  <?= $questionData['data'][3]['c_text'] ?>

                  </textarea>
          <input type="hidden" name="ch4" id="ch4">


          <div style="width: 100%;display: inline-flex;align-items: center;
">

            <h3 class="mt-0">คะแนน</h3>

            <div style="margin-left:10px;">
              <select class="form-control" name="Grade4" id="Grade4">
                <option <?= $selected =

                          $questionData['data'][3]['fraction'] == '0.0000000' ? 'selected' : ''
                        ?> value="0">0</option>
                <option <?= $selected =

                          $questionData['data'][3]['fraction'] == '0.5000000' ? 'selected' : ''
                        ?> value="0.5">50%</option>
                <option <?= $selected =

                          $questionData['data'][3]['fraction'] == '1.0000000' ? 'selected' : ''
                        ?> value="1">100%</option>


              </select>


            </div>




          </div>

        </div>
      </div>
    </div>

    <hr>



  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">ยกเลิก</button>
    <button type="submit" class="btn btn-primary btn-flat"><?= $btn ?></button>
  </div>

  <script type="text/javascript">
    CKEDITOR.replace('editor', {
      height: '200px'
    });
    CKEDITOR.replace('editor1', {
      height: '100px'
    });
    CKEDITOR.replace('editor2', {
      height: '100px'
    });
    CKEDITOR.replace('editor3', {
      height: '100px'
    });
    CKEDITOR.replace('editor4', {
      height: '100px'
    });
  </script>
<?php
} else if ($importType == "imp") {
  $btn = "Save changes";
?>
  <input type="hidden" name="action" value="<?= $importType ?>">
  <input type="hidden" name="questionId" value="<?= @$skillId ?>">
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
      addRemoveLinks: true,
      maxFilesize: 1000, // MB
      parallelUploads: 5,
      maxFiles: 5, // ไฟล์สูงสุด 5 ไฟล์
      dictDefaultMessage: "วางไฟล์",
      init: function() {
        var submitButton = document.querySelector('#submit-all');
        myDropzone = this;
        submitButton.addEventListener("click", function() {
          myDropzone.processQueue();
        });
        this.on("complete", function(file) {
          if (this.getQueuedFiles().length == 0) {
            var _this = this;
            _this.removeAllFiles();
            $.smkProgressBar({
              element: 'body',
              status: 'start',
              bgColor: '#000',
              barColor: '#fff',
              content: 'Loading...'
            });
            setTimeout(function() {
              $.smkProgressBar({
                status: 'end'
              });
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