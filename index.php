<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center">Crud Operation PHP</h2>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New User
        </button>


        <!-- table -->
        <table class="table mt-5">
            <thead class="table-dark">
                <tr>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody style="border: 1px solid black;}">
                <?php

                require_once "dbcon.php";
                $sqlfetch="select * from user order by id";
                $fetchQuery=mysqli_query($conn,$sqlfetch);
                
                  
                   while($fetchUser=mysqli_fetch_assoc($fetchQuery)){
               ?>

                <tr>
                    <td><?php echo $fetchUser['name'];    ?></td>
                    <td><?php echo $fetchUser['email'];    ?></td>
                    <td><?php echo $fetchUser['phone'];    ?></td>
                    <td><button class="btn btn-success"
                            onclick="updateModal(<?php echo $fetchUser['id'];  ?>); ">Update</button></td>

                    <td><button class="deleteBtn btn btn-danger" data-value="<?php echo $fetchUser['id']; ?>"
                            href="">Delete</button></td>

                </tr>
                <?php    }     ?>
            </tbody>
        </table>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">

                        <input type="submit" class="form-control" id="submit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- update modal -->

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="updatename" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="updateemail" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="updatephone">
                    </div>
                    <div class="mb-3">

                        <input type="submit" class="form-control" onclick="updateDetaild();">

                    </div>

                </div>
                <div class="modal-footer">
                    <input id="updateModalId" name="userid" type="hidden" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $('#submit').on('click', function(e) {
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        if (name != '' && email != '' && phone != '') {

            $.ajax({
                type: "POST",
                url: "insert.php",
                data: {
                    name: name,
                    email: email,
                    phone: phone
                },
                success: function(data) {
                    if (data = 1) {
                        alert('User Add Successfully');
                        $('#name').val("");
                        $('#email').val("");
                        $('#phone').val("");
                        location.reload();
                    } else {
                        alert(data);
                    }
                }
            });

        } else {
            alert('Please Fill all the details');
        }
    })

    $('.deleteBtn').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data("value");
        //alert(id);
        $.ajax({
            type: "POST",
            url: "delete.php",
            data: {
                id: id
            },
            success: function(data) {
                if (data = 1) {
                    alert('Delete Successfully');
                    location.reload();
                } else {
                    alert(data);
                }
            }


        });
    })

    function updateModal(userid) {

        console.log(userid);
        $('#exampleModal1').modal("show");
        $('#updateModalId').val(userid);

        $.ajax({
            type: "POST",
            url: "update.php",
            data: {
                id: userid
            },
            success: function(data) {
                // alert(data);
                var userid = jQuery.parseJSON(data);
                $('#updatename').val(userid.name);
                $('#updateemail').val(userid.email);
                $('#updatephone').val(userid.phone);
            }
        })



    }

    function updateDetaild() {
        var name = $('#updatename').val();
        var email = $('#updateemail').val();
        var phone = $('#updatephone').val();
        var id = $('#updateModalId').val();

        $.ajax({
            type: "POST",
            url: "updatedetails.php",
            data: {
                name: name,
                email: email,
                phone: phone,
                id: id,
            },
            success: function(data) {
                // alert(data);
                if (data = 1) {
                    $('#exampleModal1').modal("hide");
                    alert('User Update Successfully');
                    $('#updatephone').val("");
                        $('#updatename').val("");
                        $('#updateemail').val("");
                       
                    location.reload();
                } else {
                    alert(data);
                }
            }
        })
    }
    </script>
</body>

</html>