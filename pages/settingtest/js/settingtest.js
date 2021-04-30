checkData();
showTable();

function showTable() {
    $.get("ajax/showTable.php")
        .done(function(data) {
            $("#showTable").html(data);
        });
}

function checkData() {
    $.post("ajax/AEDModule.php", { action: "CHECK" })
        .done(function(data) {
            console.log(data);
        });
}

function showForm(value = "", id = "", name = "") {
    $.post("ajax/formModule.php", { value: value, id: id, name: name })
        .done(function(data) {
            $("#myModal").modal("toggle");
            $("#show-form").html(data);
            checkFields();
        });
}

function checkFields() {
    var nq = $('#nq-ch').val()
    $('.nq_ch').each(function() {
        if ($(this).val() < nq) {
            $.smkAlert({
                text: $(this).val() + 'Have not question bank enough if submit status must be unactuive ' + nq,
                type: 'warning',
                position: 'top-center',
                time: 10
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
            data: new FormData(this),
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