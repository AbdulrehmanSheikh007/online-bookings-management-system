/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$('.smartlane-tbl').DataTable({
    "lengthChange": false,
    "paging": false,
    "info": false
});

function copy_referral(btn) {
    var copyText = document.getElementById("referral_link");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    $(btn).find(".copy-text").text("Coppied!");

    setTimeout(function () {
        $(btn).find(".copy-text").text("Copy");
    }, 2000);

}

function chooseFile(element) {
    element.querySelector('input').click();
}

$('.file-upload-btn input[type="file"]').change(function (e) {
    var file = e.target.files[0];
    var fileName = file.name;
    var fileType = file.type.toLowerCase();

    if (fileType == "image/jpeg" || fileType == "image/jpg" || fileType == "image/png") {
        $(this).prev().removeClass('fa-upload fa-times').addClass('fa-check white');
        $(this).prev().text(" File Choosen " + fileName.substr(0, 10));

        var attr = $(this).attr('is_photo');
        if (typeof attr !== typeof undefined && attr !== false) {
            var img = $(this).parent().parent().prev();
            if (img.hasClass('image-display')) {
                var tmppath = URL.createObjectURL(file);
                img.fadeOut(function () {
                    img.attr("src", tmppath);
                    img.fadeIn();
                });
            }
        }
    } else {
        $(this).val('');
        $(this).prev().removeClass('fa-upload fa-check').addClass('fa-times white');
        $(this).prev().text(" File type " + fileType + " not allowed.");
    }

});

//SET ROLES & RIGHTS CHECKBOXES CLICKS
$(".parent-module-checkbox").click(function () {
    var parent = $(this);
    var child = parent.parent().parent().next().find('input[type="checkbox"]');
    if (parent.prop('checked')) {
        child.each(function () {
            $(this).prop("checked", true);
        });
    } else {
        child.each(function () {
            $(this).prop("checked", false);
        });
    }
});

$(".child-checkbox").click(function () {
    var item = $(this);
    var total_checked = item.parent().parent().parent().find('input[type="checkbox"]:checked').length;
    var total_boxes = item.parent().parent().parent().find('input[type="checkbox"]').length;
    if (total_checked == total_boxes) {
        item.parent().parent().parent().prev().find('input[type="checkbox"]').prop("checked", true);
    } else {
        item.parent().parent().parent().prev().find('input[type="checkbox"]').prop("checked", false);
    }
});

$("#check_all").click(function () {
    var checkbox = $(this);
    if (checkbox.prop('checked')) {
        alertify.confirm('Do you really wants to select all?', function () {
            $(".parent-module-checkbox").prop("checked", true);
            $(".child-checkbox").prop("checked", true);
        }, function () {
            checkbox.prop('checked', false);
        }).setHeader('<em>Are you sure?</em>');
    } else {
        alertify.confirm('Do you really wants to unselect all?', function () {
            $(".parent-module-checkbox").prop("checked", false);
            $(".child-checkbox").prop("checked", false);
        }, function () {
            checkbox.prop('checked', true);
        }).setHeader('<em>Are you sure?</em> ');
    }
});

//Alertify For Delete Confirmation
$('.delete-form-btn').click(function () {
    var submitBtn = $(this).next('.deleteSubmit');
    alertify.confirm('You will not be able to recover this record!', function () {
        //code for yes confirmation
        submitBtn.click();
    }, function () {
        //code for no confirmation 
        alertify.notify('Delete operation denied.', 'success', 5);
    }).setHeader('<em>Are you sure?</em> ');
});

//Tooltip
$('[data-toggle="tooltip"]').tooltip({animation: true, placement: "top"});
var datepickers = ['date_to', 'date_from'];
for (var i = 0; i < datepickers.length; i++) {
    $("." + datepickers[i]).daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2019,
        maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            format: 'DD-MM-Y'
        }
    });
}

$(".datetime_range").daterangepicker({
    timePicker: true,
    showDropdowns: true,
    minYear: 2019,
    autoUpdateInput: false,
    maxYear: parseInt(moment().format('YYYY'), 10),
    locale: {
        format: 'DD-MM-Y hh:mm A',
        cancelLabel: 'Clear'
    }
}, function (start, end, label, event) {
    console.log('New date range selected: ' + start.format('DD-MM-Y hh:mm A') + ' to ' + end.format('DD-MM-Y hh:mm A'));
});

$(".datetime_range").on('apply.daterangepicker', function (ev, picker) {
    $(this).val(picker.startDate.format('DD-MM-Y hh:mm A') + ' to ' + picker.endDate.format('DD-MM-Y hh:mm A'));
});

$(".datetime_range").on('cancel.daterangepicker', function (ev, picker) {
    $(this).val('');
});

$(".btn_import_csv").click(function () {
    $("#import_csv").click();
});

$("#import_csv").change(function () {
    var validExtensions = ["csv"];
    var file = $(this).val().split('.').pop();
    if (validExtensions.indexOf(file) == -1) {
        alertify.notify('Invalid File Type.', 'error', 5);
        var fontAwesome = $(".btn_import_csv").find(".fa");
        fontAwesome.removeClass("fa-upload").addClass("fa-times");
        fontAwesome.text(" File type " + file + " not allowed.");
    } else {
        var fontAwesome = $(".btn_import_csv").find(".fa");
        fontAwesome.removeClass("fa-upload").removeClass("fa-times").addClass("fa-check");
        fontAwesome.text(" CSV Attached");

        var submitBtn = $('.import_csv_form');
        alertify.confirm('Your data will be imported directly to the database!', function () {
            //code for yes confirmation
            fileUpload($("#import_csv"));
        }, function () {
            //code for no confirmation 
            alertify.notify('Operation denied.', 'error', 5);
            $("#import_csv").val("");
        }).setHeader('<em>Are you sure?</em> ');
    }
});

function fileUpload(files) {
    var formData = new FormData();
    formData.append('import_csv', files[0].files[0]);
    formData.append('_token', $("meta[name='csrf-token']").attr("content"));
    $('.progress').show();
    $.ajax({
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $('.progress-bar').css('width', percentComplete + "%");
                    $('.progress-bar').html(percentComplete + "%");
                    if (percentComplete === 100) {

                    }
                }
            }, false);
            return xhr;
        },
        url: APP_URL + "/financial-portal/import-csv",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (result) {
            $("#import_csv").val("");
            alert(result);
            console.log(result);
        }
    });
}