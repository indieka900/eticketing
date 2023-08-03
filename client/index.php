<?php
require ('../commons/header.php');
?>
<title>CLIENT-IT Ticketing-</title> 
<div class="menu-items">
    <ul class="tabs">
        <li><a href="#D2" class="active">
            <i class="uil uil-estate"></i>
            <span style="color: #1d16e6; font-size: x-large; border: solid; border-color: black;" class="link-name">Raise Ticket</span>
        </a></li>
        <li><a href="#D0" >
            <i class="uil uil-files-landscapes"></i>
            <span class="link-name">Dashboard</span>
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
            
            <img src="" alt="">
        </div>

        <ul class="tabs-content"> 

            <li id="D0">

                <?php
////////////////////////// SELECT WHERE USERID IS CURRENT USER ///////////////////////////////////////////////////////// 
                $sqlQuery = "SELECT count(ComplaintId) as totalComplaints, 
                count(if(status=2,1,null)) AS totalSolved,
                count(if(status=0 || status=1 ,1,null)) AS totalPending
                FROM complaints where `UserId` ='$uid'";
                $result = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
                while( $data = mysqli_fetch_assoc($result) ) {
                    $totalComplaints= $data['totalComplaints'];
                    $totalSolved= $data['totalSolved'];
                    $totalPending= $data['totalPending'];

                    echo"       
                    
                    <div class='dash-content' >
                    <div class='overview'>
                    <div class='title'>
                    <i class='uil uil-tachometer-fast-alt'></i>
                    <span class='text'>$uname</span>
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
////////////////////////// SELECT WHERE USERID IS CURRENT USER ///////////////////////////////////////////////////////// 

                        $query = "SELECT ComplaintId, Description, complaints.Expert_assigned,users.Name, complaints.Status, Recipient_endtime FROM complaints LEFT JOIN users ON users.userID= complaints.Expert_assigned where complaints.UserId ='$uid' ORDER BY `ComplaintId` desc ";
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
                                    <th>Expert Assigned</th>
                                    <th>Status</th>
                                    <th>End Time</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($complaints as $complaint) : ?>
                                    <tr style="background:#fdfdfd" class="clickable-row" data-description="<?php echo $data['Description'] ?? ''; ?>">
                                        <td><?php echo $complaint['ComplaintId']; ?></td>
                                        <td><?php echo $complaint['Description']; ?></td>
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
                                            <form class="markSolve" name="markSolve" >
                                                <input type="text" style="display: none;" class="issue" name="issue" value=<?php echo $complaint['ComplaintId']; ?>>

                                                <button  style=" padding: 5px 10px; border: none;  background-color: #333; color: #fff; cursor: pointer;"  type="submit" name="submit">Mark as Solved</button>
                                            </form>


                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div> 
                </div>
            </div>
        </li>
        <li id="D2">


            <div class="dash-content">

             <?php
////////////////////////// SELECT WHERE DATE IS TODAY ///////////////////////////////////////////////////////// 
             $sqlQuery = "SELECT count(complaintid) as totalComplaints, 
             count(if(status=2,1,null)) AS totalSolved,
             count(if(status=1,1,null)) AS totalAssigned,
             count(if(status=0,1,null)) AS totalPending
             FROM complaints where UserID='$uid'";
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
                <span class='text'>My Tickets</span>
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
                <?php
            require ('../commons/ticketraise.php');
            ?>
                
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