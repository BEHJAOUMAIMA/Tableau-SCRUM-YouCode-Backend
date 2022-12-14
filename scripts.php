<?php
    //INCLUDE DATABASE FILE
  include('database.php');
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
  session_start();
    //ROUTING
  if(isset($_POST['save']))        saveTask();
  if(isset($_POST['update']))      updateTask();
  if(isset($_POST['delete']))      deleteTask();

function countTask($status){
      global $connexion;
      $sql = "SELECT * FROM `tasks` WHERE status_id = $status";
      $result = mysqli_query($connexion, $sql);
      echo mysqli_num_rows($result);
}

function getTasks($status){
    global $connexion;
      //CODE HERE
    $sql= "SELECT tasks.*,priorities.name AS 'NamePriorities',types.name AS 'NameTypes',statuses.name AS 'NameStatuses'
    from tasks join types join priorities join statuses
    on tasks.type_id = types.id
    and tasks.priority_id = priorities.id
    and tasks.status_id = statuses.id
    WHERE statuses.id = $status";
    $result = mysqli_query($connexion, $sql);
    $icone = "";
    if ($status == 1){
      $icone = 'fa fa-question cercle';
    }else if ($status == 2){
      $icone = 'fa fa-calendar';
    }else {
      $icone = 'fa fa-check';
    }
    if (mysqli_num_rows($result) > 0) {
       // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      // echo "id: " . $row["task-id"]. "title" . $row["title"]. "type_id" . $row["task-type"]. "priority_id" . $row["task-priority"]. "status_id" . $row["task-status"]. "task_datetime" . $row["task-date"]. "description" . $row["ttask-description"]."<br>";
      echo '<button class="w-100 py-3 border-0 d-flex bg-gray-200 border-bottom" id="'.$row["id"].'" title="'.$row["title"].'" status="'.$row["status_id"].'" type="'.$row["type_id"].'" priority="'.$row["priority_id"].'" date="'.$row["task_datetime"].'" description="'.$row["description"].'" href="#modal-task" data-bs-toggle="modal" onclick="editTask('.$row["id"].')">
              <div class="col-1 mt-1">
                <i class="'.$icone.' h4 text-purple"></i>
              </div>
              <div class="text-start col-11 mt-1">
                <div class="pb-2 fw-bold">'.$row["title"].'
                </div>
                <div class="">
                  <div class="pb-2">#'.$row["id"].' created in '.$row["task_datetime"].'</div>
                    <div class="text-truncate" style="max-width:18rem" title='.$row["description"].'">
                      '.$row["description"].'}
                    </div>
                  </div>
                  <div class="h5 d-flex pt-3">
                    <span class="btn btn-sm btn-primary me-2  p-1 px-2">'.$row["NamePriorities"].'</span>
                    <span class="btn btn-sm btn-light text-black me-2 p-1 px-2">'.$row["NameTypes"].'</span>
                  </div>
              </div>
            </button>';
            }
          } 
    }


    function saveTask(){
  global $connexion;
    //CODE HERE
  // if(isset($_POST['save'])){
    $title =  $_POST['title'];
    $type= $_POST['task-type'];
    $priority =  $_POST['task-priority'];
    $status =  $_POST['task-status'];
    $date = $_POST['task-date'];
    $description = $_POST['task-description'];
    
    $ajout = "INSERT INTO `tasks`(`id`, `title`, `type_id`, `priority_id`, `status_id`, `task_datetime`, `description`) VALUES ('','$title','$type','$priority','$status','$date','$description')";
    mysqli_query($connexion, $ajout);

  // }
    //SQL INSERT
    $_SESSION['message'] = "Task has been added successfully !";
		header('location: index.php');
    // if(empty($_POST['title']) || empty($_POST['task-type']) || empty($_POST['task-priority']) || empty($_POST['task-date']) ){
    //   $_SESSION['message'] = "Please fill in the fields !! ";
    // // header('location: index.php');
    // }
}

function updateTask(){
  global $connexion;
    //CODE HERE
  $id = $_POST["id"];
  $title =  $_POST['title'];
  $type= $_POST['task-type'];
  $priority =  $_POST['task-priority'];
  $status =  $_POST['task-status'];
  $date = $_POST['task-date'];
  $description = $_POST['task-description'];
  $update= "UPDATE `tasks` SET `id`='$id',`title`='$title',`type_id`=' $type', `priority_id`='$priority',`status_id`='$status',`task_datetime`='$date',`description`='$description' WHERE id=$id";
    if (mysqli_query($connexion, $update)) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_error($connexion);
    }
     //SQL UPDATE
  $_SESSION['message'] = "Task has been updated successfully !";
	header('location: index.php');
}

function deleteTask(){
  global $connexion;
    //CODE HERE
  $id = $_POST["id"];
    // request: 
  $supprimer="DELETE FROM `tasks` WHERE id=$id";   
  if (mysqli_query($connexion, $supprimer)) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . mysqli_error($connexion);
  }    
    //SQL DELETE
  $_SESSION['message'] = "Task has been deleted successfully !";
	header('location: index.php');
}