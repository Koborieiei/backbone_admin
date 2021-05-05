$( document ).ajaxStart(function() {
  $(".loadingImg").removeClass('none');
});

$( document ).ajaxStop(function() {
  $(".loadingImg").addClass('none');
});

function showProcessbar(){
  // $.smkProgressBar({
  //   element:'body',
  //   status:'start',
  //   bgColor: '#000',
  //   barColor: '#fff',
  //   content: 'Loading...'
  // });
  // setTimeout(function(){
  //   $.smkProgressBar({
  //     status:'end'
  //   });
  // }, 1000);
}

function dateThToEn(date,format,delimiter)
{
    var formatLowerCase=format.toLowerCase();
    var formatItems=formatLowerCase.split(delimiter);
    var dateItems=date.split(delimiter);
    var monthIndex=formatItems.indexOf("mm");
    var dayIndex=formatItems.indexOf("dd");
    var yearIndex=formatItems.indexOf("yyyy");
    var month=parseInt(dateItems[monthIndex]);
    month-=1;

    var yearth = dateItems[yearIndex];
    if( yearth > 2450){
      yearth -= 543;
    }
    var dateth = new Date(yearth,month,dateItems[dayIndex]);
    var dateEN = dateth.getFullYear() + "/" + ("0" + (dateth.getMonth() +　1)).slice(-2) + "/" + ("0" + (dateth.getDate())).slice(-2);
    return dateEN;
}


function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}

function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function GenPass(type=0,num=8) {

  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  if(type == 0){
    text = 'passw0rd';
  }else{
    for (var i = 0; i < num; i++){
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
  }
  return text;
}

function showSlidebar(){
  $.get( "../../inc/function/slidebar.php" )
  .done(function( data ) {
    $("#showSlidebar").html(data);
  });
}

function readURL(input,values) {

  if (input.files) {
      var filesAmount = input.files.length;
      $('#'+values).html('');
      for (i = 0; i < filesAmount; i++) {
          checkTypeImage(input,values);
          var reader = new FileReader();
          reader.onload = function(event) {
              $($.parseHTML("<img width='100'>")).attr('src', event.target.result).appendTo('#'+values);
          }
          reader.readAsDataURL(input.files[i]);
      }

  }
}

function checkTypeImage(input,values){
  var file = input.files[0];
  var fileType = file["type"];
  var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
  if ($.inArray(fileType, validImageTypes) < 0) {
      alert('ประเภทไฟล์ไม่ถูกต้อง');
      $('#'+values).html('');
      input.value = '';
  }
}


function postURLBlank(url, multipart) {
 var form = document.createElement("FORM");
 form.method = "POST";
 if(multipart) {
   form.enctype = "multipart/form-data";
 }
 form.style.display = "none";
 document.body.appendChild(form);
 form.target="_blank";
 form.action = url.replace(/\?(.*)/, function(_, urlArgs) {
   urlArgs.replace(/\+/g, " ").replace(/([^&=]+)=([^&=]*)/g, function(input, key, value) {
     input = document.createElement("INPUT");
     input.type = "hidden";
     input.name = decodeURIComponent(key);
     input.value = decodeURIComponent(value);
     form.appendChild(input);
   });
   return "";
 });
 form.submit();
}
