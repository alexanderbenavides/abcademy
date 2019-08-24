<?php

/**
 * Handles course interactions within the app
 *
 * PHP version 7
 *
 * @author Alexander Benavides
 *
 */
class Module
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
    public function getCoursesAdmin()
    {
      $sql="SELECT* FROM courses";
      if($stmt=$this->_db->prepare($sql)){
        $stmt->execute();
        $rows=$stmt->fetchAll();
        foreach ($rows as $row) {
          echo $this->formatCoursesAdmin($row);
        }
        $stmt->closeCursor();

      }
    }
    private function formatCoursesAdmin($row){
      $base='
      <option value="'.$row['courseID'].'">'.$row['courseTitle'].'</option>
      ';
      return $base;
    }
    public function addModuleAdmin()
    {
      $courseID=$_POST['course_ID'];
      $position=0;
      //Select Max position module
      $sql="SELECT MAX(position) AS maxPosition FROM modules WHERE courseID=:cid";
      if($stmt=$this->_db->prepare($sql)){
        $stmt->bindParam(':cid', $courseID, PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch();
        $position=$row['maxPosition'];
        $stmt->closeCursor();
      }
      $position=$position+1;

      // Create module
      $sql = "INSERT INTO modules (moduleTitle, CourseID, position)
              VALUES (:title, :cid, :pos)";
      if($stmt=$this->_db->prepare($sql)){
        $stmt->bindParam(':title', $_POST['module_title'], PDO::PARAM_STR);
        $stmt->bindParam(':cid', $courseID, PDO::PARAM_STR);
        $stmt->bindParam(':pos', $position, PDO::PARAM_STR);
        $stmt->execute();
        $lastID=$this->_db->lastInsertId();
        $stmt->closeCursor();
        return '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
        Se ha creado el m&oacute;dulo <a href="module.php?id='.$lastID.'">'.$_POST['module_title'].'</a>
      </div>';
    } else {
        return '<div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Error</h4>
      No se pudo introducir la nueva informaci&oacute;n del m&oacute;dulo a la base de datos.
    </div>';
    }
  }
  public function getModulesData($courseID, $countMid = 0)
  {
    $sql="SELECT * FROM modules
          WHERE courseID=:cid";
          if($stmt=$this->_db->prepare($sql)){
            $stmt->bindParam(':cid', $courseID, PDO::PARAM_STR);
            $stmt->execute();
            $modules=$stmt->fetchAll();
            return $modules;
            $stmt->closeCursor();
        }
  }
  public function getModulesContent($moduleID,$countTid = 0)
  {
    $sql="SELECT topicID,topicTitle,topicContent,modules.courseID,modules.moduleID
          FROM topics,modules,courses
          WHERE topics.moduleID = modules.moduleID
          AND modules.courseID = courses.courseID
          AND modules.moduleID=:mid";
          if($stmt=$this->_db->prepare($sql)){
            $stmt->bindParam(':mid', $moduleID, PDO::PARAM_STR);
            $stmt->execute();
            $modulesContent = $stmt->fetchAll();
            return $modulesContent;
            $stmt->closeCursor();

          }
    }

    public function getLessonNavigationNext($topicID)
    {
      $sql="SELECT (topicID) AS nextTopicID,topics.moduleID,topicTitle
            FROM topics
            WHERE topics.moduleID = (SELECT topics.moduleID FROM topics WHERE topics.topicID=:tid)
            AND topicID>:tid";
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':tid', $topicID, PDO::PARAM_STR);
        $stmt->execute();
        $nextTopicID = $stmt->fetch();
        return $nextTopicID;
        $stmt->closeCursor();

      } catch (PDOException $e) {

      }

    }
    public function getModulesNavigationNext($moduleID)
    {
      $sql="SELECT MIN(modules.moduleID) AS moduleID,topicID,topicTitle
            FROM topics,modules
            WHERE modules.courseID = (SELECT modules.courseID FROM modules WHERE modules.moduleID=:mid)
            AND topics.moduleID = modules.moduleID
            AND modules.moduleID>:mid";
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':mid', $moduleID, PDO::PARAM_STR);
        $stmt->execute();
        $nextModuleID = $stmt->fetch();
        return $nextModuleID;
        $stmt->closeCursor();

      } catch (PDOException $e) {

      }

    }

    public function getModulesNavigationPreviuos($moduleID)
    {
      $sql="SELECT MAX(modules.moduleID) AS moduleID
            FROM topics,modules
            WHERE modules.courseID = (SELECT modules.courseID FROM modules WHERE modules.moduleID=:mid)
            AND topics.moduleID = modules.moduleID
            AND modules.moduleID<:mid";
      try {
        $arrayFormat = array();
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':mid', $moduleID, PDO::PARAM_STR);
        $stmt->execute();
        $previousModuleID = $stmt->fetch();
        $stmt->closeCursor();
        $sql="SELECT MAX(topics.topicID) AS topicID
              FROM topics
              WHERE topics.moduleID=:mid";
        try {
          $stmt = $this->_db->prepare($sql);
          $stmt->bindParam(':mid', $previousModuleID['moduleID'], PDO::PARAM_STR);
          $stmt->execute();
          $maxTopicID = $stmt->fetch();
          $stmt->closeCursor();
          $sql="SELECT topicTitle
                FROM topics
                WHERE topicID=:tid";
          try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':tid', $maxTopicID['topicID'], PDO::PARAM_STR);
            $stmt->execute();
            $topicTitle = $stmt->fetch();
            if ($topicTitle == FALSE) {
              return FALSE;
            }
            $arrayFormat = array_merge($maxTopicID,$previousModuleID,$topicTitle);
            return $arrayFormat;
            $stmt->closeCursor();
          } catch (\Exception $e) {

          }
        } catch (\Exception $e) {

        }


      } catch (PDOException $e) {

      }

    }

    public function getCourseNavigationNext($courseID)
    {
      $sql="SELECT MAX(topics.moduleID) AS maxModuleID
            FROM topics,modules
            WHERE topics.moduleID = modules.moduleID
            AND modules.courseID=:cid
            ";
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':cid', $courseID, PDO::PARAM_STR);
        $stmt->execute();
        $maxModuleID = $stmt->fetch();
        $stmt->closeCursor();
        $sql="SELECT MAX(topics.topicID) AS maxTopicID
              FROM topics
              WHERE topics.moduleID=:mid
              ";
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':mid', $maxModuleID['maxModuleID'], PDO::PARAM_STR);
        $stmt->execute();
        $maxTopicID = $stmt->fetch();
        return $maxTopicID;
        $stmt->closeCursor();
      } catch (\Exception $e) {

      }

      } catch (PDOException $e) {

      }

    }

    public function getCourseNavigationPrevious($courseID)
    {
      $sql="SELECT MIN(topics.moduleID) AS minModuleID
            FROM topics,modules
            WHERE topics.moduleID = modules.moduleID
            AND modules.courseID=:cid
            ";
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':cid', $courseID, PDO::PARAM_STR);
        $stmt->execute();
        $minModuleID = $stmt->fetch();
        $stmt->closeCursor();
        $sql="SELECT MIN(topics.topicID) AS minTopicID
              FROM topics
              WHERE topics.moduleID=:mid
              ";
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':mid', $minModuleID['minModuleID'], PDO::PARAM_STR);
        $stmt->execute();
        $minTopicID = $stmt->fetch();
        return $minTopicID;
        $stmt->closeCursor();
      } catch (\Exception $e) {

      }

      } catch (PDOException $e) {

      }

    }

    public function getLessonNavigationPrevious($topicID)
    {
      $sql="SELECT MAX(topicID) AS previuosTopicID,topics.moduleID
            FROM topics
            WHERE topics.moduleID = (SELECT topics.moduleID FROM topics WHERE topics.topicID=:tid)
            AND topicID<:tid";
        $arrayFormat = array();
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':tid', $topicID, PDO::PARAM_STR);
        $stmt->execute();
        $previousTopicID = $stmt->fetch();
        $stmt->closeCursor();
        $sql="SELECT topicTitle
              FROM topics
              WHERE topicID=:tid";
        try {
          $stmt = $this->_db->prepare($sql);
          $stmt->bindParam(':tid', $previousTopicID['previuosTopicID'], PDO::PARAM_STR);
          $stmt->execute();
          $topicTitle = $stmt->fetch();
          if ($topicTitle == FALSE) {
            return FALSE;
          }
          $arrayFormat = array_merge($topicTitle,$previousTopicID);
          return $arrayFormat;
          $stmt->closeCursor();
        } catch (\Exception $e) {

        }


      } catch (PDOException $e) {

      }

    }

    //Get coursesList
    public function getModulesListAdmin()
    {
      $sql="SELECT courseTitle,moduleID,moduleTitle,modules.published
            FROM modules,courses
            WHERE modules.courseID=courses.CourseID";
      try {
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        while ($row=$stmt->fetch()) {
          echo $this->formatModulesListAdmin($row);
        }
        $stmt->closeCursor();

      } catch (PDOException $e) {

      }

    }
    private function formatModulesListAdmin($row)
    {
      $status=$row['published'];
      if ($status==0) {
        $status='<button type="button" class="btn btn-warning">No publicado</button>';
      }else {
        $status='<button type="button" class="btn btn-success">Publicado</button>';
      }
      $base='
      <tr>
      <th scope="row"><a href="module?id='.$row['moduleID'].'" class="text-danger">'.$row['moduleID'].'</a></th>
        <td>'.$row['moduleTitle'].'</td>
        <td>'.$row['courseTitle'].'</td>
        <td>'.$status.'</td>
      </tr>
      ';
      return $base;
    }

    public function getModuleContentAdmin($moduleID)
    {
      $sql="SELECT courses.courseID,courseTitle,moduleID,moduleTitle
            FROM modules,courses
           WHERE courses.courseID=modules.courseID
           AND moduleID=:mid";
      try {
        $stmt=$this->_db->prepare($sql);
        $stmt->bindParam(':mid', $moduleID, PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch();
        return $row;
        $stmt->closeCursor();
      } catch (PDOException $e) {

      }

    }
    public function saveModuleAdmin()
    {
      if (isset($_POST['save_button'])) {
        return $this->updateModuleAdmin();
      }
    }

    private function updateModuleAdmin()
 {
     $sql = "UPDATE modules
             SET moduleTitle=:title,courseID=:cid
             WHERE moduleID=:mid";
     try
     {
         $stmt = $this->_db->prepare($sql);
         $stmt->bindParam(':title', $_POST['module_title'], PDO::PARAM_STR);
         $stmt->bindParam(':cid', $_POST['course_ID'], PDO::PARAM_INT);
         $stmt->bindParam(':mid', $_POST['module_ID'], PDO::PARAM_INT);
         $stmt->execute();
         $stmt->closeCursor();
         return '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
         Los nuevos datos del m&oacute;dulo han sido guardados en la base de datos.
       </div>';
     } catch(PDOException $e) {
    return '<div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-ban"></i> Error</h4>
         No se pudo introducir la nueva informaci&oacute;n del m&oacute;dulo a la base de datos.
       </div>';
     }
 }
}
?>
