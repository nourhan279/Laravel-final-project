<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpeg') }}">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Select Language</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      background: linear-gradient(to bottom right, rgb(146, 44, 66), rgb(84, 15, 31));
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      color: white;
    }

    .container {
      text-align: center;
    }

    h1 {
      margin-bottom: 40px;
      font-size: 2em;
    }

    .lang-btn {
      background-color: white;
      color: #0c3c60;
      border: none;
      padding: 15px 30px;
      margin: 10px;
      border-radius: 10px;
      font-size: 1.2em;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .lang-btn:hover {
      background-color: #a9a5a5;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Please select your language</h1>
     <h1>من فضلك اختار اللغة الخاصة بك</h1> 
    <button class="lang-btn" onclick="window.location.href='/set-language/en'">English</button>
    <button class="lang-btn" onclick="window.location.href='/set-language/ar'">العربية</button>
  </div>
</body>
</html>
