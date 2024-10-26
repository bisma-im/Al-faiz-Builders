"use strict";
var KTCustomersList = (function () {
    var t, salesAgentsElement, salesAgents,
        e,
        o,
        n,
        c = () => {
            n.querySelectorAll('[data-kt-customer-table-filter="delete_row"]').forEach((e) => {
                e.addEventListener("click", function (e) {
                    e.preventDefault();
                    const o = e.target.closest("tr"),
                        n = o.querySelectorAll("td")[1].innerText;
                    Swal.fire({
                        text: "Are you sure you want to delete " + n + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary" },
                    }).then(function (e) {
                        e.value
                            ? Swal.fire({ text: "You have deleted " + n + "!.", icon: "success", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } }).then(function () {
                                t.row($(o)).remove().draw();
                            })
                            : "cancel" === e.dismiss && Swal.fire({ text: n + " was not deleted.", icon: "error", buttonsStyling: !1, confirmButtonText: "Ok, got it!", customClass: { confirmButton: "btn fw-bold btn-primary" } });
                    });
                });
            });
        },
        r = () => {
            const e = n.querySelectorAll('[type="checkbox"]'),
                o = document.querySelector('[data-kt-customer-table-select="transfer_selected"]');
            e.forEach((t) => {
                t.addEventListener("click", function () {
                    setTimeout(function () {
                        l();
                    }, 50);
                });
            })
        };
    const l = () => {
        const t = document.querySelector('[data-kt-customer-table-toolbar="base"]'),
            e = document.querySelector('[data-kt-customer-table-toolbar="selected"]'),
            o = document.querySelector('[data-kt-customer-table-select="selected_count"]'),
            c = n.querySelectorAll('tbody [type="checkbox"]');
        let r = !1,
            l = 0;
        c.forEach((t) => {
            t.checked && ((r = !0), l++);
        });
        if (r && e.classList.contains('is-sales-manager')) {
            o.innerHTML = l; // Update the selected count display
            t.classList.add("d-none"); // Hide the base toolbar
            e.classList.remove("d-none"); // Show the selected items toolbar
        } else {
            t.classList.remove("d-none"); // Show the base toolbar
            e.classList.add("d-none"); // Hide the selected items toolbar
        }
    };

    // function showSalesAgentDialog(checkboxes) {
    //     fetch('/get-sales-agents', {
    //         method: 'GET',
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(salesAgents => {
    //         // console.log('Sales Agents:', data);
    //         let options = salesAgents.reduce((obj, agent) => {
    //             obj[agent.id] = agent.full_name; // Use agent.id as key and agent.full_name as value
    //             return obj;
    //         }, {});

    //         Swal.fire({
    //             title: 'Select a Sales Agent',
    //             input: 'select',
    //             inputOptions: options,
    //             inputPlaceholder: 'Select an agent',
    //             showCancelButton: true,
    //             confirmButtonText: "Transfer leads!",
    //             inputValidator: (value) => {
    //                 if (!value) {
    //                     return 'You need to choose an agent!';
    //                 }
    //             },
    //             customClass: { confirmButton: "btn fw-bold btn-danger", cancelButton: "btn fw-bold btn-active-light-primary", input: "form-select form-select-solid form-select-lg fw-semibold" },
    //         }).then(function (result) {
    //             if (result.value) {
    //                 transferSelectedLeads(checkboxes, result.value);
    //             }
    //         });
    //     })
    //     .catch(error => console.error('Error fetching sales agents:', error));

    // }

    // function transferSelectedLeads(checkboxes, agentId) {
    //     const selectedLeads = Array.from(checkboxes).filter(chk => chk.checked).map(chk => chk.closest("tr").getAttribute('data-lead-id'));
    //     console.log("Transferring leads:", selectedLeads, "to agent:", agentId);
    //     // Here, implement the POST request to your server to update the leads
    //     // Example with fetch, adjust URL and method as needed:
    //     fetch('/api/transfer-leads', {
    //         method: 'POST',
    //         headers: {'Content-Type': 'application/json'},
    //         body: JSON.stringify({leads: selectedLeads, agentId: agentId})
    //     }).then(response => response.json())
    //       .then(data => console.log(data));
    //     // Handle UI update or notification post-transfer
    // }
    return {
        init: function () {
            // salesAgentsElement = document.getElementById('salesAgentsData');
            // salesAgents = salesAgentsElement.getAttribute('data-agents');
            // console.log(salesAgents);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            n = document.querySelector("#kt_users_table");
            if (n) {
                t = $(n).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "/get-leads",
                        type: "POST",
                        data: function (data) {
                            data.search = $('input[data-kt-customer-table-filter="search"]').val();
                        }
                    },
                    order: ['1', 'DESC'],
                    pageLength: 10,
                    searching: true,
                    aoColumns: [
                        {
                            data: 'id',
                            render: function(data, type, row) {
                                return `<div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>`; //you can add your view route here
                            }
                        },
                        {
                            data: 'name',
                            render: function(data, type, row) {
                                return `<a href="/leads/${row.id}" class="text-gray-600 text-hover-primary mb-1">${row.name}</a>`;
                            }
                        },
                        {
                            data: 'mobile_number_1',
                        },
                        {
                            data: 'landline_number_1',
                        },
                        {
                            data: 'email',
                        },
                        {
                            data: 'source_of_information',
                        },
                        {
                            data: 'id',
                            render: function(data, type, row) {
                                return `<a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            
                                            <div class="menu-item px-3">
                                                <a href="/leads/view/${row.id}" class="menu-link px-3">View</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                            </div>
                                        </div>`;
                            }
                        }
                    ]
                }).on('draw', function () {
                    r(), c(), KTMenu.init();
                });
                r();
                c();
                document.querySelector('[data-kt-customer-table-filter="search"]').addEventListener("keyup", function (e) {
                    t.search($(this).val()).draw();
                });
            }
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTCustomersList.init();
});
