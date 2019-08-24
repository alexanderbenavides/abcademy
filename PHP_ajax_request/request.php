<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/classes/general.topics.php";
$topics=new Topic($db);
if (isset($_GET['request_type'])) {
  if ($_GET['request_type']=='topic_get' && isset($_GET['topic_ID'])) {
    $response = array();
    $rows=$topics->getTopic($_GET['topic_ID']);
      foreach ($rows as $row) {
        array_push($response, array(
            'id' => $row['topicID'],
            'title' => $row['topicTitle'],
            'content' => $row['topicContent']
        ));
      }
      echo json_encode(json_encode($response));
  }
}
 ?>
