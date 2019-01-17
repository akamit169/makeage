
var userService = {};
$(document).ready(function () {
    var datatable;
    datatable = $('#basicDataTable').DataTable({
        "pagingType": "full_numbers",
        "serverSide": true,
        "paging": true,
        "ordering": false,
        "info": false,
        "ajax": SITE_URL + '/admin/user/user-report-ajax',
        "columnDefs": [
            {
                targets: 0,
                data: null,
                render: function (data, type, row) {
                    if (data[0] != '' && data[0] != null) {
                        return data[0];
                    } else {
                        return '';
                    }
                }
            },
            {
                targets: 1,
                data: null,
                render: function (data, type, row) {
                    if (data[1] != '' && data[1] != null) {
                        var action_html = '<a  href="'+SITE_URL+'/admin/user/user-details/'+data[3]+'">'+data[1]+'</a>';
                        return action_html;
                    } else {
                        return '';
                    }
                }
            },
            
            {
                targets: 2,
                data: null,
                render: function (data, type, row) {
                    if (data[2] != '' && data[2] != null) {
                        var action_html = '<a  href="'+SITE_URL+'/admin/user/user-details/'+data[3]+'">'+data[2]+'</a>';
                        return action_html;
                    } else {
                        return '';
                    }
                }
            },
            {
                targets: 3,
                data: null,
                render: function (data, type, row) {
                    if (data[4] != '' && data[4] != null) {
                        var action_html = '<a  href="'+SITE_URL+'/admin/user/user-details/'+data[5]+'">'+data[4]+'</a>';
                         return action_html;
                    } else {
                        return '';
                    }
                }
            },
            {
                targets: 4,
                data: null,
                render: function (data, type, row) {
                    if (data[6] != '' && data[6] != null) {
                        return data[6];
                    } else {
                        return '';
                    }
                }
            },
            
            {
                targets: 5,
                data: null,
                render: function (data, type, row) {
                    if (data[8] != '' && data[8] != null) {
                        return data[8];
                    } else {
                        return '';
                    }
                }
            },
            
            {
                targets: 6,
                data: null,
                render: function (data, type, row) {
                    var action_html = '<a class="btn btn-sm btn-default view-log" href="'+SITE_URL+'/admin/user/report-details/'+data[7]+'">View Details</a>';
                    
                    return action_html;
                }
                
            }
            
        ]
    });
});
if($('.alert').length > 0) {
    setInterval(function() {
        $('.alert').hide();
    }, 2000);
}