function clearForm () {
    $(':input')
    .not(':button, :submit, :reset, :hidden')
    .prop('checked', false)
    .removeAttr('selected')
    .not(':checkbox, select')
    .val('')
    .removeAttr('value');
}
function callAjax (data, actionUrl, method) {
    $.ajax({
        headers: {'x-csrf-token': csrf_token},
        type: method,
        url: actionUrl,
        data: data,
        success: function(response)
        {
            ajaxSuccess(response);
        },
        statusCode: {
            403: function(response) {
                new PNotify.alert({
                    title: 'Permission Denied',
                    text: "Sorry, You don't have Permission to Perform this Action",
                    type: 'error'
                });
            },
            404: function(response) {
                new PNotify.alert({
                    title: 'Error Code:404',
                    text: 'Action URL Not Found',
                    type: 'error'
                });
            },
            406: function(response) {
                new PNotify.alert({
                    title: 'Not Acceptable',
                    text: "Please try Avoid Editing or Deleting Admin Role",
                    type: 'error'
                });
            },
            422: function(response) {
                ajaxNotPermissible(response);
            },
            500: function(response) {
                new PNotify.alert({
                    title: 'Error Code:500',
                    text: 'Internal Server Error',
                    type: 'error'
                });
            }
        }
    });
}