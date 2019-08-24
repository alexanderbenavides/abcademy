<style>
body{
  background-color: #ffffff !important;
}
</style>
<?php
include_once "managment/base.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager-main.php";
$pageTitle = "Curso".' '.$_GET['id'].' '.'Módulo'.' '.$_GET['moduleid'].' '.'Tema'.' '.$_GET['topicid'];
include_once "includes/header.php";
include_once "classes/general.modules.php";
$module = new Module($db);
include_once "classes/general.topics.php";
$topic = new Topic($db);
?>
<div class="" style="width:100%;min-height:100vh;background-color:#ffffff;">
  <section class="section-container clearfix" style="position:relative;">
    <div id="accordion" class="accordion" style="width:20%;position:fixed;top:100px;z-index:1;height: 90%;overflow-y: scroll;">
      <?php if (isset($_GET['moduleid']) && isset($_GET['topicid'])): ?>
        <?php
        $nextTopicID = 0;
        $previousTopicID = 0;

        $modulesData = $module->getModulesData($_GET['id'], $moduleID = $_GET['moduleid']);

        $nextTopicID = $module->getLessonNavigationNext($_GET['topicid']);
        $previousTopicID = $module->getLessonNavigationPrevious($_GET['topicid']);
         $previousTopicID['topicTitle'].' '.$previousTopicID['previuosTopicID'];
         $nextTopicID['topicTitle'].' '.$nextTopicID['nextTopicID'].'<br>';
        if ($previousTopicID['previuosTopicID'] =='') {
          $previousModuleID = $module->getModulesNavigationPreviuos($_GET['moduleid']);
          $previousTopicID['previuosTopicID'] = $previousModuleID['topicID'];
          $previousTopicID['moduleID'] = $previousModuleID['moduleID'];
          $previousTopicID['topicTitle'] = $previousModuleID['topicTitle'];
        }

        if ($nextTopicID['nextTopicID'] =='') {
          $nextModuleID = $module->getModulesNavigationNext($_GET['moduleid']);
          $nextTopicID['nextTopicID'] = $nextModuleID['topicID'];
          $nextTopicID['moduleID'] = $nextModuleID['moduleID'];
          $nextTopicID['topicTitle'] = $nextModuleID['topicTitle'];
        }
        $displayButtonNavNext = '';
        $displayButtonNavPrevious = '';

        $maxTopicID = $module->getCourseNavigationNext($_GET['id']);
        if ($maxTopicID['maxTopicID'] == $_GET['topicid']) {
        $displayButtonNavNext = 'hidden';
        }else {
        $displayButtonNavNext = 'visible';
       }

       $minTopicID = $module->getCourseNavigationPrevious($_GET['id']);
       if ($minTopicID['minTopicID'] == $_GET['topicid']) {
         $displayButtonNavPrevious = 'hidden';
       }else {
         $displayButtonNavPrevious = 'visible';
       }

        $count = 0;
        $collapse = '';
        $show = '';
        $ariaExpanded = '';
        foreach ($modulesData as $key => $moduleData) {
          $modulesContent = $module->getModulesContent($moduleData['moduleID'],$topicID = $_GET['topicid']);
          $count = $count + 1;
          $formatList = '';
          foreach ($modulesContent as $key => $moduleContent) {
            if ($topicID != 0 && $topicID == intval($moduleContent['topicID'])) {
              $formatList .= '<li id="topic_id_'.$moduleContent['topicID'].'" class="list-group-item" style="background-color:#204056;"><a href="/course?id='.$moduleContent['courseID'].'&moduleid='.$moduleContent['moduleID'].'&topicid='.$moduleContent['topicID'].'" style="color:#ffffff;">'.$moduleContent['topicTitle'].'</a></li>';
            }else {
              $formatList .= '<li class="list-group-item"><a href="/course?id='.$moduleContent['courseID'].'&moduleid='.$moduleContent['moduleID'].'&topicid='.$moduleContent['topicID'].'">'.  $moduleContent['topicTitle'].'</a></li>';
            }
          }
          if ($moduleID != 0 && $moduleID == intval($moduleData['moduleID'])) {
            $collapse = 'collapsed';
            $show = 'show';
            $ariaExpanded = 'true';
          }else {
            $collapse = '';
            $show = '';
            $ariaExpanded = 'false';
          }
          echo '
          <div class="card" >
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link '.$collapse.'" data-toggle="collapse" data-target="#collapseTwo'.$count.'" aria-expanded="'.$ariaExpanded.'" aria-controls="collapseTwo">
                 '.$moduleData['moduleTitle'].'
                </button>
              </h5>
            </div>
            <div id="collapseTwo'.$count.'" class="collapse '.$show.'" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <ul class="list-group list-group-flush">
                '.$formatList.'
                </ul>
               </div>
            </div>
          </div>
          ';
        }
        $getTopic = $topic -> getTopic($_GET['topicid']);
        $display ='';
        if ($getTopic == FALSE) {
          $display = 'none';
        }
        echo '
      </div>
        <div class="topic-container" style="width:76%;padding:20px;border-left:1px solid rgba(0,0,0,.125);right:0;position:absolute;top:80px; display:'.$display.'">
            <div class="tittle-content">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/index">Inicio</a></li>
                  <li class="breadcrumb-item"><a href="#" style="text-decoration: none;cursor:text;">'.$getTopic['moduleTitle'].'</a></li>
                  <li class="breadcrumb-item active" aria-current="page">'.$getTopic['topicTitle'].'</li>
                </ol>
              </nav>
            <p>'.$getTopic['topicTitle'].'</p>
            </div>
        <div class="topic-content" style="width:100%;">
        '.$getTopic['topicContent'].'
           <hr />
            <nav aria-label="Page navigation example">
              <ul class="pagination" style="width:100%;">
                <li class="page-item" style="visibility:'.$displayButtonNavPrevious.';"><a class="page-link" href="/course?id='.$_GET['id'].'&moduleid='.$previousTopicID['moduleID'].'&topicid='.$previousTopicID['previuosTopicID'].'" style="background:#34b3a0;color:#ffffff;padding:0 20px 0 20px;">'.$previousTopicID['topicTitle'].'</a></li>
                <li class="page-item" style="visibility:'.$displayButtonNavNext.';float:right;"><a class="page-link" href="/course?id='.$_GET['id'].'&moduleid='.$nextTopicID['moduleID'].'&topicid='.$nextTopicID['nextTopicID'].'" style="background:#34b3a0;color:#ffffff;padding:0 20px 0 20px;">'.$nextTopicID['topicTitle'].'</a></li>
              </ul>
           </nav>
        </div>';
         ?>
        <?php else: ?>
          <?php         header('Location: /index');?>
      <?php endif; ?>
    </div>
  </section>
</div>

<!-- COMMON SCRIPTS -->
<script src="js/common_scripts.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>
<script src="js/main.js"></script>
<script src="js/ajax-request.js"></script>

</body>
</html>