showTable();
showTabs();

function showTable() {
    var skill_id = $("#skill_id").val();

    if (skill_id != "null") {
        $.get("ajax/showTable.php", { skill_id: skill_id })
            .done(function(data) {
                $("#showTable").html(data);
            });
    } else {
        $.get("ajax/showTable.php")
            .done(function(data) {
                $("#showTable").html(data);
            });
    }


}

function showTabs() {
    $.get("ajax/showTabs.php")
        .done(function(data) {
            $("#showTabs").html(data);
        });
}

function showForm(value = "", id = "") {
    $.post("ajax/formModule.php", { value: value, id: id })
        .done(function(data) {
            $("#myModal").modal("toggle");
            $("#show-form").html(data);
        });
}

function delModule(id) {
    $.smkConfirm({
        text: 'Are You Sure Delete Module?',
        accept: 'Yes',
        cancel: 'No'
    }, function(res) {
        // Code here
        if (res) {
            $.post("ajax/AEDModule.php", { action: 'DEL', id: id })
                .done(function(data) {
                    $.smkProgressBar({
                        element: 'body',
                        status: 'start',
                        bgColor: '#000',
                        barColor: '#fff',
                        content: 'Loading...'
                    });
                    setTimeout(function() {
                        $.smkProgressBar({ status: 'end' });
                        showTable();
                        showSlidebar();
                        $.smkAlert({ text: data.message, type: data.status });
                    }, 1000);
                });
        }
    });
}

function updateModule(id) {
    $.smkConfirm({
        text: 'Are You Sure To Set This Card?',
        accept: 'Yes',
        cancel: 'No'
    }, function(res) {
        // Code here
        if (res) {
            var skill_id = $("#skill_id").val();
            $.post("ajax/AEDModule.php", { action: 'UPDATE', id: id, skill_id: skill_id })
                .done(function(data) {
                    $.smkProgressBar({
                        element: 'body',
                        status: 'start',
                        bgColor: '#000',
                        barColor: '#fff',
                        content: 'Loading...'
                    });
                    setTimeout(function() {
                        $.smkProgressBar({ status: 'end' });
                        showTable();
                        showSlidebar();
                        $.smkAlert({ text: data.message, type: data.status });
                    }, 1000);
                });
        }
    });
}

$("#formAddModule").on("submit", function(event) {
    event.preventDefault();
    if ($("#formAddModule").smkValidate()) {
        var skill_id = $("#skill_id").val();
        var Formdata = new FormData(this);
        Formdata.append('skill_id', skill_id);
        $.ajax({
            url: "ajax/AEDModule.php",
            type: "POST",
            data: Formdata,
            processData: false,
            contentType: false,
            dataType: "json"
        }).done(function(data) {
            $.smkProgressBar({
                element: "body",
                status: "start",
                bgColor: "#000",
                barColor: "#fff",
                content: "Loading..."
            });
            setTimeout(function() {
                $.smkProgressBar({ status: "end" });
                $("#formAddModule").smkClear();
                showTable();
                showSlidebar();
                $.smkAlert({ text: data.message, type: data.status });
                $("#myModal").modal("toggle");
            }, 1000);
        });
    }
});

function CopyMessage(value) {
    var copyText = document.getElementById(value);
    copyText.select();
    document.execCommand("copy");
    copyText.value;
    $.smkAlert({ text: 'Copied', type: 'success' });
}

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
                    $.smkProgressBar({ status: 'end' });
                    showTable();
                    showSlidebar();

                }, 1000);

            }


        });
    },
};