/* Doc Detector */
//if (typeof (datetimepicker) === 'undefined') { console.log('x Loaded Tempus Dominus - Not Loaded'); return; }
//if (typeof (datetimepicker) === 'undefined') { console.log('x Loaded Tempus Dominus - Not Loaded'); return; }
//if (typeof ($.datetimepicker) === 'undefined') { console.log('x Loaded Tempus Dominus - Not Loaded'); return; }
//if (typeof (jQuery.fn.datetimepicker) === 'undefined') { console.log('x Loaded Tempus Dominus - Not Loaded'); return; }
/* Doc Detector */


/**
 * Initialize function one when page ready.
 */
$(document).ready(function () {
    runSelect2();
    runCroppie();
    runInputmask();
    runTempusdominus();

});

/**
 * Some Function for logging with better view by Marshel Aldhi
 * @param string title
 * @param string desc
 */
function catat(title, desc) {
    if (desc) {
        console.log(title + ' : ' + desc);
    } else {
        console.log('===== ' + title + ' =====');
    }
}

/**
* Select2
*
* Ini merupakan fungsi untuk menginialisasi serta memanggil Library select2
*
*/
function runSelect2() {
    //console.log(typeof (select2noadd));
    //if (typeof (runSelect2) === 'undefined') { console.log('Failed Initialize Select2'); return; }
    //if (typeof (select2noadd) === 'undefined') { console.log('x Loaded Select2 - Not Loaded'); return; }
    //if (typeof (jQuery.fn.select2) === 'undefined') { console.log('x Loaded Select2 - Not Loaded'); return; }
    if (typeof ($.fn.select2) === 'undefined') { console.log('x Loaded Select2 - Not Loaded'); return; }
    catat('Initialize Select2');
    // inisialisasi select2

    $('.select2noadd').select2({
        language: {
            noResults: function () {
                return 'Data tidak ditemukan';
            }
        }
    });
    catat('Success', 'Select2 without button');

    $('.select2add').select2({
        language: {
            noResults: function () {
                return 'Data tidak ditemukan';
            }
        }
    })
        // append new value with new link
        .on("select2:open", function (e) {
            var elemid = e.currentTarget.id;

            $(document).on('keyup', '.select2-search__field', function (e) {
                if (!$(this).val()) {
                    $('#addnew-' + elemid).prop('disabled', true);
                } else {
                    $('#addnew-' + elemid).prop('disabled', false);

                }
            });

            $(".select2-results:not(:has(button))").append('<div class="tambah"><button disabled style="width: 100%" type="button" href="javascript();" class="btn btn-primary" id="addnew-' + elemid + '" onClick="tambah(' + elemid + ')"> Tambah baru</button></div>');
        });
    if (typeof (tambah) === 'undefined') { catat('Failed', 'Select2 with button'); } else { catat('Success', 'Select2 with button'); }

}

/**
 * Added Function for select2 if terms not found
 */
function tambah(elemid) {
    var select = $(elemid);
    var terms = select.data("select2").dropdown.$search.val(); // get & change select2 hidden textbox
    select.append("<option value=" + terms + " selected>" + terms + "</option>").val(terms); // change textbox with terms
    select.select2("close");
    catat('Added', terms + ' by select2');
}

/**
 * Inputmask - https://github.com/RobinHerbots/Inputmask
 *
 * Ini merupakan fungsi untuk menginialisasi serta memanggil Library inputmask
 * fungsi ini berfungsi untuk membantu pengguna memasukan data dengan format yang telah ditentukan
 * seperti tanggal, nomor angka, nomor telepon agar tidak salah dalam ketentuan format yang telah ditentukan.
 *
 */
function runInputmask() {
    if (typeof (jQuery.fn.inputmask) === 'undefined') { console.log('x Loaded Inputmask - Not Loaded'); return; }

    catat('Initialize Inputmask');

    Inputmask.extendAliases({
        mata_uang: {
            alias: "numeric",
            groupSeparator: ",",
            autoGroup: true,
            placeholder: "0",
            digits: 3,
            radixPoint: ".",
            clearMaskOnLostFocus: false,
            /*             isComplete : function(key, result){
                            console.log(result);
                            // if (!result){
                            // alert('Your input is not valid')
                            // }
                        }, */
            removeMaskOnSubmit: true
        },
        nip: {
            mask: "99999999 999999 9 999",
            removeMaskOnSubmit: true
        },
        npwp: {
            mask: "99.999.999.9-999.999",
            removeMaskOnSubmit: true
        },
        nilai: {
            alias: "numeric",
            groupSeparator: ",",
            autoGroup: true,
            placeholder: "",
            digits: 3,
            radixPoint: ".",
            clearMaskOnLostFocus: true,
            removeMaskOnSubmit: true
        },
        masa_kerja: {
            //integerDigits: 9,
            alias: "numeric",
            mask: "99",
            //digitsOptional: false,
            numericInput: true,
            //autoGroup: true,
            //groupSeparator: ",",
            //placeholder: "0",
            removeMaskOnSubmit: true
        },

    });

    $(".mata_uang").inputmask({ alias: "mata_uang" });
    $("#nip").inputmask({ alias: "nip" });
    $("#npwp").inputmask({ alias: "npwp" });
    $(".nilai").inputmask({ alias: "nilai" });
    $(".masa_kerja").inputmask({ alias: "masa_kerja" });
    /*
    $("form").submit(function (e) {
        $('[data-send="inputunmask"]').css('color', 'green');
        if ($('[data-send="inputunmask"]').length)         // use this if you are using id to check
        {
            alert('input mas');
        }

        var id = $(this).data("id");
        $(id).each(function () {
            alert($(this).data("value"));
        });

        //$('input[data-send="sendUmask"]').unmask();
        //$('input[data-toggle="sendUmask"]').unmask();
        //$([data-toggle="sendUmask"]).unmask();
        // e.preventDefault();
        // var formId = this.id;  // "this" is a reference to the submitted form
    });
    */
}

