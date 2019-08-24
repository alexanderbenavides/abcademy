/*

   This file contains JS functions used to obtain information from the server.
   Parameters are being passed onto a specified URL, which will return (echo) information.
   The response from the server will be given in JSON format, which is easily interpreted.

 */

// A function to prepare the URL for ajax.
// A function to prepare the URL for ajax.
function formatURL() {
    // Get all parts of URL
    var url_components = window.location.href.split('/');
    // Index marker
    var index = 0;
    // construct a new URL.
    var url = "";
    // Loop through URL
    for (index; index < url_components.length; index++) {
        // Obtain in form http://www.miwebsite.com/
        if (url_components[index] === "admin") break;
        // Append approved part to new URL
        url += url_components[index] + '/';
    }
    // Finish url construction
    return url + 'admin/PHP-ajax-request/request-admin.php'
}
function getCourses(course_ID, callback) {
    $.ajax({
        // Specify the address to which parameters will be passed.
        url: formatURL(),
        // Data will be using JSON format
        dataType: "json",
        // Parameters passed to the URL will be GET type.
        type: 'get',
        // Specify the parameters to pass and their values.
        data: {
            request_type: 'courses_get',
            course_ID: course_ID
        },
        success: function (response) {
            callback(response);
        }
    });
}
