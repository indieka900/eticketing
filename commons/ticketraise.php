 <!-- Content -->

 <?php
//echo "User ID = $uid";
 ?>

            <article class="tabContent" id="tabContent6">
                <div class="activity">
                    <div class="activity-data" >
                        <div class="complaint" id="ticket">
                            <form class="complaintS" name="complaintS" onsubmit="return submitResult();">
                                 <!--<form class="complaintS" name="complaintS" onsubmit="return submitResult();"> -->
                                <center><h3>Fill in the user support form</h3></center>
                                <input type="text" style="display: none;" class="userid" name="userid" value=<?php echo $uid; ?>>
                                <select class = "location" name ="location" style=" padding: 5px 10px; border: none; background-color: #333; color: #fff; cursor: pointer; margin-bottom: 10px;" required>
                                    <option value="" disabled selected>Select Location</option>  
                                    <option value="Annex Ground Floor">Annex Ground Floor</option>
                                    <option value="Annex 1st Floor">Annex 1st Floor</option>
                                    <option value="Teleposta 7th Floor">Teleposta 7th Floor</option>
                                    <option value="Teleposta 8th Floor">Teleposta 8th Floor</option>
                                    <option value="Teleposta 9th Floor">Teleposta 9th Floor</option>
                                    <option value="Teleposta 10th Floor">Teleposta 10th Floor</option>
                                     <option value="Teleposta 11th Floor">Teleposta 11th Floor</option>
                                    <option value="Other">Other</option>
                                </select>
                                <select class = "department" name ="department" style=" padding: 5px 10px; border: none; background-color: #333; color: #fff; cursor: pointer; margin-bottom: 10px; margin-left: 10px;" required>
                                    <option value="" disabled selected>Select Department</option>  
                                    <option value="Planning">Planning</option>
                                    <option value="Human Resource">Human Resource</option>
                                    <option value="Security">Security</option>
                                    <option value="Infrastructure">Infrastructure</option>
                                    <option value="Systems">Systems</option>
                                </select>
                                <select class = "problemDescription" name ="problemDescription" id ="probSel"style=" padding: 5px 10px; border: none; background-color: #333; color: #fff; cursor: pointer; margin-bottom: 10px;" required onchange = "showDescr()">
                                    <option value="" disabled selected>Select Problem</option>
                                    <option value="Can not connect to WIFI">Can not connect to WIFI</option>
                                    <option value="Can not print">Can not print</option>
                                      
                                    <option value="Computer bluescreen">Computer bluescreen</option>
                                    <option value="Computer can not login">Computer can not login</option>
                                    <option value="Computer can not start">Computer can not start</option>
                                    
                                    <option value="Computer is slow">Computer is slow</option>
                                    <option value="Computer unresponsive">Computer unresponsive</option>
                                    <option value="Mobile Phone issues">Mobile Phone issues</option>
                                    <option value="No Internet connection">No Internet connection</option>
                                    <option value="Online conferencing issues">Online conferencing issues</option>
                                    
                                    <option value="Software request">Software request</option>
                                    
                                    <option value="Other - Describe">Other - Describe</option>
                                </select>
                                <textarea style="display:none;" name="problemDetail" id="descr" cols="30" rows="10" placeholder="PROBLEM DESCRIPTION"></textarea>
                                
                                <div class="myDeadline" >
                                    <label for="deadline" style="cursor: none; border: none; ">Deadline</label>
                                    <input type="datetime-local" name="deadline" placeholder="Deadline" required>
                                </div>
                                <label for="rangen" style="border: none;">Priority</label>
                                <div style="display: inline-flex; margin: auto; ">

                                    <label for="rangen" style="border: none;">0 (Trivial)</label>
                                    <input type="range" name="priority" id="rangen" placeholder="" max="10" min="0" required>
                                    <label for="rangen" style="border: none;">10 (Urgent)</label>
                                </div>
                                <center>
                                    <button type="submit" name="submit">Submit</button>
                                </center>
                            </form>

                        </div>

                        

                    </div>
                </div>
            </article>
            