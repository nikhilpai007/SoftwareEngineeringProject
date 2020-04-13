<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

  <div class="row">
  <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($firstName_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group first-name">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">First Name</p>
      <input type="text" name="first_name" class="form-control" value="<?php echo $firstName; ?>">
    </div>
    <span class="help-block"><?php echo $firstName_err; ?></span>
  </div>
</div>



  <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($lastName_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group last-name">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Last Name</p>
      <input type="text" name="last_name" class="form-control" value="<?php echo $lastName; ?>">
    </div>
    <span class="help-block"><?php echo $lastName_err; ?></span>
  </div>
</div>
</div>
<br>
<br>


<div class="row">
<div id="student" class="col-6">

  <div class="form group <?php echo (!empty($studentNum_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group studentNum">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Student Number</p>
      <input type="text" name="studentNum" class="form-control" value="<?php echo $studentNum; ?>">
    </div>
    <span class="help-block"><?php echo $studentNum_err; ?></span>
  </div>
</div>


  <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group email">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Email</p>
      <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
    </div>
    <span class="help-block"><?php echo $email_err; ?></span>
  </div>
</div>
</div>
  <br>
  <br>



  <div class="row">
    <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group street">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Street</p>
      <input type="text" name="street" class="form-control" value="<?php echo $street; ?>">
    </div>
    <span class="help-block"><?php echo $street_err; ?></span>
  </div>
  </div>


  <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group city">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">City</p>
      <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
    </div>
    <span class="help-block"><?php echo $city_err; ?></span>
  </div>
  </div>
</div>
  <br>
  <br>




  <div class="row">
    <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group province">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Province</p>
      <input type="text" name="province" class="form-control" value="<?php echo $email; ?>">
    </div>
    <span class="help-block"><?php echo $province_err; ?></span>
  </div>
  </div>
  <br>
  <br>

  <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($pcode_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group pcode">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Postal Code</p>
      <input type="text" name="pcode" class="form-control" value="<?php echo $pcode; ?>">
    </div>
    <span class="help-block"><?php echo $pcode_err; ?></span>
  </div>
  </div>
</div>
  <br>
  <br>


<div class="row">
<div id="student" class="col-6">
  <div class="form group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group phone">
      <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Phone</p>
      <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
    </div>
    <span class="help-block"><?php echo $phone_err; ?></span>
  </div>
  </div>


  <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($major_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group major">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Student Major</p>
      <input type="text" name="major" class="form-control" value="<?php echo $major; ?>">
    </div>
    <span class="help-block"><?php echo $major_err; ?></span>
  </div>
 </div>
</div>
  <br>
  <br>

  <div class="form group <?php echo (!empty($notes_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group notes">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Notes</p>
      <textarea rows="4" cols="50" name="notes" class="form-control">
      <?php echo $notes; ?>  </textarea>
    </div>
    <span class="help-block"><?php echo $notes_err; ?></span>
  </div>

  <br>
  <br>


  <div class="form group <?php echo (!empty($leftTrent_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group leftTrent">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Has student graduated?</p>
      <select name = "leftTrent">
        <option <?php if($leftTrent == '1') echo "selected";?> value = 'yes'>Yes</option>
        <option <?php if($leftTrent == '0') echo "selected";?> value = 'no'>No</option>
      </select>
    </div>
    <span class="help-block"><?php echo $leftTrent_err; ?></span>
  </div>
  <br>
  <br>



  <div class="form group <?php echo (!empty($credAchieved_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group credAchieved">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Has student achieved 10 credits?</p>
      <select name = "credAchieved">
        <option <?php if($credAchieved == '1') echo "selected";?> value = 'yes'>Yes</option>
        <option <?php if($credAchieved == '0') echo "selected";?> value = 'no'>No</option>
      </select>
    </div>
    <span class="help-block"><?php echo $credAchieved_err; ?></span>
  </div>
  <br>
  <br>



  <div class="form group <?php echo (!empty($cummuAchieved_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group cummuAchieved">
  <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Has student achieved 80%?</p>
      <select name = "cummuAchieved">
        <option <?php if($cummuAchieved == '1') echo "selected";?> value = 'yes'>Yes</option>
        <option <?php if($cummuAchieved == '0') echo "selected";?> value = 'no'>No</option>
      </select>
    </div>
    <span class="help-block"><?php echo $cummuAchieved_err; ?></span>
  </div>
  <br>
  <br>


  <div class="form group <?php echo (!empty($exempt_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group exempt">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Is student exempt from above?</p>
      <select name = "exempt">
        <option <?php if($exempt == '1') echo "selected";?> value = 'yes'>Yes</option>
        <option <?php if($exempt == '0') echo "selected";?> value = 'no'>No</option>
      </select>
    </div>
    <span class="help-block"><?php echo $exempt_err; ?></span>
  </div>
  <br>
  <br>




<div class="row">
<div id="student" class="col-6">
  <div class="form group <?php echo (!empty($altAddress_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group altAddress">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Alternative Address</p>
      <input type="text" name="altAddress" class="form-control" value="<?php echo $altAddress; ?>">
    </div>
    <span class="help-block"><?php echo $altAddress_err; ?></span>
  </div>
  </div>


  <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($altEmail_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group altEmail">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Alternative Email</p>
      <input type="text" name="altEmail" class="form-control" value="<?php echo $altEmail; ?>">
    </div>
    <span class="help-block"><?php echo $altEmail_err; ?></span>
  </div>
  </div>
</div>
  <br>
  <br>



<div class="row">
<div id="student" class="col-6">
  <div class="form group <?php echo (!empty($altPhone_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group altPhone">
  <h3 style="color:red; display:inline">*</h3>     <p style="display:inline">Alternate phone</p>
      <input type="text" name="altPhone" class="form-control" value="<?php echo $altPhone; ?>">
    </div>
    <span class="help-block"><?php echo $altPhone_err; ?></span>
  </div>
  </div>
  <br>
  <br>

  <div id="student" class="col-6">
  <div class="form group <?php echo (!empty($yearCreated_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group yearCreated">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Year Created</p>
      <input type="text" name="yearCreated" class="form-control" value="<?php echo $yearCreated; ?>">
    </div>
    <span class="help-block"><?php echo $yearCreated_err; ?></span>
  </div>
  </div>
</div>
  <br>
  <br>



  <div class="form group <?php echo (!empty($foreignStatus_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group foreignStatus">
  <h3 style="color:red; display:inline">*</h3>     <p style="display:inline">Is a foreign student:</p>
      <select name = "foreignStatus">
        <option <?php if($foreignStatus == 'yes') echo "selected";?> value = 'yes'>Yes</option>
        <option <?php if($foreignStatus == 'no') echo "selected";?> value = 'no'>No</option>
      </select>
    </div>
    <span class="help-block"><?php echo $foreignStatus_err; ?></span>
  </div>
  <br>
  <br>


  <div class="form group <?php echo (!empty($showAsFellow_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group showAsFellow">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Show as fellow?</p>
      <select name = "showAsFellow">
        <option <?php if($showAsFellow == '1') echo "selected";?> value = '1'>Yes</option>
        <option <?php if($showAsFellow == '0') echo "selected";?> value = '0'>No</option>
      </select>
    </div>
    <span class="help-block"><?php echo $showAsFellow_err; ?></span>
  </div>
  <br>
  <br>


  <div class="form group <?php echo (!empty($institutionID_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group institutionID">
    <h3 style="color:red; display:inline">*</h3>   <p style="display:inline">Institution ID</p>
      <input type="text" name="institutionID" class="form-control" value="<?php echo $institutionID; ?>">
    </div>
    <span class="help-block"><?php echo $institutionID_err; ?></span>
  </div>
  <br>
  <br>



  <div class="form group <?php echo (!empty($fellowType_err)) ? 'has-error' : ''; ?>">
    <span class "label inbox-info"></span>
    <div class = "group fellowType">
    <h3 style="color:red; display:inline">*</h3> <p style="display:inline">Fellow type</p>
      <input type="text" name="fellowType" class="form-control" value="<?php echo $fellowType; ?>">
    </div>
    <span class="help-block"><?php echo $fellowType_err; ?></span>
  </div>
  <br>
  <br>
