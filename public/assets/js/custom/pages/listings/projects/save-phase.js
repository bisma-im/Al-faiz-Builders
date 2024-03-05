"use strict";
var KTAppEcommerceSaveProduct = (function () {
    const e = () => {
            $("#kt_ecommerce_add_project_options").repeater({
                initEmpty: !1,
                defaultValues: { "text-input": "foo" },
                show: function () {
                    $(this).slideDown(), t();
                },
                hide: function (e) {
                    $(this).slideUp(e);
                },
            });
        },
        t = () => {
            document.querySelectorAll('[data-kt-ecommerce-catalog-add-project="project_option"]').forEach((e) => {
                $(e).hasClass("select2-hidden-accessible") || $(e).select2({ minimumResultsForSearch: -1 });
            });
        };
    return {
        init: function () {
            var o, a;
            var phaseCompletionDate = document.getElementById('phase_completion_date').value;
            $("#kt_ecommerce_phase_complete_datepicker").flatpickr({
                enableTime: false,
                altInput: true,
                defaultDate: phaseCompletionDate,
                dateFormat: "Y-m-d",
            });
                ["#kt_ecommerce_add_product_category", "#kt_ecommerce_add_project_tags"].forEach((e) => {
                    const t = document.querySelector(e);
                    t && new Tagify(t, { whitelist: ["new", "trending", "sale", "discounted", "selling fast", "last 10"], dropdown: { maxItems: 20, classname: "tagify__inline__suggestions", enabled: 0, closeOnSelect: !1 } });
                }),
                (o = document.querySelector("#kt_ecommerce_add_product_discount_slider")),
                (a = document.querySelector("#kt_ecommerce_add_product_discount_label")),
                noUiSlider.create(o, { start: [10], connect: !0, range: { min: 1, max: 100 } }),
                o.noUiSlider.on("update", function (e, t) {
                    (a.innerHTML = Math.round(e[t])), t && (a.innerHTML = Math.round(e[t]));
                }),
                e(),
                new Dropzone("#kt_ecommerce_add_phase_media", {
                    url: "https://keenthemes.com/scripts/void.php",
                    autoProcessQueue: false,
                    paramName: "file",
                    maxFiles: 10,
                    maxFilesize: 10,
                    addRemoveLinks: true,
                }),
                t(),
                (() => {
                    const e = document.getElementById("kt_ecommerce_add_project_status"),
                        t = document.getElementById("kt_ecommerce_add_project_status_select"),
                        o = ["bg-success", "bg-warning", "bg-danger"];
                    $(t).on("change", function (t) {
                        switch (t.target.value) {
                            case "published":
                                e.classList.remove(...o), e.classList.add("bg-success"), c();
                                break;
                            case "scheduled":
                                e.classList.remove(...o), e.classList.add("bg-warning"), d();
                                break;
                            case "inactive":
                                e.classList.remove(...o), e.classList.add("bg-danger"), c();
                                break;
                            case "draft":
                                e.classList.remove(...o), e.classList.add("bg-primary"), c();
                        }
                    });
                    const a = document.getElementById("kt_ecommerce_add_project_status_datepicker");
                    $("#kt_ecommerce_add_project_status_datepicker").flatpickr({ enableTime: !0, dateFormat: "Y-m-d H:i" });
                    const d = () => {
                            a.parentNode.classList.remove("d-none");
                        },
                        c = () => {
                            a.parentNode.classList.add("d-none");
                        };
                })(),
                (() => {
                    const e = document.querySelectorAll('[name="method"][type="radio"]'),
                        t = document.querySelector('[data-kt-ecommerce-catalog-add-category="auto-options"]');
                    e.forEach((e) => {
                        e.addEventListener("change", (e) => {
                            "1" === e.target.value ? t.classList.remove("d-none") : t.classList.add("d-none");
                        });
                    });
                })(),
                (() => {
                    const e = document.querySelectorAll('input[name="discount_option"]'),
                        t = document.getElementById("kt_ecommerce_add_product_discount_percentage"),
                        o = document.getElementById("kt_ecommerce_add_product_discount_fixed");
                    e.forEach((e) => {
                        e.addEventListener("change", (e) => {
                            switch (e.target.value) {
                                case "2":
                                    t.classList.remove("d-none"), o.classList.add("d-none");
                                    break;
                                case "3":
                                    t.classList.add("d-none"), o.classList.remove("d-none");
                                    break;
                                default:
                                    t.classList.add("d-none"), o.classList.add("d-none");
                            }
                        });
                    });
                })(),
                (() => {
                    const e = document.getElementById("kt_ecommerce_add_product_shipping_checkbox"),
                        t = document.getElementById("kt_ecommerce_add_product_shipping");
                    e.addEventListener("change", (e) => {
                        e.target.checked ? t.classList.remove("d-none") : t.classList.add("d-none");
                    });
                })(),
                (() => {
                    let e;
                    
                    const t = document.getElementById("kt_ecommerce_add_phase_form"),
                        o = document.getElementById("kt_ecommerce_add_phase_submit");
                    (e = FormValidation.formValidation(t, {
                        fields: {
                            phase_name: { validators: { notEmpty: { message: "Phase Name is required" } } },
                            phase_cost: { validators: { notEmpty: { message: "Project Buying Cost is required" } } },
                            down_payment: { validators: { notEmpty: { message: "Product Down Payment is required" } } },
                            development_charges: { validators: { notEmpty: { message: "Product Development Charges are required" } } },
                            extra_charges: { validators: { notEmpty: { message: "Extra Charges are required" } } },
                            monthly_installment: { validators: { notEmpty: { message: "Monthly Installment Amount is required" } } },
                            phase_area: { validators: { notEmpty: { message: "Project Area is required" } } },
                        },
                        plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                    })),
                    o.addEventListener("click", (a) => {
                        a.preventDefault(),
                            e &&
                                e.validate().then(function (e) {
                                        // console.log("validated!"),
                                    if(e === "Valid"){
                                        const formData = new FormData(t);
                                        var phaseId = formData.get('id'); // Get the user ID from the form data
                                        var url = phaseId ? '/update-phase' : '/add-phase';
                                        const dropzoneElement = document.querySelector('#kt_ecommerce_add_phase_media');
                                        if (dropzoneElement.dropzone) {
                                            const files = dropzoneElement.dropzone.files;
                                            files.forEach((file) => {
                                            formData.append('phase_media[]', file, file.name);
                                            });
                                        }
                                        fetch(url, {
                                            method: 'POST',
                                            body: formData,
                                            headers: {
                                                'X-Requested-With': 'XMLHttpRequest',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                            }
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            if (data.success){
                                                (o.setAttribute("data-kt-indicator", "on"),
                                                (o.disabled = !0),
                                                setTimeout(function () {
                                                    o.removeAttribute("data-kt-indicator"),
                                                        Swal.fire({
                                                            text: "Form has been successfully submitted!",
                                                            icon: "success",
                                                            buttonsStyling: !1,
                                                            confirmButtonText: "Ok, got it!",
                                                            customClass: { confirmButton: "btn btn-primary" },
                                                        }).then(function (e) {
                                                            e.isConfirmed && ((o.disabled = !1), (window.location.href = t.getAttribute("data-kt-redirect")));
                                                        });
                                                }, 2e3))
                                            }
                                        })
                                    }
                                    else {
                                        Swal.fire({
                                            html:
                                                "Sorry, looks like there are some errors detected, please try again. <br/><br/>Please note that there may be errors in the <strong>General</strong> or <strong>Advanced</strong> tabs",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        });
                                    }
                            });
                        });
            })();
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveProduct.init();
});
