(function ($) {
    "use strict";

    /* ----------------------------------------------------------------
           [ Alert Auto Close Js ]
-----------------------------------------------------------------*/

    window.setTimeout(function() {
        $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);

    /* ----------------------------------------------------------------
                [ Prevent Multiple Submit Js ]
-----------------------------------------------------------------*/

    $('form').on('submit', function () {
        $(this).find(':submit').attr('disabled', 'true');
    });

    /* ----------------------------------------------------------------
              [ Fontawesome IconPicker Js ]
-----------------------------------------------------------------*/

    $('#iconPickerBtn').iconpicker();
    $('#iconPickerBtn2').iconpicker();


    $(".iconpicker-item").on("click", function() {
        var li = document.getElementById('icon-value');

        if (li.className === "null") {
            document.getElementById("icon").value = "";
        } else {
            document.getElementById("icon").value = li.className;
        }
    });

    $(".iconpicker-item").on("click", function() {
        var li2 = document.getElementById('icon-value2');

        if (li2.className === "null") {
            document.getElementById("icon2").value = "";
        } else {
            document.getElementById("icon2").value = li2.className;
        }
    });

    /* ----------------------------------------------------------------
           [ Fontawesome IconPicker Rtl Js ]
-----------------------------------------------------------------*/

    var hasRtl  = $('body').hasClass("rtl-version");

    if (hasRtl) {
        $('.iconpicker-search').attr('placeholder', 'اكتب للتصفية');
    }

}(jQuery));

// For type selection. enum('type', ['icon', 'image'])
function showHideTypeDiv() {
    "use strict";

    var optionsRadios1 = document.getElementById("optionsRadios1");
    var optionsRadios2 = document.getElementById("optionsRadios2");
    var iconType = document.getElementById("icon-type");
    var imageType = document.getElementById("image-type");
    iconType.style.display = optionsRadios1.checked ? "block" : "none";
    imageType.style.display = optionsRadios2.checked ? "block" : "none";
}

function copyImageLink(id) {
    "use strict";

    var copyText = document.getElementById("copyImageLink"+id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("{{ __('content.copied_text') }}" + ":" + copyText.value);
}

function copyLink(id) {
    "use strict";

    var copyText = document.getElementById("copyLink"+id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    alert("{{ __('content.copied_text') }}" + ":" + copyText.value);
}

// Delete checked list.
function showHideDeleteButton(source) {
    "use strict";
    var check_all = document.getElementById("check_all");
    deleteChecked.style.display = check_all.checked ? "inline" : "none";

    var checkboxes = document.getElementsByName('check_list[]');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}

function showHideDeleteButton2(source) {
    "use strict";
    deleteChecked.style.display = source.checked ? "inline": "inline";
}

// Get checkbox list
function btnCheckListGet() {
    "use strict";
    //Create an Array.
    var selected = new Array();

    //Reference the CheckBoxes and insert the checked CheckBox value in Array.
    $("#basic-datatable input[type=checkbox]:checked").each(function () {
        selected.push(this.value);
    });

    //Display the selected CheckBox values.
    if (selected.length > 0) {
        selected.join(",");
    }

    return document.getElementById("checked_lists").value = selected;
}