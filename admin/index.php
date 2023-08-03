<?php
require ('../commons/header.php');
?>
<title>ADMIN-IT Ticketing-</title> 
<div class="menu-items">
    <ul class="tabs">
        <li><a href="#D0" class="active">
            <i class="uil uil-estate"></i>
            <span class="link-name">Dashboard</span>
        </a></li>
        <li><a href="#D1" >
            <i class="uil uil-files-landscapes"></i>
            <span class="link-name">User Management</span>
        </a></li>
        <li><a href="#D2" >
            <i class="uil uil-files-landscapes"></i>
            <span class="link-name">Tickets</span>
        </a></li>
        <li><a href="#D3" >
            <i class="uil uil-files-landscapes"></i>
            <span class="link-name">Reports</span>
        </a></li>


    </ul>

    <ul class="logout-mode">
        <li><a href="../membership/logout.php">
            <i class="uil uil-signout"></i>
            <span class="link-name">Logout</span>
        </a></li>

        <li class="mode">
            <a href="#">
                <i class="uil uil-moon"></i>
                <span class="link-name">Dark Mode</span>
            </a>

            <div class="mode-toggle">
              <span class="switch"></span>
          </div>
      </li>
  </ul>
</div>
</nav>

<section class="dashboard">

    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>


        <span class="logo_name"><h1> ICT SUPPORT TICKETING SYSTEM</h1></span>

           <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div> -->
            <div>
                <?php 
                    function getComplaintCount($conn) {
                        $sqlQuery = "SELECT count(complaintid) as totalComplaints FROM complaints";
                        $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
                        $data = mysqli_fetch_assoc($result);
                        $totalComplaints = $data['totalComplaints'];
                        
                        return $totalComplaints;
                    }
                 ?>
                <a href="#D0" class="notification">
                <span>New Unassigned</span>
                <span id="mydiv" class="badge"></span>
                </a>
            </div>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function refreshDiv() {
                    $.ajax({
                        url: 'fetch_comp.php', // Your PHP script URL
                        method: 'GET',
                        success: function(data) {
                            var totalComplaints = data.totalComplaints;
                            var complaintCountDiv = document.getElementById("mydiv");
                            complaintCountDiv.innerHTML = totalComplaints;
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var complaintCountDiv = document.getElementById("mydiv");
                            complaintCountDiv.innerHTML = 0;
                             alert( errorThrown);
                        }
                    });
                }

                // Call the function when the page loads
                window.onload = function() {
                    refreshDiv();
                    // Repeat every 3 seconds (3000 milliseconds)
                    setInterval(refreshDiv, 3000);
                };
            </script>


            </div> 
        </div>

        <ul class="tabs-content"> 

            <li id="D0">

                <?php

                $sqlQuery = "SELECT count(complaintid) as totalComplaints, 
                count(if(status=2,1,null)) AS totalSolved,
                count(if(status=0 || status=1 ,1,null)) AS totalPending
                FROM complaints";
                $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
                while($data = mysqli_fetch_assoc($result)) {
                    $totalComplaints= $data['totalComplaints'];
                    $totalSolved= $data['totalSolved'];
                    $totalPending= $data['totalPending'];

                    echo"       

                    <div class='dash-content' >
                    <div class='overview'>
                    <div class='title'>
                    <i class='uil uil-tachometer-fast-alt'></i>
                    <span class='text'>Admin</span>
                    </div>

                    <div class='boxes'>
                    <div class='box box1'>
                    <i class='uil uil-files-landscapes'></i>
                    <span class='text'>TOTAL TICKETS</span>
                    <span class='number'>$totalComplaints</span>
                    </div>
                    <div class='box box2'>
                    <i class='uil uil-files-landscapes'></i>
                    <span class='text'>SOLVED TICKETS</span>
                    <span class='number'>$totalSolved</span>
                    </div>
                    <div class='box box3'>
                    <i class='uil uil-files-landscapes'></i>
                    <span class='text'>PENDING TICKETS</span>
                    <span class='number'>$totalPending</span>
                    </div>
                    </div>
                    </div>
                    ";
                }
                ?>
                <div class="activity">
                    <div class="title">
                        <i class="uil uil-clock-three"></i>
                        <span class="text">Recent Activity</span>
                    </div>

                    <div class="activity-data" >



                        <?php


                        $query = "SELECT ComplaintId, Description, complaints.Expert_assigned,users.Name, complaints.Status,complaints.UserId, Recipient_endtime FROM complaints LEFT JOIN users ON users.userID= complaints.Expert_assigned ORDER BY `ComplaintId` desc ";
                        $result = mysqli_query($conn, $query);


                        $complaints = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $complaints[] = $row;
                        }
                        ?>

                        <div id="adminDash" style="width: 100%;">
                            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                                <tr style=" border:1px solid #8b8c8b; border-collapse:collapse;">
                                    <th>TICKET ID</th>
                                    <th>Description</th>
                                    <th>Complainant</th>
                                    <th>Expert Assigned</th>
                                    <th>Status</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($complaints as $complaint) : ?>
                                    <tr style="background:#fdfdfd" class="clickable-row" data-description="<?php echo $data['Description'] ?? ''; ?>">
                                        <td><?php echo $complaint['ComplaintId']; ?></td>
                                        <td><?php echo $complaint['Description']; ?></td>
                                        <?php
                                                $userrid= $complaint['UserId'];
                                                $squery = "  SELECT Name FROM users  where `UserId` =$userrid ";
                                                $sresult = mysqli_query($conn, $squery);
                                                $row = mysqli_fetch_assoc($sresult); 
                                                     //echo $row['Name'];
                                                
                                                ?>



                                                <td><?php echo $row['Name']; ?></td>
                                        <td><?php 
                                        if ($complaint['Name']=='') {
                                            $Name ="None";
                                        } else {
                                            $Name= $complaint['Name'];
                                        } 
                                        echo $Name; ?></td>
                                        <td class="<?php echo ($complaint['Status'] === 0) ? 0 : 1; ?>">

                                            <?php 

                                            if ($complaint['Status']==0) {
                                                $Status ="Pending";
                                            } else if ($complaint['Status']==1) {
                                                $Status= "Assigned";
                                            } 
                                            else{
                                                $Status= "Completed";
                                            }
                                            echo $Status; ?></td>
                                            <td>
                                             <?php if ($complaint['Status'] == 0) : ?>
                                                <?php echo "Ticket is still open";?>

                                            <?php else: ?>
                                                <?php echo $complaint['Recipient_endtime']; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>     
                                         <?php if ($complaint['Status'] == 1) : ?>        
                                           <!-- <form class="markSolve" name="markSolve" >
                                                <input type="text" style="display: none;" class="issue" name="issue" value=<?php echo $complaint['ComplaintId']; ?>>

                                                <button  style=" padding: 5px 10px; border: none;  background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Mark as Solved</button>
                                            </form> -->


                                            <?php 
                                        elseif ($complaint['Status'] == 0) :?> 
                                            <button  onclick="location.href='#D2';" style=" padding: 5px 10px; border: none;  background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Assign Officer</button>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>  

                
            </div>
            </div>
        </li>



    <li id="D1">
        <?php

        $sqlQuery = "SELECT count(userid) as totalUsers, 
        count(if(status='Yes',1,null)) AS totalActive,
        count(if(status='No',1,null)) AS totalInactive
        FROM users";
        $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
        while( $data = mysqli_fetch_assoc($result) ) {
            $total= $data['totalUsers'];
            $active= $data['totalActive'];
            $inactive= $data['totalInactive'];

            echo"


            <div class='dash-content'>
            <div class='overview'>
            <div class='title'>
            <i class='uil uil-tachometer-fast-alt'></i>
            <span class='text'>User Management</span>
            </div>

            <div class='boxes'>
            <div class='box box1'>
            <i class='uil uil-files-landscapes'></i>
            <span class='text'>TOTAL USERS</span>
            <span class='number'>$total</span>
            </div>
            <div class='box box2'>
            <i class='uil uil-files-landscapes'></i>
            <span class='text'>ACTIVE</span>
            <span class='number'>$active</span>
            </div>
            <div class='box box3'>
            <i class='uil uil-files-landscapes'></i>
            <span class='text'>AWAITING CONFIRMATION</span>
            <span class='number'>$inactive</span>
            </div>
            </div>
            </div>
            ";
        }
        ?>
        <div class="cssAnimsDemo">
          <div class="tabWrap">


            <!-- Links for Desktop -->
            <input id="tabLink1" type="radio" name="tabs" checked>
            <label for="tabLink1" class="desktopTabLink" style="width: 32%;">Confirm Users</label>

            <input id="tabLink2" type="radio" name="tabs">
            <label for="tabLink2" class="desktopTabLink" style="width: 32%;">Edit Users</label>

            <input id="tabLink3" type="radio" name="tabs">
            <label for="tabLink3" class="desktopTabLink" style="width: 32%;">Delete Users</label>



            <!-- Links for Mobile -->
            <input id="tabLinkMobile1" type="radio" name="tabs" checked>
            <label for="tabLinkMobile1" class="mobileAccordionLink">Confirm Users</label>

            <!-- Content -->
            <article class="tabContent" id="tabContent1">

                <?php 
                $sqlQuery = "SELECT UserId, name, usertype, aos, date_created, status FROM users where status ='No'";
                $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
                $users = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $users[] = $row;
                }
                ?>

                <div id="userConfirmT" style="width: 100%;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                        <tr style=" border:1px solid #8b8c8b; border-collapse:collapse;">
                            <th>User ID</th> 
                            <th>Name</th>
                            <th>Date Created</th>
                            <th>AOS</th>
                            <th>User Type</th>
                            <th>Status</th>    
                        </tr>
                        <?php foreach ($users as $user) : ?>
                            <form class="userConfirm" name="userConfirm" >
                                <input type="text" style="display: none;" class="userid" name="userid" value=<?php echo $user['UserId']; ?>>
                                <td><?php echo $user['UserId']; ?></td>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $user['date_created']; ?></td>
                                <td><?php echo $user['aos']; ?></td>
                                <td>
                                    <select required id = "usertype" name ="usertype" style=" padding: 5px 10px; border: none; background-color: #333; color: #fff; cursor: pointer;">
                                        <option value="" disabled selected>Select User Type</option>
                                        <option  value= "Admin"> Admin</option>
                                        <option  value= "Service Desk"> Service Desk</option>
                                        <option  value= "IT Support"> IT Support</option>
                                        <option  value= "Client"> Client</option>
                                    </select>
                                </td>
                                <td class="<?php echo ($user['status'] === "No" ) ? 0 : 1; ?>">

                                    <?php 

                                    if ($user['status']== "No") {
                                        $status ="Unconfirmed";
                                    } 
                                    echo $status; ?>

                                </td>
                                <td>       

                                    <button  style=" padding: 5px 10px; border: none;  background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Confirm</button>

                                </td>
                            </tr>
                        </form>
                    <?php endforeach; ?>

                </table>
            </div>




        </article>
        <!-- Links for Mobile -->
        <input id="tabLink2" type="radio" name="tabs">
        <label for="tabLink2" class="mobileAccordionLink">Edit Users</label>

        <!-- Content -->
        <article class="tabContent" id="tabContent2">

            <?php 
            $sqlQuery = "SELECT UserId, name, usertype, aos, date_created, status FROM users WHERE status != 'deleted' ";
            $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
            $users = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
            ?>

            <div id="userEditT" style="width: 100%;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <tr style=" border:1px solid #8b8c8b; border-collapse:collapse;">
                        <th>User ID</th> 
                        <th>Name</th>
                        <th>User Type</th>
                        <th>AOS</th>
                        <th>Date Created</th>
                        <th>Status</th>   
                    </tr>
                    <?php foreach ($users as $user) : ?>
                        <form class="userEdit" name="userEdit" >
                            <input type="text" style="display: none;" class="userid" name="userid" value=<?php echo $user['UserId']; ?>>
                            <td><?php echo $user['UserId']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td>
                                <select required class = "usertype" name ="usertype" style=" padding: 5px 10px; border: none; background-color: #333; color: #fff; cursor: pointer;">
                                    <option value="" disabled selected>Select User Type</option>
                                    <option  value= "Admin"> Admin</option>
                                    <option  value= "Service Desk"> Service Desk</option>
                                    <option  value= "IT Support"> IT Support</option>
                                </select>
                            </td>
                            <td>
                                <select required class = "aos" name ="aos" style=" padding: 5px 10px; border: none; background-color: #333; color: #fff; cursor: pointer;">
                                    <option value="" disabled selected>Select Area of Specialization</option>
                                    <option  value= "Networking">Networking</option>
                                    <option  value= "Software">Software</option>
                                    <option  value= "Hardware">Hardware</option>
                                </select>
                            </td>
                            <td><?php echo $user['date_created']; ?></td>
                            <td class="<?php echo ($user['status'] === "No" ) ? 0 : 1; ?>">

                                <?php 

                                if ($user['status']== "No") {
                                    $status ="Unconfirmed";
                                }
                                elseif ($user['status']== "Yes") {
                                 $status ="Confirmed";
                             } 
                             echo $status; ?>

                         </td>
                         <td>       

                            <button  style=" padding: 5px 10px; border: none;  background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Save</button>

                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>

        </table>
    </div>

