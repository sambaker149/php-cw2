<?php echo $message; ?>

<img src='uploads/bnu-logo.webp' width='500' height='350' class='mx-auto d-block'>";

<h1 style="text-align:center">Please Log Into The Dashboard</h1>
<form name="frmLogin" action="authenticate.php" method="post" class="row justify-content-center">
   <div class="mb-3 col-sm-8">
      <label for="txtid" class="form-label text-dark mt-5"><h5>Student ID</h5></label>
      <input type="text" class="form-control" id="txtid" name="txtid"
      placeholder="Your ID Number">
   </div>
   <div class="mb-3 col-sm-8">
      <label for="txtpwd" class="form-label text-dark"><h5>Password</h5></label>
      <input type="password" class="form-control" id="txtpwd" name="txtpwd" 
      placeholder="Your Password">
   </div>
   <div class="mb-3 col-sm-8">
   <input type="submit" name="btnlogin" class="btn btn-outline-success" value="Login"></input>
</div>
</form>