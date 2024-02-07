"use strict";

var KTNewInvoice = (function () {
    var t, e, r;
    return {
        init: function () {
            t = document.querySelector("#kt_new_booking_form");
            e = document.querySelector("#kt_new_booking_submit");// Ensure this ID matches your plot dropdown ID
                        
            // Initialize form validation
            r = FormValidation.formValidation(t, {
                fields: {
                    project_id: { validators: { notEmpty: { message: "Project is required" } } },
                    plot_id: { validators: { notEmpty: { message: "Plot is required" } } },
                    description: { validators: { notEmpty: { message: "Description is required" } } },
                    total_amount: { validators: { notEmpty: { message: "Total amount is required" } } },
                    created_by: { validators: { notEmpty: { message: "created_by is required" } } },
                    invoice_date_time: { validators: { notEmpty: { message: "invoice_date_time is required" } } },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    e: new FormValidation.plugins.SubmitButton(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                },
            });
            $(document).ready(function(){
                var selectedPlot = parseInt($('#invoiceForm').data('selected-plot'), 10);

                // Trigger change event to load plots if there's a preselected project
                if ($('#projectDropdown').val() !== "") {
                    loadPlots($('#projectDropdown').val());
                }
            
                // Function to load plots
                function loadPlots(projectId) {
                    $.ajax({
                        url: '/get-plots',
                        type: "POST",
                        data: {
                            project_id: projectId,
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        dataType: 'json',
                        success: function(result){
                            $('#plotDropdown').html('<option value="">Select plot number...</option>');
                            
                            $.each(result, function(index, plot){ 
                                if(plot.id==selectedPlot)
                                    var option = $('<option>').val(plot.id).text(plot.plot_no).attr('selected','selected');
                                else
                                    var option = $('<option>').val(plot.id).text(plot.plot_no);
                                
                                $('#plotDropdown').append(option);
                            });
                        }
                    });
                }
                $('#projectDropdown').on('change', function(e){
                    var projectId = e.target.value;
                    loadPlots(projectId);
                });
            });
            
            e.addEventListener("click", function (a) {
                a.preventDefault();
                r.validate().then(function (r) {
                    if (r === "Valid") {
                        e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;
                            var formData = new FormData(t);
                            var invoiceId = formData.get('id');
                            var url = invoiceId ? '/update-invoice' : '/add-invoice';
                            fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Invoice generated successfully',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = t.getAttribute('data-kt-redirect'); // Replace with your desired path
                                        }
                                    });
                                }
                                else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There was a problem generating the invoice',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                // Handle network errors
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'A network error occurred. Please try again.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            })
                            .finally(() => {
                                e.removeAttribute("data-kt-indicator");
                                e.disabled = false;
                            });
                        
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" },
                        });
                    }
                });
            });
            // Re-validate on change
            $(t.querySelector('[name="customer_id"]')).on("change", function () {
                r.revalidateField("customer_id");
            });
            $(t.querySelector('[name="project_id"]')).on("change", function () {
                r.revalidateField("project_id");
            });
            $(t.querySelector('[name="plot_id"]')).on("change", function () {
                r.revalidateField("plot_id");
            });
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTNewInvoice.init();
});
