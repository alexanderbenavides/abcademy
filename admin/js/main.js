// IMPORTANT: Include AjaxUtils.js before including this file.

/**
 * Handles when a form changes
 *
 * @param name of the form which changed.
 */
function selectOnChange(name) {
switch (name) {
  case 'course_ID':
  // Obtain select node for course ID
  var module_ID_select = document.getElementsByName('module_ID')[0];
  // Break updating other lists if they don't exist
  if (module_ID_select == null) break;
  // List cleanup
  clearLists(1);
  getCourses(parseInt(document.getElementsByName('course_ID')[0].value), function (response) {
      var array = $.parseJSON(response);
      // Loop through the response of courses
      for (var index = 0; index < array.length; index++) {
          // Assign course ID to variable
          var course_id = array[index]['id'];
          // Assign course title to variable
          var course_title = array[index]['title'];
          // Create new option tag
          var course_option = document.createElement('option');
          // Set up course...
          course_option.value = course_id;
          course_option.appendChild(document.createTextNode(course_id + " - " + course_title));
          // Append the new option to the select list.
          module_ID_select.appendChild(course_option);
      }
  });
  break;
  default:

}
}
function clearLists(level) {

    var blank_option = null;

    switch (level) {
        case 1:
            var module_ID_select = document.getElementsByName('module_ID')[0];
            module_ID_select.disabled = false;
            while (module_ID_select.firstChild) {
                module_ID_select.removeChild(module_ID_select.firstChild);
            }
            blank_option = document.createElement('option');
            blank_option.disabled = true;
            blank_option.selected = true;
            blank_option.value = "";
            blank_option.text="Seleciona";
            module_ID_select.appendChild(blank_option);
            break;
        default:
            break;
    }

}
