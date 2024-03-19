"use strict";
var KTModalLogsAdd = (function () {
    var e, o, i;
    function populateVoucherDetails(voucherData){
        var $tbody = $('#voucher_entries');
        $tbody.empty();
        
        if(voucherData.length > 0){
            $.each(voucherData, function(index,entry) {
                var $tr = $('<tr>');
                if (index === 0) {
                    $tr.append($('<td>').text(entry.date));
                } else {
                    $tr.append($('<td>').text(''));
                }
                $tr.append(
                    $('<td>').text(entry.HeadName),
                    $('<td>').text(entry.debit_amount),
                    $('<td>').text(entry.credit_amount)
                );
                
                $tbody.append($tr);
            });
        }
    }
    return {
        init: function () {
            (i = new bootstrap.Modal(document.querySelector("#kt_modal_show_voucher"))),
                (e = document.querySelector("#kt_modal_voucher_cancel")),
                (o = document.querySelector("#kt_modal_voucher_close")),
                $('#kt_modal_show_voucher').on('show.bs.modal', function (event) {
                    var anchor = $(event.relatedTarget); 
                    var voucherId = anchor.data('voucher-id');
                    var modal = $(this);
                    modal.find('#voucher-id-placeholder').text('/'+voucherId);
                    modal.find('#voucher-type-placeholder').text(anchor.data('voucher-type'));
                    var safeVoucherId = voucherId.replace(/\//g, '-');
                    $.ajax({
                        url: `/get-voucher/${safeVoucherId}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                populateVoucherDetails(response.data);
                            } else {
                                console.error('Failed to fetch voucher.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching voucher:', error);
                        }
                    });
                });
                e.addEventListener("click", function (t) {
                    t.preventDefault(),
                    t.stopPropagation();
                    $('input').blur();
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" },
                        }).then(function (t) {
                            t.value
                                ? (i.hide())
                                : "cancel" === t.dismiss && Swal.fire({ text: "Your form has not been cancelled!.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
                        });
                });
                o.addEventListener("click", function (t) {
                    t.preventDefault(),
                    t.stopPropagation();
                    $('input').blur();
                        Swal.fire({
                            text: "Are you sure you would like to cancel?",
                            icon: "warning",
                            showCancelButton: !0,
                            buttonsStyling: !1,
                            confirmButtonText: "Yes, cancel it!",
                            cancelButtonText: "No, return",
                            customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" },
                        }).then(function (t) {
                            t.value
                                ? (i.hide())
                                : "cancel" === t.dismiss && Swal.fire({ text: "Your form has not been cancelled!.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
                        });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalLogsAdd.init();
});
