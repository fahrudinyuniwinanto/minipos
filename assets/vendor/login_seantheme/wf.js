$(document).ready(function() {
    oSetInputValidation();

});

function oSetInputValidation() {
    $('.numeric').keyup(function() {
        var start = this.selectionStart,
            end = this.selectionEnd;
        this.value = this.value.replace(/[^0-9\.]/g, '');
        this.setSelectionRange(start, end);
    });
    $('.letteric').bind('keyup blur', function() {
        var start = this.selectionStart,
            end = this.selectionEnd;
        var node = $(this);
        node.val(node.val().replace(/[^a-z\ ]/g, ''));
        this.setSelectionRange(start, end);
    });
    $('.text-uppercase').keyup(function() {
        var start = this.selectionStart,
            end = this.selectionEnd;
        this.value = this.value.toUpperCase();
        this.setSelectionRange(start, end);
    });
    $('.text-lowercase').focusout(function() {
        var start = this.selectionStart,
            end = this.selectionEnd;
        this.value = this.value.toLowerCase();
        this.setSelectionRange(start, end);
    });
    $('.preventsubmit').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    $('input.date').datepicker({
        format: 'yyyy/mm/dd',
        orientation: "auto",
        autoclose: true,
        todayHighlight: true
    });
    $('.date-ym').datepicker({
        format: "yyyy/mm",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
    $('.date-m').datepicker({
        format: "mm",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true
    });
    $('.date-y').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true
    });

}

function fNum(a) {
    var x = a.toString().split('.')
    a = x[0]
    b = a.replace(/[^\d]/g, "");

    if (b < -922337203685477 || b > 922337203685477) {
        b = "922337203685477";
    }
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
            c = b.substr(i - 1, 1) + "," + c;
        } else {
            c = b.substr(i - 1, 1) + c;
        }
    }
    if (x[1] == undefined) {
        ret = c;
    } else {
        ret = c + '.' + x[1];
    }
    return ret;
}

function oLoadPagination(selector, fn) {
    $(selector + ' .pagination a').on('click', function(event) {
        event.preventDefault();
        if ($(this).attr('href') != '#') {
            // $("html, body").animate({
            //     scrollTop: 0
            // }, "fast");
            $(selector).load($(this).attr('href'), function() {
                oLoadPagination(selector, fn);
            });
        }
    });
    if (fn) fn();
}

function copyToClipboard(element) {
    var $temp = $("<textarea>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

function sfdialog(id, caption, size, fn) {
    /**
    contoh pakai :
    sfdialog("symenu", "Cari Menu", "modal-sm", function(){
                    $("#sfdialog-symenu .modal-body").html('test body');
                });
    **/

    var str=`<div class="modal in" id="`+id+`" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: block; padding-right: 17px;">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> × </span>
                    </button>
                    <h4 class="modal-title text-navy" id="myModalLabel">Lookup Data </h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>`;
        if (!$("#sfdialog-" + id).length) {
            $("body").append("<div id='" + "sfdialog-" + id + "'></div>");
        }
        $("#sfdialog-" + id).html(data);
        if (fn) fn();
    
   /*  $.post("CIndex/getSfdialog", { id: id, caption: caption, size: size }, function(data) {
        if (!$("#sfdialog-" + id).length) {
            $("body").append("<div id='" + "sfdialog-" + id + "'></div>");
        }
        $("#sfdialog-" + id).html(data);
        if (fn) fn();
    }); */
}

function sflookup(url, fn) {
    var id = 'sflookup-d-' + url.replace(/[^a-z0-9]/gi, '');
    sfdialog(id, "Lookup Data", "modal-lg", function() {
        sflookupsearch(id, url, fn);
    });
}


function sflookupsearch(id, url, fn) {
    if (!$("#" + id + " .modal-body input.q-search").length) {
        var q = '';
    } else {
        var q = $("#" + id + " .modal-body input.q-search").val();
    }
    if (url.indexOf("?") >= 0) {
        var opr = "&";
    } else {
        var opr = "?";
    }
    $("#" + id + " .modal-body").load(url + opr + "q=" + q, function() {
        oLoadPagination("#" + id + " .modal-body", function() {
            sflookupevent(id, url, fn)
        });
        // sflookupevent(id, url, fn);
    });

}

function sflookupevent(id, url, fn) {
    $("#" + id + " .modal-body input.q-search").on("keydown", function(e) {
        if (e.keyCode == 13)
            sflookupsearch(id, url, fn);
    });
    $("#" + id + " .modal-body span.btn-search").on("click", function(e) {
        sflookupsearch(id, url, fn);
    });
    $("#" + id + " .modal-body table tr.onclicktrlookup").on('click', function() {
        if (fn) {
            fn($(this).attr('data-id'), $(this).attr('data-name'), $(this).attr('data-json'));
            $("#" + id).modal('hide');
        }
    });
    $("#" + id + " .modal-body input.q-search").focus()
}

function exportExcel(id) {
    window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#' + id).html()));
}

//CARA PANGGIL tableToExcel()
// wajib ada <a hidden dan ada 3 parameter tableToExcel('id_table','tab excel','excel name')
/* <a id="dlink"  style="display:none;"></a>
            <button type="button" class="btn btn-sm btn-info" onclick="tableToExcel('table-formasi','data','Data Formasi')">Export Excel</button> */

var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();

        }
    })()

function html2popup(id) {
    var str = $("#" + id).html();
    var w = window.open("CIndex/showLayout/?pg=sfprint", 'callScriptPopup', 'width = 500, height = 500');

    $(w.document.body).append(str);
    alert(str);
}

function tellme(title,text,classname=''){
 $.gritter.add({
        title: title,
        text: text,
        class_name: classname
        });
    }


//===================================== MODAL
    function lookup(url,idhtml){
        var q = $("#q").val();
           $.ajax({
            url:url,
            type:"GET",
            dataType:"html",
            data:{q:q,idhtml:idhtml},
            success:function(data){
                $(".modal-body").html(data);
                $('#lookup').modal();
                $("#q").val("");
            }
        });
        }

       
    function setVal(id,valid,valnm){
        $('#'+id).val(valid); 
        $('#nm_'+id).val(valnm); 
        $('#lookup').modal('hide');
    }

    //===================================== END MODAL
        