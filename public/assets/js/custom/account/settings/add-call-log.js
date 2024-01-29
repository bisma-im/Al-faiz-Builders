"use strict";
var KTModalCustomersAdd = (function () {
    var t, e, o, n, r, i;
    // const a = document.getElementById("kt_ecommerce_add_call_log_datepicker");
    $("#kt_ecommerce_add_call_log_datepicker").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        onClose: function(selectedDates, dateStr, instance) {
            // You can handle any actions here after the date is selected
            console.log('DatePicker closed');
        }
    });
    
    // For the next call datepicker
    $("#kt_ecommerce_add_next_call_log_datepicker").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        onClose: function(selectedDates, dateStr, instance) {
            // You can handle any actions here after the date is selected
        }
    });
                    // const d = () => {
                    //         a.parentNode.classList.remove("d-none");
                    //     },
                    //     c = () => {
                    //         a.parentNode.classList.add("d-none");
                    //     };       
    return {
        init: function () {
            (i = new bootstrap.Modal(document.querySelector("#kt_modal_add_log"))),
                (r = document.querySelector("#kt_modal_add_log_form")),
                (t = r.querySelector("#kt_modal_add_log_submit")),
                (e = r.querySelector("#kt_modal_add_log_cancel")),
                (o = r.querySelector("#kt_modal_add_log_close")),
                
                (n = FormValidation.formValidation(r, {
                    fields: {
                        customer_response: { validators: { notEmpty: { message: "Customer response is required" } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                })),
                
                t.addEventListener("click", function (e) {
                    e.preventDefault(),
                        n &&
                            n.validate().then(function (e) {
                                console.log("validated!"),
                                    "Valid" == e
                                        ? (t.setAttribute("data-kt-indicator", "on"),
                                          (t.disabled = !0),
                                          setTimeout(function () {
                                              t.removeAttribute("data-kt-indicator"),
                                                  Swal.fire({ text: "Form has been successfully submitted!", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } }).then(
                                                      function (e) {
                                                          e.isConfirmed && (i.hide(), (t.disabled = !1), (window.location = r.getAttribute("data-kt-redirect")));
                                                      }
                                                  );
                                          }, 2e3))
                                        : Swal.fire({
                                              text: "Sorry, looks like there are some errors detected, please try again.",
                                              icon: "error",
                                              buttonsStyling: !1,
                                              confirmButtonText: "Ok, got it!",
                                              customClass: { confirmButton: "btn btn-primary" },
                                          });
                            });
                }),
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
                                ? (r.reset(), i.hide())
                                : "cancel" === t.dismiss && Swal.fire({ text: "Your form has not been cancelled!.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
                        });
                }),
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
                                ? (r.reset(), i.hide())
                                : "cancel" === t.dismiss && Swal.fire({ text: "Your form has not been cancelled!.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn btn-primary" } });
                        });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTModalCustomersAdd.init();
});
