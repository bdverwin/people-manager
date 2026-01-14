import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import * as bootstrap from 'bootstrap';

let editingEmployeeId = null;

$(document).on('click', '.delete-employee', function () {
    const employeeId = $(this).data('id');
    const row = $(this).closest('tr');

    if (!confirm('Are you sure you want to delete this employee?')) {
        return;
    }

    $.ajax({
        url: `/employee/${employeeId}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },
        success() {
            row.fadeOut(300, () => row.remove());
        },
        error() {
            alert('Something went wrong.');
        }
    });
});

$(document).on('click', '.edit-btn', function() {
    const employeeId = $(this).data('id');
    editingEmployeeId = employeeId;

    // Find employee info from the table or fetch via AJAX
    const row = $(this).closest('tr');
    const name = row.find('td:eq(1)').text();
    const email = row.find('td:eq(2)').text();

    // Fill the modal form
    $('#new_employee input[name="name"]').val(name);
    $('#new_employee input[name="email"]').val(email);

    // Change modal title
    $('#newEmployee .modal-title').text('Edit Employee');

    // Open modal
    const modalEl = document.getElementById('newEmployee');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
});

$(document).on('click', '#save-employee', function(e) {
    e.preventDefault();

    const form = $('#new_employee');
    const modalEl = document.getElementById('newEmployee');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

    // Determine if adding or editing
    let url = form.attr('action'); // default /employee for add
    let method = form.attr('method'); // default POST
    if (editingEmployeeId) {
        url = `/employee/${editingEmployeeId}`;
        method = 'PUT';
    }

    $.ajax({
        url: url,
        type: method,
        data: form.serialize(),
        success(res) {
            modal.hide();
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            form.trigger('reset');
            editingEmployeeId = null; // reset after save
            $('#newEmployee .modal-title').text('Add New Employee');
            loadEmployees();
        },
        error(err) {
            $('.error-msg').remove();
            $('.modal-body').append(`<p class="p-1 bg-danger-subtle error-msg">${err.responseJSON.message}</p>`);
        }
    });
});

function loadEmployees(){
    const tableBody = $('#employee-table-body');

    // Get department ID from URL
    const pathParts = window.location.pathname.split('/');
    const departmentId = pathParts[pathParts.length - 1];

    // Fetch employees for this department
    $.getJSON(`/employee/department/${departmentId}/json`, function(employees) {
        tableBody.empty();
        employees.forEach(emp => {
            const row = `
                <tr>
                    <td class="px-4 py-2">${emp.id}</td>
                    <td class="px-4 py-2">${emp.name}</td>
                    <td class="px-4 py-2">${emp.email}</td>
                    <td class="px-4 py-2">${emp.created_at}</td>
                    <td class="px-4 py-2">${emp.updated_at}</td>
                    <td class="px-4 py-2">
                        <button class="p-1 btn btn-outline-secondary edit-btn" data-id="${emp.id}"><i class="bi bi-pen"></i></button>
                        <button class="p-1 btn btn-outline-secondary delete-employee" data-id="${emp.id}"><i class="bi bi-trash3"></i></button>
                    </td>
                </tr>
            `;
            tableBody.append(row);
        });
    });
}
