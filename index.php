<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Form</title>

    <style>
        .form-div {
            width: 500px;
            margin: 0 auto;
        }
    </style>
  </head>
  <body>
      <?php 
        /**
         * For Show validation message
         *
         * @param string $message
         * @param string $alertType
         */
        function validate($message, $alertType="danger") {
            return "<div class=\"alert alert-{$alertType} alert-dismissible fade show\" role=\"alert\">
                {$message}!
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>";
        }

        
        function validateEmail($email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        }

        
        function filterEduMail($email, $validEmails) {
            $email_arr = explode('@', $email, 2);
            if (in_array($email_arr[1], $validEmails)) {
                return true;
            } else {
                return false;
            }
        }

        function oldValue($fieldName) {

            if (isset($_POST[$fieldName])) {
                echo $_POST[$fieldName];
            } else {
                echo '';
            }
        }

    

        if (isset($_POST['submitBtn'])) {
            $username  = $_POST['username'];
            $userEmail = $_POST['userEmail'];
            $phone     = $_POST['phone'];
           

            if (empty($username) || empty($userEmail) || empty($phone)) {

                $validationMsg = validate('All fields are required');

            } else if (validateEmail($userEmail) == false) {

                $validationMsg = validate('Email is not valid', 'warning');

            } else if (filterEduMail($userEmail, ['diu.edu.bd', 'brac.edu.bd', 'nsu.edu.bd']) == false) {

                $validationMsg = validate('Email is not Edu mail', 'warning');

            } 
            
        }
        
        
      ?>
      <div class="container">
          <div class="wrap shadow form-div">
              <div class="card">
                    <div class="card-body">
                        <h1>Registration Form</h1>

                        <?php 
                            if (isset($validationMsg)) {
                              echo $validationMsg;
                            }
                        ?>
                    

                        <form method="POST" action="" autocomplete="on">
                            <div class="form-group">
                                <label for="fieldthree" class="form-label">Username</label>
                                <input type="text" name="username" value="<?php oldValue('username');?>" class="form-control" id="fieldthree">
                            </div>
                            <div class="form-group">
                                <label for="fieldOne" class="form-label">Email address</label>
                                <input type="text" name="userEmail" value="<?php oldValue('userEmail');?>" class="form-control" id="fieldOne">
                            </div>
                            <div class="form-group">
                                <label for="fieldFour" class="form-label">Phone</label>
                                <input type="tel" name="phone" value="<?php oldValue('phone');?>" class="form-control" id="fieldFour">
                            </div>
                                                

                            <div class="form-group">
                                <input type="submit" name="submitBtn" class="btn btn-primary" value="Register">
                            </div>
                        </form>
                    </div>
              </div>
          </div>

      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>