/**
 * Tempus Dominus - https://github.com/tempusdominus/bootstrap-4
 * Ini merupakan fungsi untuk menginialisasi serta memanggil Library Datetimepicker dari Tempus Dominus
 *
 */
function runTempusdominus() {
    if (typeof (jQuery.fn.datetimepicker) === 'undefined') { console.log('x Loaded Tempus Dominus - Not Loaded'); return; }

    catat('Initialize Tempus Dominus BS4');

    $('#month_years').datetimepicker({
        viewMode: 'years',
        format: 'MM/YYYY',
        //daysOfWeekDisabled: [0, 6],
        useCurrent: false, // clear fill until date selected
        //maxDate: new Date()
        maxDate: moment().millisecond(999).second(59).minute(59).hour(23) // disable date from now
    });

    $('#tanggal_lahir').datetimepicker({
        viewMode: 'years',
        format: 'DD/MM/YYYY',
        //daysOfWeekDisabled: [0, 6],
        useCurrent: false, // clear fill until date selected
        //maxDate: new Date()
        maxDate: moment().millisecond(999).second(59).minute(59).hour(23) // disable date from now
    });

    $('#hari_kerja').datetimepicker({
        //viewMode: 'years',
        format: 'DD/MM/YYYY',
        daysOfWeekDisabled: [0, 6],
        useCurrent: false, // clear fill until date selected
    });

    /*     $("form").submit(function (event) {
            console.log(event);
            return false;
        }); */

}

/**
 * Croppie - http://foliotek.github.io/Croppie/
 *
 * Ini merupakan fungsi untuk menginialisasi serta memanggil Library croppie
 * fungsi ini berfungsi untuk membantu pengguna memasukan data dengan format yang telah ditentukan
 * seperti tanggal, nomor angka, nomor telepon agar tidak salah dalam ketentuan format yang telah ditentukan.
 *
 */
var frame_width = "220";
var frame_height = "290";
var xwidth = "216";
var xheight = "288";

//var $uploadCrop;
var $uploadCrop = $('#upload-demo');
function initCroppie() {
    // resize foto frame before
    //$(".avatar").attr("style","height: "+frame_height+"px;width: "+frame_width+"px;");
    $(".upload-msg").attr("style", "height: " + frame_height + "px;width: " + frame_width + "px;");

    // hide unesary action before
    //$("#reset").hide();
    $(".desc_drag").hide();
}

function runCroppie() {
    if (typeof (jQuery.fn.croppie) === 'undefined') { console.log('x Loaded Croppie - Not Loaded'); return; }
    catat('Initialize Croppie');


    initCroppie();
    if (typeof avatar === 'undefined' || avatar === null || avatar === '') {
        catat("Detect ", "Image Kosong");
        $uploadCrop.croppie({
            viewport: {
                width: xwidth,
                height: xheight,
                type: 'square'
            },
            boundary: {
                width: frame_width,
                height: frame_height
            },
        });
    } else {
        catat("Detect ", "Image Ada");
        $uploadCrop.croppie({
            viewport: {
                width: xwidth,
                height: xheight,
                type: 'square'
            },
            boundary: {
                width: frame_width,
                height: frame_height
            },
            url: avatar,
        });
        $(".upload-msg").hide();
        $("#upload-demo").show();
        $(".buttons").show();
    }
    catat("Success ", "Initialize Croppie");
}

$(".upload-msg").click(function () {
    catat('Open', 'Browse image file by croppie');
    $("#upload").click();
})

