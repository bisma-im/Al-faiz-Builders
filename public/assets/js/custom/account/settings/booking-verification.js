"use strict";
var KTSigninGeneral = (function () {
    var e, t, i;
    return {
        init: function () {
            var e = document.querySelector("#kt_booking_verification_form");
                if(e)
                {
                    (t = document.querySelector("#kt_booking_verification_submit")),
                    (i = FormValidation.formValidation(e, {
                        fields: {
                            customer_cnic: { validators: { notEmpty: { message: "The CNIC is required" } } },
                            customer_name: { validators: { notEmpty: { message: "The name is required" } } },
                        },
                        plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                    })),
                    t.addEventListener("click", function (n) {
                        n.preventDefault(),
                            i && i.validate().then(function (i) {
                                // "Valid" == i
                                if(i === "Valid"){
                                    e.submit();
                                }
                            });
                    });
            } else
            {
                var n = document.querySelector("#kt_plots_table");
                $(n).DataTable({
                    info: !1,
                    order: false,
                    columnDefs: [
                        { orderable: !1, targets: '_all' },
                    ],
                    paging: false,
                })
            }
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
