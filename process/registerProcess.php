<?php 
    //Untuk ngecek tombol yang namenya 'register' sudah dipencet atau belum 
    // $_POST itu method diformnya

    if(isset($_POST['register'])){

        //Untuk mengoneksikan dengan database dengan memeangill file db.php
        include('../db.php');

        //Untuk menampung nilai yang ada diform kevariabel
        //Menyesuaikan variabel name yang ada diregister.php disetiap input
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $phonenum = $_POST['phonenum'];
        $membership = $_POST['membership'];
        $cekEmail = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'")
or die(mysqli_error($con));
        //Melakukan insert ke database dengan query dibawah ini
        if(mysqli_num_rows($cekEmail) == 0){
            $query = mysqli_query($con,
            "INSERT INTO users(email,password,name,phonenum,membership)
                VALUES
                    ('$email', '$password', '$name', '$phonenum', '$membership')")
                        or die(mysqli_error($con)); 

            if($query){
                echo
                    '<script>
                    alert("Register Success");
                    window.location = "../index.php"
                    </script>';
            }else{
                echo
                    '<script>
                    alert("Register Failed");
                    </script>';
            }
        }else{
            echo
            '<script>
                alert("Email is already Taken!, Failed to Register!");
                window.location = "../page/registerPage.php";
            </script>';
        }
    }else{
        echo
        '<script>
        window.history.back()
        </script>';
    }
?>