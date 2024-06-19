import './bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;

import swal from 'sweetalert2';
window.Swal = swal;

import DataTable from 'datatables.net-bs5';

let table = new DataTable('#example', {
    // config options...
    // pageLength: 12
});
