<?php
    //INCLUDE DATABASE FILE
    include('database.php');
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();

    function getTasks($status)
    {
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
                echo '<button class="w-100 py-3 border-0 d-flex bg-gray-200 border-bottom" href="#modal-task" data-bs-toggle="modal">
                <div class="col-1 mt-1">
                  <i class="'.$icone.' h4 text-purple"></i>
              </div>
                <div class="text-start col-11 mt-1">
                  <div class="pb-2 fw-bold">
                  '.$row["title"].'
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
          } else {
            echo "0 results";
          }
    }
    function saveTask()
    {
        //CODE HERE
        //SQL INSERT
        $_SESSION['message'] = "Task has been added successfully !";
		header('location: index.php');
    }

    function updateTask()
    {
        //CODE HERE
        //SQL UPDATE
        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask() 
    {
        //CODE HERE
        //SQL DELETE
        $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }