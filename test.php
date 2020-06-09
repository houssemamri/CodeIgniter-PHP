<?php
session_start();
include('connection.php');
echo '<table id="mytable" class="table table-bordred table-striped">

     <thead>
       <th></th>
       <th>Email</th>
       <th>Edit</th>
       <th>Delete</th>
     </thead>
      <tbody>' .
          $sql="SELECT * FROM EmailList WHERE UID=" . $_SESSION['user_id'];
          $result=$conn->query($sql);
          if($result->num_rows==0)
          {
        . '
            <tr>
              <td>No Email Present</td>
            </tr> ' .
          }
          else
          {
            while($row=$result->fetch_assoc())
            {
              . '
              <tr>
                <td><input type="checkbox" class="emaillist" value="' . $row['EID'] . '" /></td>
                <td class="text-left">' . $row['Email'] . '</td>
                <td><p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changeEmail' . $row['EID'] . '"><span class="fa fa-pencil"></span></button></p></td>
                <td><p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" onclick="deleteEmail(\''. $row['EID'] . '\');"><span class="fa fa-trash-o"></span></button></p></td>
              </tr>' .
            }
          }
          . '
      </tbody>

  </table>' .
    $result=$conn->query($sql);
    while($row=$result->fetch_assoc())
    { . '
   <div class="modal fade" id="changeEmail' . $row['EID'] . '" tabindex="-1" role="dialog" aria-labelledby="changeEmail' . $row['EID'] . '" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Update Email</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <input type="text" hidden id="hiddenEid' . $row['EID'] . '" value="' . $row['EID'] . '" />
           <label for="email">Email Address: </label> <input type="text" name="updateMail" id="updateMail' . $row['EID'] . '" value="' . $row['EID'] . '"/>
           <br /><br />
           <button type="button" class="btn btn-primary" onclick="updateEmail(\'' . $row['EID'] . '\');">Update</button>
           <br /><br />
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
   </div>' .
  };
  ?>
