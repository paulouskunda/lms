<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $getuserprofile = "SELECT * FROM `users` WHERE `userID` = '" . $_POST["id"] . "'";
    $result = mysqli_query($database, $getuserprofile);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $getrole = "SELECT `roleID`,`role_title` FROM `roles`";
    $results = mysqli_query($database, $getrole);
    $number_fetch_row = mysqli_num_rows($results);
}


echo '

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"></div>
                        <div class="card-body">
                            <div class="forms-sample">
                                <div class="form-group">
                                    <label for="username">UserID</label>
                                    <input type="text" class="form-control" id="edituserid"
                                     placeholder="User ID" pattern="[A-Za-z]+" value=' . $row["userID"] . ' disabled>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="editusername"
                                     placeholder="Username" pattern="[A-Za-z]+" value=' . $row["username"] . ' disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nrc">NRC <small style="color:blue;"> Format
                                    ------/--/-</small></label>
                                    <input type="text" class="form-control" id="editnrc"
                                     placeholder="NRC" pattern="(([0-9]{6})+/([0-9]{2})+/\d)"
                                     title="Format ------/--/-"
                                     value=' . $row["identification_number"] . ' required>
                                </div>
                                <div class="form-group">
                                    <label for="firstname">First name <small
                                    style="color:blue;"> First name cannot contain
                                    number</small></label>
                                    <input type="text" class="form-control" id="editfirstname"
                                    title="First name cannot contain number"
                                    placeholder="First name" pattern="[A-Za-z]+" value=' . $row["firstname"] . ' required>
                                </div>
                                <div class="form-group">
                                    <label for="othername">Other name <small
                                    style="color:blue;"> Other name cannot contain
                                    number</small></label>
                                    <input type="text" class="form-control" id="editothername"
                                    title="Other name cannot contain number" value="' . $row["othername"] . '" placeholder="Other name" pattern="[A-Za-z]+">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last name <small style="color:blue;">
                                    Last name cannot contain number</small></label>
                                    <input type="text" class="form-control" id="editlastname"
                                    title="Last name cannot contain number"
                                    placeholder="Last name" pattern="[A-Za-z]+" value=' . $row["lastname"] . ' required>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"></div>
                            <div class="card-body">
                                <div class="forms-sample">
                                    <div class="form-group">
                                        <label for="contact">Contact <small style="color:blue;"> Use
                                        correct format 09-- ------</small></label>
                                        <input type="text" class="form-control" id="editcontact"
                                        placeholder="Contact"
                                        pattern="(([0-9]{2})+(\d)+([0-9]{7}))" value=' . $row["contact"] . ' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address <small style="color:blue;">
                                        Email should contain @ and .</small></label>
                                        <input type="email" class="form-control" id="editemail"
                                        pattern="[a-zA-Z0-9!#$%&amp;"*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*" 
                                        value=' . $row["email"] . ' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">Select City <small style="color:blue;">
                                        Please select an option</small></label>
                                        <select name="editcity" id="editcity" class="form-control"
                                        required>
                                            <option value=""></option>
                                            <option value="Kabwe">Kabwe</option>
                                            <option value="Kitwe">Kitwe</option>
                                            <option value="LivingStone">LivingStone</option>
                                            <option value="Lusaka">Lusaka</option>
                                            <option value="Ndola">Ndola</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Residential Address <small
                                        style="color:blue;"> Please provide residential
                                        address</small></label>
                                        <input type="text" class="form-control" id="editaddress"
                                        placeholder="Residential Address"
                                        title="Please provide residential" value=' . $row["residentialAddress"] . ' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Select Role <small style="color:blue;">
                                        First name cannot contain number</small></label>
                                        <select name="editrole" id="editrole" class="form-control"
                                        required>
                                        <option value=""></option>';
                                            if ($number_fetch_row > 0) {
                                                while ($row2 = mysqli_fetch_array($results)) {
                                                    echo '<option value=' . $row2['roleID'] . '>' . $row2['role_title'] . '</option>';
                                                }
                                            }
                                                                
                                  echo '</select>
                                                                                
                                    </div>';
                                if($row['isActive'] == 1){
                                                                    
                              echo '<div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="editisactive_active" value="1" checked>
                                        <label class="form-check-label" for="isactive_active">Is Active</label>
                                    </div>';
                                }
                                                               
                                if($row['isActive'] == 0){
                              echo '<div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="editisactive_active" value="0">
                                        <label class="form-check-label" for="isactive_active">Is Active</label>
                                    </div>';
                                }
                                                                                    
                           echo '</div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>'    ;