</article>


<!-- Links for Mobile -->
<input id="tabLinkMobile3" type="radio" name="tabs">
<label for="tabLinkMobile3" class="mobileAccordionLink">Delete Users</label>

<!-- Content -->
<article class="tabContent" id="tabContent3">
    <?php 
    $sqlQuery = "SELECT UserId, name, usertype, aos, date_created, status FROM users  WHERE status != 'deleted' ";
    $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    ?>
    <div id="userDeleteT" style="width: 100%;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr style=" border:1px solid #8b8c8b; border-collapse:collapse;">
                <th>User ID</th> 
                <th>Name</th>
                <th>User Type</th>
                <th>AOS</th>
                <th>Date Created</th>
                <th>Status</th>   
            </tr>
            <?php foreach ($users as $user) : ?>
                <td><?php echo $user['UserId']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['usertype']; ?></td>
                <td><?php echo $user['aos']; ?></td>
                <td><?php echo $user['date_created']; ?></td>
                <td class="<?php echo ($user['status'] === "No" ) ? 0 : 1; ?>">

                    <?php 

                    if ($user['status']== "No") {
                        $status ="Unconfirmed";
                    }
                    elseif ($user['status']== "Yes") {
                     $status ="Confirmed";
                 } 
                 echo $status; ?>

             </td>
             <td>  
                <form class="userDelete" name="userDelete" >
                    <input type="text" style="display: none;" class="userid" name="userid" value=<?php echo $user['UserId']; ?>>                                
                    <button  style=" padding: 5px 10px; border: none;  background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Delete</button>
                </td>
            </tr>
        </form>
    <?php endforeach; ?>

