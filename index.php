<?php 
    include("Includes/header.php"); 
    include("mymailer.php");

    if (isset($_POST['submit'])){
        $email    = $_POST['email'];
        $name     = $_POST['name'];

        // SendEmail
        $mailer = new MyMailer();
        $response = $mailer->send($email,$name);

        if ($response->message === "success")
        {
            header ("Location: index.php");
        }
        else
        {
            echo "Failed";
        }
    }
    
    
?>
<div id="main">
    <h2>以下のメールアドレスにメールを送信します</h2>
        <form action="index.php" method="post">
            <fieldset>
                <legend>以下のメールアドレスにメールを送信します</legend>
                <ol>
                    <li>
                        <label for="email">Email:</label>
                        <input type="text" name="email" value="" id="email" />
                    </li>
                    <li>
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="" id="name" />
                    </li>
                </ol>
                <input type="submit" name="submit" value="Submit" />
            </fieldset>
        </form>
     </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>