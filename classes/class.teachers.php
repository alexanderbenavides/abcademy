<?php

/**
 * Handles student interactions within the app
 *
 * PHP version 7
 *
 * @author Alexander Benavides
 *
 */
class Teacher
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

    public function getTeacherByCourse($filters)
    {

      try {
      $sql="SELECT firstName,lastName FROM courses c INNER JOIN teachers t ON c.teacherID = t.teacherID";
      
          $conditions = [] ;
          if (isset($filters['course-id']) && !empty($filters['course-id'])) {
            $conditions[] = " courseID = '" . $filters['course-id']."'";
        }          
        if (count($conditions) > 0) {
          $i = 0;

          foreach ($conditions as $condition) {
              if ($i == 0) {
                  $sql .= " WHERE" . $condition;
              } else {
                  $sql .= " AND" . $condition;
              }

              $i++;
          }
      }          
          $stmt = $this->_db->prepare($sql);
          $stmt->execute();
          $courses = $stmt->fetchAll(PDO::FETCH_CLASS);
          return $courses;
          $stmt->closeCursor();
      } catch (PDOException $e) {
          return FALSE;
      }

    }

    public function getTeachers()
    {

      try {
      $sql="SELECT * FROM teachers";        
          $stmt = $this->_db->prepare($sql);
          $stmt->execute();
          $courses = $stmt->fetchAll(PDO::FETCH_CLASS);
          return $courses;
          $stmt->closeCursor();
      } catch (PDOException $e) {
          return FALSE;
      }

    }

}


?>
