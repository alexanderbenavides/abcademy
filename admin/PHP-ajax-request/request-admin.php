<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/classes/general.topics.php";
$modules=new Topic($db);
if (isset($_GET['request_type'])) {
  if ($_GET['request_type']=='courses_get' && isset($_GET['course_ID'])) {
    $response = array();
    $row=$modules->getModuleIdAdmin($_GET['course_ID']);
    foreach ($row as $moduleIDs) {
      $module = $modules->getModuleDataAdmin($moduleIDs['moduleID']);
        array_push($response, array(
            'id' => $module['moduleID'],
            'title' => $module['moduleTitle']
        ));
    }
    echo json_encode(json_encode($response));
  }
}
 ?>
