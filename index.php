<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
      
    a:link, a:visited {
    background-color: #2691d9;
    border-radius: 25px;
    color: white;
    padding: 14px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    }

    a:hover, a:active {
    background-color: skyblue;
    }
    
 .h3{

    font-family:"lucida console","Courier New",monospace;
    position: sticky;
  left: 0;
  bottom: 0;
  width: 40%;
  margin-top: auto;
  margin-left: auto;
  background: none;
  border-radius: 10px;
  box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.05);
 }
       
 .fcontent{

    font-family:"lucida console","Courier New",monospace;



 }
 
 
 
 
 .p{

      text-indent:50px;
      font-family:"lucida console","Courier New",monospace;

        }
      
      .login_reg_hide{
        border : 1px solid blue;
        border-radius :2px;
        color:blue;
      }
     
     .p{

     text-size-adjust: 12px;

     }
      .body{

padding: 100px;;

      }
     .regbtn{

     background-color: forestgreen;
     border: none;
     color: white;
     padding: 15px 32px ;
    text-align: center;
   text-decoration: none;
   display: inline-block;
  font-size:16px;


}

input[type="submit"] {
  width: 100%;
  height: 35px;
  border: 1px solid;
  background: #2691d9;
  border-radius: 25px;
  font-size: 18px;
  color: #e9f4fb;
  font-weight: 700;
  cursor: pointer;
  outline: none;
}
.submit{
   
    background-color: blue;
     border: none;
     color: white;
     padding: 15px 32px ;
    text-align: center;
   text-decoration: none;
   display: inline-block;
  font-size:16px;

}
.form-control{

    padding: 0 50px;
  box-sizing: border-box;
}

    </style>

    <title>Document</title>
</head>
<body>
    <section>
       
        <div class="container">
            <div class="landing">
                <div id="login-area">
                  
                    
                </div>

                <div class="login_reg_hide">
             
                <h3 class="h3">WELCOME</h3>
                    <form action="registration.php" method="post">
                        <label class="h3" for="FName">FIRST NAME :</label>
                        <input class="h3"type="text" name="fname" id="fname" placeholder="ENTER YOUR FIRST NAME"><br>
                        <br>
                        <label  class="h3" for="LName">LAST NAME :</label>
                        <input class="h3" type="text" name="lname" id="lname" placeholder="ENTER YOUR LAST NAME"><br>
                        <br>
                        <label class="h3" for="email">EMAIL     <span> </span>  :</label>
                        <input type="email" name="email" id="email1" placeholder="ENTER YOUR EMAIL ADDRESS"><br>
                        <br>
                        <label class="h3" for="password">PASSWORD : </label>
                        <input class="h3" type="password" name="password" id="password1" placeholder="ENTER YOUR PASSWORD"><br>
                        <br>
                        <br>
                        <br>
                        <input class="submit" type="submit" value="APPLY"><br>

                    </form>

                </div>

                <div class="form-control">
                    <br>
                    <br>
                    <h3 class="h3">WELCOME BACK</h3>
                    <form class="loginpage" action="login.php" method="post">
                       <br> 
                       <label class="h3" for="email">EMAIL :</label>
                        <input type="email" name="email" id="email" placeholder="ENTER YOUR EMAIL ADDRESS">
                        
                        <br>
                        <br>
                        
                        <label class="h3" for="password">PASSWORD :</label>

                        <input type="password" name="password" id="password" placeholder="ENTER YOUR PASSWORD">
                     <br>
                     <br>
                    <div class="logcondition">
                        
                        <div class="forgt">
                            <a href="#">Forget password?</a>
                        </div>
                   
                     <br>
                     <br>
                    </div>
                    <br>
                    <br>
                        <input class="submit" type="submit" id="submit" value="LOG IN">
                    </form>

                </div>

            </div>
        </div>

    </section>
    <footer>
        <div class="footercontent">
            <div class="fcontent">
                <img src="logo2.png" alt="">
            </div>
            <div class="fcontent">
                <h4>About CC</h4>
                <ul>
                    <li><a href="#">Teacher</a></li>
                    <li><a href="#">Student</a></li>
                    <li><a href="#">Course Credit </a></li>
                    <li><a href="#">Add Credit </a></li>
                </ul>
            </div>
            <div class="fcontent">
                <h4>About Course Registration System </h4>
                </div>
            <div class="fcontent">
                <h4>About CC</h4>
                <ul>
                    <li><a target="blank" href="#">Credit System</a></li>
                    <li><a target="blank" href="#">School Information</a></li>
                    
                </ul>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <p>Copyright © 2023 xyz Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>
 <script>
        const validation=getElementbyid("h3");
        if(validation == "")
        {
            console.log("error");
        }    
        else {
           console.log("ok")
        
        }
</script>

</body>
</html>