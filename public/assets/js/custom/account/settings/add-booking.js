"use strict";

var KTNewBooking = (function () {
    var t, e, r;
    return {
        init: function () {
            t = document.querySelector("#kt_new_booking_form");
            e = document.querySelector("#kt_new_booking_submit");// Ensure this ID matches your plot dropdown ID
            var isLocked = document.getElementById('isLocked').value; 
            console.log(isLocked);
            function makeInputsReadonly() {
                $(t).find('input, select, textarea, button[type=submit]').attr('readonly', true).attr('disabled', 'disabled');
            };
            r = FormValidation.formValidation(t, {
                fields: {
                    project_id: { validators: { notEmpty: { message: "Project is required" } } },
                    project_phase: { validators: { notEmpty: { message: "Project phase is required" } } },
                    plot_id: { validators: { notEmpty: { message: "Plot is required" } } },
                    customer_name: { validators: { notEmpty: { message: "Customer_name is required" } } },
                    customer_cnic: { validators: { notEmpty: { message: "Customer CNIC is required" } } },
                    customer_address: { validators: { notEmpty: { message: "Customer Address is required" } } },
                    mobile_no: { validators: { notEmpty: { message: "Customer Mobile Number is required" } } },
                    unit_cost: { validators: { notEmpty: { message: "Customer Mobile Number is required" } } },
                    extra_charges: { validators: { notEmpty: { message: "extra_charges is required" } } },
                    development_charges: { validators: { notEmpty: { message: "development_charges is required" } } },
                    monthly_installment: { validators: { notEmpty: { message: "monthly_installment is required" } } },
                    token_amount: { validators: { notEmpty: { message: "token_amount is required" } } },
                    advance_amount: { validators: { notEmpty: { message: "advance_amount is required" } } },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    e: new FormValidation.plugins.SubmitButton(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }),
                },
            });
            
            $(document).ready(function(){
                var selectedPlot = parseInt($('#bookingForm').data('selected-plot'), 10);
                var selectedPhase = $('#bookingForm').data('selected-phase');
                $('#projectDropdown').on('change', function(e){
                    var projectId = e.target.value;
                    loadPlots(projectId);
                });
                if ($('#projectDropdown').val() !== "" && isLocked === 'false') {
                    loadPlots($('#projectDropdown').val());
                }
                else
                {
                    makeInputsReadonly();
                    return; 
                }

                // if (parseInt(isLocked, 10) === 1) { 
                //     makeInputsReadonly();
                //     return; 
                // } 
            
                function loadPlots(projectId) {
                    $.ajax({
                        url: '/get-plots-for-booking',
                        type: "POST",
                        data: {
                            project_id: projectId,
                            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        dataType: 'json',
                        success: function(result){
                            $('#plotDropdown').html('<option value="">Select plot number...</option>');
                            
                            $.each(result, function(index, plot){ 
                                // if(plot.id==selectedPlot)
                                //     var option = $('<option>').val(plot.id).text(plot.plot_no).attr('selected','selected');
                                // else
                                    var option = $('<option>').val(plot.id).text(plot.plot_no);
                                
                                $('#plotDropdown').append(option);
                            });
                        }
                    });
                }
                
            });
            
            e.addEventListener("click", function (a) {
                a.preventDefault();
                r.validate().then(function (r) {
                    if (r === "Valid") {
                        e.setAttribute("data-kt-indicator", "on");
                            e.disabled = true;
                            var formData = new FormData(t);
                            var bookingId = formData.get('id');
                            var url = bookingId ? '/update-booking' : '/add-booking';
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
                                        text: 'Booking generated successfully',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            username = document.getElementById('username').value;
                                            window.location.href = t.getAttribute('data-kt-redirect'); // Replace with your desired path
                                            
                                        }
                                    });
                                }
                                else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'There was a problem generating the booking',
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
    KTNewBooking.init();
});
