<div class="container">
    <div class="card">
        <div class="card-header">
        <h2>Add New Student</h2>
        </div>
            <div class="card-body">
                <form name="frmRegister" enctype="multipart/form-data" action="studentadd.php" method="post">
                    Student ID:
                    <input name="id" type="text" value="" class="form-control mb-2" />                       
                    Password :
                    <input name="pwd" type="password" value="" class="form-control mb-2" />
                    Date of Birth:
                    <input name="dob" type="date" value="" class="form-control mb-2" />
                    First Name:
                    <input name="fname" type="text" value="" class="form-control mb-2" />
                    Surname:
                    <input name="lname" type="text"  value="" class="form-control mb-2" />
                    Number and Street:
                    <input name="house" type="text"  value="" class="form-control mb-2" />
                    Town:
                    <input name="town" type="text"  value="" class="form-control mb-2" />
                    County:
                    <input name="county" type="text"  value="" class="form-control mb-2" />
                    Country:
                    <input name="country" type="text"  value="" class="form-control mb-2" />
                    Postcode:
                    <input name="postcode" type="text"  value="" class="form-control mb-2" />
                    Profile Picture:
                    <input type="file" name="photo" accept="image/jpeg" class="form-control mb-2" /><br/>
                        <div class="card-footer">  
                            <input type="submit" value="Save" name="submit" class="btn btn-outline-primary mb-3 mt-3"/>
                        </div>
                </form>
            </div>
    </div>
</div><br>