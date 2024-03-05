"use strict";
var KTAppEcommerceSaveProduct = (function () {

    return {
        init: function () {
            ["#kt_ecommerce_add_project_description", "#kt_ecommerce_add_project_meta_description"].forEach((e) => {
                let t = document.querySelector(e);
                t && (t = new Quill(e, { modules: { toolbar: [[{ header: [1, 2, !1] }], ["bold", "italic", "underline"], ["image", "code-block"]] }, placeholder: "Type your text here...", theme: "snow" }));
            }),
                
                new Dropzone("#kt_ecommerce_add_project_media", {
                    url: "https://keenthemes.com/scripts/void.php",
                    autoProcessQueue: false,
                    paramName: "file",
                    maxFiles: 10,
                    maxFilesize: 10,
                    addRemoveLinks: true,
                }),
                (() => {
                    const e = document.getElementById("kt_ecommerce_add_project_status"),
                        t = document.getElementById("kt_ecommerce_add_project_status_select"),
                        o = ["bg-success", "bg-warning", "bg-danger"];
                    $(t).on("change", function (t) {
                        switch (t.target.value) {
                            case "published":
                                e.classList.remove(...o), e.classList.add("bg-success"), c();
                                break;
                            case "closed":
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
                    let e;
                    
                    const t = document.getElementById("kt_ecommerce_add_project_form"),
                        o = document.getElementById("kt_ecommerce_add_project_submit");
                    (e = FormValidation.formValidation(t, {
                        fields: {
                            project_title: { validators: { notEmpty: { message: "Project Title is required" } } },
                            // status: { validators: { notEmpty: { message: "Project Title is required" } } },
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
                                                var projectId = formData.get('id'); // Get the user ID from the form data
                                                var url = projectId ? '/update-project' : '/add-project';
                                                const dropzoneElement = document.querySelector('#kt_ecommerce_add_project_media');
                                                if (dropzoneElement.dropzone) {
                                                    const files = dropzoneElement.dropzone.files;
                                                    files.forEach((file) => {
                                                        formData.append('project_media[]', file, file.name);
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
