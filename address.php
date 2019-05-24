<?php
include 'dbconnect.php';

if(isset($_POST['submit'])){
  $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
  $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
  $number = mysqli_real_escape_string($conn,$_POST['contact']);

$query = "INSERT INTO addressbook(firstname,lastname,contact) VALUES('$firstname','$lastname','$number')";

if(mysqli_query($conn,$query)){
  header('Location:address.php');

}
else {
  echo "Error".mysqli_error($conn);
}
}

//get all contact list
//query
$query = 'select *from addressbook';
//get result
$result = mysqli_query($conn,$query);
//get allpost in array
$contacts = mysqli_fetch_all($result,MYSQLI_ASSOC);

//delete the contact details here
if(isset($_POST['delete'])){
  $id = $_POST['id'];
  $query = "delete from addressbook where id=$id";

  if(mysqli_query($conn,$query)){
    echo "<script>window.alert('Deleted!');</script>";
    header('Location:address.php');

  }
  else {
    echo "<script>window.alert('Failed To Delete!');</script>";
  }
}

 ?>
<html>
  <head>
    <script src="js/jquery-1.11.2.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <title>My Address book</title>
  </head>
  <body>
    <div class="container text-center col-lg-6 offset-lg-3">
      <h2>My Address Book</h2>
      <div class="row">
        <div class="col-lg-12 text-center offset-lg-3">
          <h3>Add a new Address List</h3>
          <form id="new-contact" method="post">
            <div class="form-group">
              <label for="new-first-name">Enter First name</label>
              <input type="text" name="firstname" class="form-control" id="new-first-name">
            </div>
            <div class="form-group">
              <label for="new-last-name">Enter Last name</label>
              <input type="text" name="lastname" class="form-control" id="new-last-name">
            </div>
            <div class="form-group">
              <label for="new-address">Enter Contact</label>
              <input type="text" name="contact" class="form-control" id="new-address">
            </div>

            <input type="submit" name="submit" class="btn btn-primary">
          </form>

          <h2>My Contacts:</h2>
          <ul class="list-group" id="contacts">
          </ul>
          <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3 text-center">
            <div>
                <table class="table table-hovered">
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Contact</th>
                    <th>Action</th>
                  </tr>
              <?php
                foreach ($contacts as $contact) {
                  ?>
                    <tr>
                      <td><?php echo $contact['firstname']; ?></td>
                      <td><?php echo $contact['lastname']; ?></td>
                      <td><?php echo $contact['contact']; ?></td>
                      <td><form method="post"><input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                      <input type="submit" name="delete" value="Delete" class="btn btn-danger"></form></td>
                    </tr>
                  <?php
                }
               ?>
             </table>
            </div>
          </div>

        </div>
      </div>
      <footer><p>My Address Book made with Javascript</p></footer>
    </div>
  </body>
</html>
