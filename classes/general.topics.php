<?php

/**
 * Handles course interactions within the app
 *
 * PHP version 7
 *
 * @author Alexander Benavides
 *
 */
class Topic
{
    /**
     * The database object
     *
     * @var object
     */
    private $_db;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db = NULL)
    {
        if (is_object($db)) {
            $this->_db = $db;
        } else {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }
    public function getModuleIdAdmin($courseID)
    {
      $sql = "SELECT moduleID
              FROM modules
              WHERE courseID = :cid";

      if ($stmt = $this->_db->prepare($sql)) {
          $stmt->bindParam(':cid', $courseID, PDO::PARAM_STR);
          $stmt->execute();
          $rows = $stmt->fetchAll();
          $stmt->closeCursor();

          return $rows;
      } else {
          return FALSE;
      }
    }
    public function getModuleDataAdmin($moduleID)
    {
        $sql = "SELECT *
                FROM modules WHERE moduleID=:mid";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':mid', $moduleID, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $stmt->closeCursor();
            return $row;
        } catch (PDOException $e) {
            return FALSE;
        }
    }
    public function addTopicAdmin()
    {
      $moduleID=$_POST['module_ID'];
      $position=0;
      $sql="SELECT MAX(position) AS maxPosition FROM topics WHERE moduleID=:mid";
      if($stmt=$this->_db->prepare($sql)){
        $stmt->bindParam(':mid', $moduleID, PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch();
        $position=$row['maxPosition'];
        $stmt->closeCursor();
      }
      $position=$position+1;

      $sql="INSERT INTO topics (topicTitle,topicContent,moduleID,position)
            VALUES(:title,:content,:mid,:pos)";
      if($stmt=$this->_db->prepare($sql)){
        $stmt->bindParam(':title', $_POST['topic_title'], PDO::PARAM_STR);
        $stmt->bindParam(':content',  $_POST['topic_content'], PDO::PARAM_STR);
        $stmt->bindParam(':mid', $moduleID, PDO::PARAM_STR);
        $stmt->bindParam(':pos', $position, PDO::PARAM_STR);
        $stmt->execute();
        $lastID=$this->_db->lastInsertId();
        $stmt->closeCursor();
        return '
        <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
        Se ha creado el m&oacute;dulo <a href="topic.php?id='.$lastID.'">'.$_POST['topic_title'].'</a>
        </div>
        ';
      }else {
        return '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Error</h4>
      No se pudo introducir la nueva informaci&oacute;n del m&oacute;dulo a la base de datos.
    </div>';
  }
    }

    public function getTopic($topicID){
      $sql = "SELECT topicTitle,topicContent,moduleTitle
              FROM topics,modules
              WHERE topics.moduleID = modules.moduleID
              AND topicID=:tid";
      try {
          $stmt = $this->_db->prepare($sql);
          $stmt->bindParam(':tid', $topicID, PDO::PARAM_STR);
          $stmt->execute();
          $topic = $stmt->fetch();
          return $topic;
          $stmt->closeCursor();
      } catch (PDOException $e) {
          return FALSE;
      }
    }
    //Get coursesList
    public function getTopicsListAdmin()
    {
      $sql="SELECT courseTitle,moduleTitle,topicID,topicTitle,Topics.published
            FROM modules,courses,topics
            WHERE topics.moduleID=modules.moduleID
            AND modules.courseID=courses.CourseID";
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        while ($row=$stmt->fetch()) {
          echo $this->formatTopicsListAdmin($row);
        }
        $stmt->closeCursor();

      } catch (PDOException $e) {

      }

    }
    private function formatTopicsListAdmin($row)
    {
      $status=$row['published'];
      if ($status==0) {
        $status='<button type="button" class="btn btn-warning">No publicado</button>';
      }else {
        $status='<button type="button" class="btn btn-success">Publicado</button>';
      }
      $base='
      <tr>
      <th scope="row"><a href="topic?id='.$row['topicID'].'" class="text-danger">'.$row['topicID'].'</a></th>
        <td>'.$row['courseTitle'].'</td>
        <td>'.$row['moduleTitle'].'</td>
        <td>'.$row['topicTitle'].'</td>
        <td>'.$status.'</td>
      </tr>
      ';
      return $base;
    }
    public function getTopicContentAdmin($topicID)
    {
      $sql="SELECT courses.courseID,courseTitle,modules.moduleID,
            moduleTitle,topicID,topicTitle,topicContent
            FROM modules,courses,topics
            WHERE courses.courseID=modules.courseID
            AND modules.moduleID=topics.moduleID
            AND topicID=:tid";
      try {
        $stmt=$this->_db->prepare($sql);
        $stmt->bindParam(':tid', $topicID, PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch();
        return $row;
        $stmt->closeCursor();
      } catch (PDOException $e) {

      }

    }
    public function saveTopicAdmin()
    {
      if (isset($_POST['save_button'])) {
        return $this->updateTopicAdmin();
      }
    }

    private function updateTopicAdmin()
 {
     $sql = "UPDATE topics
             SET topicTitle=:title,topicContent=:content,moduleID=:mid
             WHERE topicID=:tid";
     try
     {
         $stmt = $this->_db->prepare($sql);
         $stmt->bindParam(':title', $_POST['topic_title'], PDO::PARAM_STR);
         $stmt->bindParam(':content', $_POST['topic_content'], PDO::PARAM_STR);
         $stmt->bindParam(':mid', $_POST['module_ID'], PDO::PARAM_INT);
         $stmt->bindParam(':tid', $_POST['topic_ID'], PDO::PARAM_INT);
         $stmt->execute();
         $stmt->closeCursor();
         return '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
         Los nuevos datos del tema han sido guardados en la base de datos.
       </div>';
     } catch(PDOException $e) {
    return '<div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-ban"></i> Error</h4>
         No se pudo introducir la nueva informaci&oacute;n del tema a la base de datos.
       </div>';
     }
 }

  }
