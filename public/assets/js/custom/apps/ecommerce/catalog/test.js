"use strict";
var KTAppEcommerceSaveProduct = (function () {
    const e = () => {
        $("#kt_ecommerce_add_product_options").repeater({
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
        document.querySelectorAll('[data-kt-ecommerce-catalog-add-product="product_option"]').forEach((e) => {
            $(e).hasClass("select2-hidden-accessible") || $(e).select2({ minimumResultsForSearch: -1 });
        });
    };

    return {
        init: function () {
            var o, a;
            ["#kt_ecommerce_add_product_description", "#kt_ecommerce_add_product_meta_description"].forEach((e) => {
                let t = document.querySelector(e);
                t && (t = new Quill(e, { modules: { toolbar: [[{ header: [1, 2, !1] }], ["bold", "italic", "underline"], ["image", "code-block"]] }, placeholder: "Type your text here...", theme: "snow" }));
            }),
            ["#kt_ecommerce_add_product_category", "#kt_ecommerce_add_product_tags"].forEach((e) => {
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
            new Dropzone("#kt_ecommerce_add_product_media", {
                url: "https://keenthemes.com/scripts/void.php",
                paramName: "file",
                maxFiles: 10,
                maxFilesize: 10,
                addRemoveLinks: !0,
                accept: function (e, t) {
                    "wow.jpg" == e.name ? t("Naha, you don't.") : t();
                },
            }),
            t(),
            (() => {
                const e = document.getElementById("kt_ecommerce_add_product_status"),
                      t = document.getElementById("kt_ecommerce_add_product_status_select"),
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
                const a = document.getElementById("kt_ecommerce_add_product_status_datepicker");
                $("#kt_ecommerce_add_product_status_datepicker").flatpickr({ enableTime: !0, dateFormat: "Y-m-d H:i" });
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
                const form = document.getElementById("kt_ecommerce_add_product_form"),
                      submitButton = document.getElementById("kt_ecommerce_add_product_submit");

                FormValidation.formValidation(form, {
                    fields: {
                        product_name: { validators: { notEmpty: { message: "Product name is required" } } },
                        sku: { validators: { notEmpty: { message: "SKU is required" } } },
                        price: { validators: { notEmpty: { message: "Price is required" } } },
                        shelf: { validators: { notEmpty: { message: "Shelf quantity is required" } } },
                        status: { validators: { notEmpty: { message: "Status is required" } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                }).on('core.form.valid', function() {
                    submitButton.setAttribute("data-kt-indicator", "on");
                    submitButton.disabled = true;

                    var formData = new FormData(form);
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',                    
                        }
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        submitButton.removeAttribute("data-kt-indicator");
                        if (data.success) {
                            Swal.fire({
                                text: data.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    window.location = form.getAttribute("data-kt-redirect");
                                }
                            });
                        } else {
                            Swal.fire({
                                html: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" }
                            });
                        }
                        submitButton.disabled = false;
                    })
                    .catch(error => {
                        submitButton.removeAttribute("data-kt-indicator");
                        submitButton.disabled = false;
                        Swal.fire({
                            html: "Sorry, an error occurred. Please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        });
                    });
                });
            })();
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveProduct.init();
});
