$(document).ready(function() {
    $('#example').DataTable({
        language: {
            searchPlaceholder: 'Search records',
            sSearch: '',
            sLengthMenu: 'Show _MENU_',
            sLength: 'dataTables_length',
        }
    });
    $('.dataTables_length select').addClass('browser-default');
});