////this works but wont let me set a new readFile input
$("#reset").click(function reset() {
    $('.upload-demo').removeClass('ready');
    $("#upload-demo").hide();
    $(".upload-msg").show();
    //$(".cr-image").removeAttr("style");

    catat('Prosses', 'Reset Image ready by croppie');

    $('#foto').val(''); // this will clear the input foto val.
    catat('Prosses', 'Reset Input value by croppie');

    $(".buttons").attr("style", "display: none");
    $(".desc_drag").attr("style", "display: none");
    catat('Prosses', 'Reset hide button & small description by croppie');


    $(".cr-image").removeAttr("style");
    $(".cr-image").removeAttr("transform");
    $(".cr-image").removeAttr("transform-origin");
    $(".cr-image").removeAttr("src");
    catat('Prosses', 'Reset boundary by croppie');

    $(".cr-overlay").removeAttr("style");
    catat('Prosses', 'Reset Overlay by croppie');

    // hide slider
    $(".cr-slider-wrap").hide();
    $(".cr-slider").removeAttr("min");
    $(".cr-slider").removeAttr("max");
    $(".cr-slider").removeAttr("aria-valuenow");
    catat('Prosses', 'Reset hide Slider by croppie');
    return false; // for disable returning action if using button
});

/*
function popupResult(result) {
    console.log('popup');
    var html;
    if (result.html) {
        console.log('popup result html');
        html = result.html;
    }
    if (result.src) {
        console.log('popup result scr');
        html = '<img src="' + result.src + '" />';
    }
    $("#result").html(html);
}
*/


function readFile(input) {

    if (input.files && input.files[0]) {
        catat('Selected', 'Image selected by croppie');
        if (/^image/.test(input.files[0].type)) { // only image file
            catat('Success', 'Image selected by croppie');
            $("#upload-demo").show();
            $(".upload-msg").hide();
            $(".cr-slider-wrap").show();
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function () {
                    catat('Proses', 'Handle crop image by default, for minimalize null input image for unwanted error ');
                    Selectedimages();
                });
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            catat('Selected', 'You not selected image by croppie');
            reset();
            alert("Kamu hanya diperbolehkan memilih file gambar yang telah ditentukan.");
        }
    } else {
        console.log('readfile not support');
        reset();
        alert("Maaf - Terjadi kesalahan coba lagi, jika kejadian berulang coba untuk memperbaharui browser anda");
    }
}


$('#upload').on('change', function () {
    readFile(this);
    // show unesary action after
    $(".buttons").attr("style", "display: block");
    $(".desc_drag").show();

});

function Selectedimages() {
    $uploadCrop.croppie('result', {
        type: 'base64',
        size: 'viewport'
    }).then(function (resp) {
        $("#foto").attr("value", resp);
        catat('Prosses', 'Updating Input Value');
        //return false;
        /* popupResult({
            src: resp
        }); */
    });
    catat('Success', 'Image crop by cropie');
};


$('#upload-result').on('click', function (ev) {
    catat('Success', 'Image cropping manualy by cropie');
    Selectedimages();
});

/* This function button for Add data form
 * this effect to change value to save to index or save & back to same page again
 */
$('#saveback').click(function () {
    $("#submit").prop('value', 'saveback');
    $("#submit").html('Save & Back');
});

$('#save').click(function () {
    $("#submit").prop('value', 'save');
    $("#submit").html('Save');
});


$('#password').keyup(function () {
    var password = $('#password').val();
    if (checkStrength(password) == false) {
        $('#sign-up').attr('disabled', true);
    }
});

function checkStrength(password) {
    var strength = 0;

    //If password contains both lower and uppercase characters, increase strength value.
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
        strength += 2;
    }

    //If it has numbers and characters, increase strength value.
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
        strength += 2;
    }

    //If it has one special character, increase strength value.
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 2;
    }

    if (password.length > 7) {
        strength += 1;
    }

    if (password.length < 8) {
        strength = 1;
    }

    if (password.length > 15) {
        strength += 2;
    }

    if (password.length == 0) {
        strength = 0;
    }

    if (strength == 0) {
        //$('#result').removeClass();
        $('#password-strength').css('width', '0%');
    } else if (strength < 3) {
        $('#password-strength').addClass('bg-danger');
        $('#password-strength').text('Sangat Lemah');
        $('#password-strength').css('width', '10%');
    } else if (strength == 3) {
        $('#password-strength').text('Lemah');
        $('#password-strength').removeClass('bg-warning');
        $('#password-strength').addClass('bg-danger');
        $('#password-strength').css('width', '40%');
    } else if (strength == 5) {
        $('#password-strength').text('Sedang');
        $('#password-strength').removeClass('bg-danger');
        $('#password-strength').addClass('bg-warning');
        $('#password-strength').css('width', '60%');
    } else if (strength == 7) {
        $('#password-strength').text('Kuat');
        $('#password-strength').removeClass('bg-warning');
        $('#password-strength').addClass('bg-success');
        $('#password-strength').css('width', '100%');
    }
}

$('#password_verify').keyup(function () {
    if ($('#password').val() !== $('#password_verify').val()) {
        $('#password_verify').removeClass('is-valid');
        $('#password_verify').addClass('is-invalid');
    } else {
        $('#password_verify').removeClass('is-invalid');
        $('#password_verify').addClass('is-valid');
    }
});