</table>
</div>
<script>


</script>
</article>
</div>
</div>
</div>
</li>
<li id="D2">


    <div class="dash-content">

     <?php

     $sqlQuery = "SELECT count(complaintid) as totalComplaints, 
     count(if(status=2,1,null)) AS totalSolved,
     count(if(status=1,1,null)) AS totalAssigned,
     count(if(status=0,1,null)) AS totalPending
     FROM complaints ";
     $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
     while( $data = mysqli_fetch_assoc($result) ) {
        $totalComplaints= $data['totalComplaints'];
        $totalAssigned= $data['totalAssigned'];
        $totalSolved= $data['totalSolved'];
        $totalPending= $data['totalPending'];

        echo" 

        <div class='overview'>
        <div class='title'>
        <i class='uil uil-tachometer-fast-alt'></i>
        <span class='text'>Tickets</span>
        </div>

        <div class='boxes'>
        <div class='box box3' >
        <i class='uil uil-files-landscapes'></i>
        <span class='text'>TICKETS</span>
        <span class='number'>$totalComplaints</span>
        </div>
        <div class='box box2'>
        <i class='uil uil-files-landscapes'></i>
        <span class='text'>ASSIGNED</span>
        <span class='number'>$totalAssigned</span>
        </div>
        <div class='box box1'>
        <i class='uil uil-files-landscapes'></i>
        <span class='text'>SOLVED</span>
        <span class='number'>$totalSolved</span>
        </div>
        <div class='box box4'>
        <i class='uil uil-files-landscapes'></i>
        <span class='text'>UNASSAIGNED</span>
        <span class='number'> $totalPending</span>
        </div>
        </div>
        </div>
        ";
    } 
    ?>


    <div class="cssAnimsDemo">
      <div class="tabWrap">


        <!-- Links for Desktop -->
        <input id="tabLink4" type="radio" name="tabs" checked >
        <label for="tabLink4" class="desktopTabLink" style="width: 32%;">Assign Ticket</label>

        <input id="tabLink5" type="radio" name="tabs">
        <label for="tabLink5" class="desktopTabLink" style="width: 32%;">Transfer Ticket</label>

        <input id="tabLink6" type="radio" name="tabs">
        <label for="tabLink6" class="desktopTabLink" style="width: 32%;">Raise Ticket</label>


        <!-- Links for Mobile -->
        <input id="tabLinkMobile4" type="radio" name="tabs" checked>
        <label for="tabLinkMobile4" class="mobileAccordionLink">Assign Ticket</label>

        <!-- Content -->
        <article class="tabContent" id="tabContent4">

           <?php


           $query = "SELECT c.ComplaintId, c.Description, c.Department, c.Location, c.Timestart  FROM complaints AS c WHERE Expert_assigned = '' ORDER BY `ComplaintId` desc";

           $result = mysqli_query($conn, $query);
           $complaints = [];
           while ($row = mysqli_fetch_assoc($result)) {
            $complaints[] = $row;
        }
        ?>
        <!-- <div id='adminDashTable'> -->
            <div id="ticketassign">
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <tr style=" border:1px solid #8b8c8b; border-collapse:collapse;">
                        <th>Ticket Id</th>
                        <th>Description</th>
                        <th>Department</th>
                        <th>Location</th>
                        <th>Raised On</th>
                        <th>Available Officers</th>
                    </tr>
                    <?php foreach ($complaints as $complaint) : ?>
                        <tr>
                            <tr class="clickable-row" data-description="<?php echo $data['Description'] ?? ''; ?>">
                                <td><?php echo $complaint['ComplaintId']; ?></td>
                                <td><?php echo $complaint['Description']; ?></td>
                                <td><?php echo $complaint['Department']; ?></td>
                                <td><?php echo $complaint['Location']; ?></td>
                                <td><?php echo convertToRelativeTime($complaint['Timestart']); ?></td>
                                <td>
                                    <?php 
                                    $query ="SELECT UserId,Name FROM users WHERE UserType = 'IT Support' AND status != 'deleted'";
                                    $result = $conn->query($query);
                                    if($result->num_rows> 0){
                                        $officers= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    }
                                    ?>                  
                                    <form class="assignT" name="assignT" >
                                        <input type="text" style="display: none;" class="issue" name="issue" value=<?php echo $complaint['ComplaintId']; ?>>
                                        <input type="text" style="display: none;" class="userid" name="userid" value=<?php echo $uid; ?>>
                                        <select class = "expert" name ="expert" style=" padding: 5px 10px; border: none; background-color: #333; color: #fff; cursor: pointer;" required>
                                            <option value="" disabled selected>Select Officer</option>
                                            <?php foreach ($officers as $officer) {  
                                                ?>
                                                <option  value= "<?php echo $officer['UserId']; ?>"><?php echo $officer['Name']; ?> </option>
                                            <?php  } ?>
                                        </select>
                                        <button  style=" padding: 5px 10px; margin-left: 20px; border: none; background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Assign</button>

                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div> 





        </article>
        <!-- Links for Mobile -->
        <input id="tabLink5" type="radio" name="tabs">
        <label for="tabLink5" class="mobileAccordionLink">Transfer Ticket</label>

        <!-- Content -->
        <article class="tabContent" id="tabContent5">
            <?php


            $query = "SELECT ComplaintId, Description, Department, Location, Timestart, Expert_assigned, complaints.Expert_assigned,users.Name FROM complaints LEFT JOIN users ON users.userID= complaints.Expert_assigned WHERE Expert_assigned != '' AND complaints.status = 1 ORDER BY `ComplaintId` desc";

            $result = mysqli_query($conn, $query);
            $complaints = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $complaints[] = $row;
            }

            ?>
            <!-- <div id='adminDashTable'> -->
                <div id="tickettransfer">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                        <tr style=" border:1px solid #8b8c8b; border-collapse:collapse;">
                            <th>Ticket Id</th>
                            <th>Description</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Raised On</th>
                            <th>Expert Assigned</th>
                            <th>Available Officers</th>
                        </tr>
                        <?php foreach ($complaints as $complaint) : ?>
                            <tr>
                                <tr class="clickable-row" data-description="<?php echo $data['Description'] ?? ''; ?>">
                                    <td><?php echo $complaint['ComplaintId']; ?></td>
                                    <td><?php echo $complaint['Description']; ?></td>
                                    <td><?php echo $complaint['Department']; ?></td>
                                    <td><?php echo $complaint['Location']; ?></td>
                                    <td><?php echo convertToRelativeTime($complaint['Timestart']); ?></td>
                                    <td><?php echo $complaint['Name']; ?></td>
                                    <td>
                                        <?php 
                                        $query ="SELECT UserId,Name FROM users WHERE UserType = 'IT Support' AND status != 'deleted'";
                                        $result = $conn->query($query);
                                        if($result->num_rows> 0){
                                            $officers= mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        }
                                        ?>                     

                                        <form class="transferT" name="transferT"  >
                                            <input type="text" style="display: none;" class="issue" name="issue" value=<?php echo $complaint['ComplaintId']; ?>>
                                            <input type="text" style="display: none;" class="userid" name="userid" value=<?php echo $uid; ?>>
                                            <select class = "expert" name ="expert" style=" padding: 5px 10px; border: none; background-color: #333; color: #fff; cursor: pointer;" required>
                                                <option value="" disabled selected>Select Officer</option>
                                                <?php foreach ($officers as $officer) {  
                                                    ?>
                                                    <option  value= "<?php echo $officer['UserId']; ?>"><?php echo $officer['Name']; ?> </option>
                                                <?php  } ?>
                                            </select>
                                            <button  style=" padding: 5px 10px; border: none; margin-left: 20px; background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Transfer</button>
                                        </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

            

            </article>


            <!-- Links for Mobile -->
            <input id="tabLinkMobile6" type="radio" name="tabs">
            <label for="tabLinkMobile6" class="mobileAccordionLink">Raise Ticket</label>
            <?php
            require ('../commons/ticketraise.php');
            ?>
        </div>
    </div>
</div>
</li>
<li id="D3">
    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Reports</span>
            </div>

            
        </div>
    </div>
</li>

</ul>


</section>
<?php
require ('../commons/footer.php');
?>
?>