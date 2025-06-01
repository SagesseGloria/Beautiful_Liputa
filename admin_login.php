<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Login</title>
    <style>


.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-top: 20px;
}
        form{
            position: relative;
            width: 300px;
            height: 150px;
            border-radius: 5px;
            justify-content: center; 
            align-items: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6);
        }
        form button{
            background-color: #444;
            color: white;
            padding: 10px;
            margin: 20px;
            margin-left: 45px;
            width: 50%;
            justify-content: center;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }
        header {
      background-color: #333;
      color: white;
      padding: 15px 20px;
      justify-content: space-between;
      align-items: center;
    }
header h1 {
      margin: 0;
      font-size: 22px;
      text-align: center;
    }
        .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        }
        .logo img {
    width: 150px;
}
    </style>
</head>
<body>
    <header>
    <div class="logo">
    <img src="/Beautiful Liputa/Images/Remove_LogoBL.png" alt="Beautiful Liputa Logo">
        </div>
        <h1>Manager Login</h1>
    </header>
    <div class="form-container">
        <form method="POST" action="process_admin.php" class ="form">
            <label>Email:</label>
            <input type="email" name="email" required><br><br>

            <label>Password:</label>
            <input type="password" name="password" required><br><br>

            <button type="submit">Login</button>
        </form>
</div>
</body>
</html>

