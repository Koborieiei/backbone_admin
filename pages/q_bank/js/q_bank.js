showTable()
showTabs()

function showTable() {
 var skill_id = $('#skill_id').val()

 if (skill_id != 'null') {
  $.get('ajax/showTable.php', { skill_id: skill_id }).done(function (data) {
   $('#showTable').html(data)
  })
 } else {
  $.get('ajax/showTable.php').done(function (data) {
   $('#showTable').html(data)
  })
 }
}

function showTabs() {
 $.get('ajax/showTabs.php').done(function (data) {
  $('#showTabs').html(data)
 })
}

// I Change paremeters name which get a bit confuse na
function showForm(importType = '', action = '', skillId = '', questionId = '') {
 $('#uploadform').hide()
 $.post('ajax/formModule.php', {
  importType: importType,
  action: action,
  skillId: skillId,
  questionId: questionId,
 }).done(function (data) {
  $('#myModal').modal('toggle')
  $('#show-form').html(data)
 })
}

function showFormupload() {
 $('#uploadform').show()
 $('#myModal').modal('toggle')
 // $.post("ajax/formModuleUpload.php", { type: type, value: value, id: id })
 //     .done(function(data) {
 //
 //         $("#uploadform").html(data);
 //     });
}

function delModule(questionId) {
 $.smkConfirm(
  {
   text: 'คุณต้องการลบคำถามนี้?',
   accept: 'ตกลง',
   cancel: 'ยกเลิก',
  },
  function (res) {
   // Code here
   if (res) {
    $.post('ajax/AEDModule.php', {
     action: 'DEL',
     questionId: questionId,
    }).done(function (data) {
     $.smkProgressBar({
      element: 'body',
      status: 'start',
      bgColor: '#000',
      barColor: '#fff',
      content: 'Loading...',
     })
     setTimeout(function () {
      $.smkProgressBar({ status: 'end' })
      showTable()
      showSlidebar()
      $.smkAlert({ text: data.message, type: data.status })
     }, 1000)
    })
   }
  }
 )
}

$('#formAddModule').on('submit', function (event) {
 event.preventDefault()
 var editor = CKEDITOR.instances['editor'].getData()
 $('#question').val(editor)
 var editor1 = CKEDITOR.instances['editor1'].getData()
 $('#ch1').val(editor1)
 var editor2 = CKEDITOR.instances['editor2'].getData()
 $('#ch2').val(editor2)
 var editor3 = CKEDITOR.instances['editor3'].getData()
 $('#ch3').val(editor3)
 var editor4 = CKEDITOR.instances['editor4'].getData()
 $('#ch4').val(editor4)
 if ($('#formAddModule').smkValidate()) {
  $.ajax({
   url: 'ajax/AEDModule.php',
   type: 'POST',
   data: new FormData(this),
   processData: false,
   contentType: false,
   dataType: 'json',
  }).done(function (data) {
   $.smkProgressBar({
    element: 'body',
    status: 'start',
    bgColor: '#000',
    barColor: '#fff',
    content: 'Loading...',
   })
   setTimeout(function () {
    $.smkProgressBar({ status: 'end' })
    $('#formAddModule').smkClear()
    showTable()
    showSlidebar()
    $.smkAlert({ text: data.message, type: data.status })
    $('#myModal').modal('toggle')
   }, 1000)
  })
 }
})
