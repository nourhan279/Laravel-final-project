
<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  
}
html{
   
  scroll-behavior: smooth;
}

body {
  margin: 0;
  padding-top: 60px;
}
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color:hsla(348, 29%, 93%, 1);
  padding: 15px 30px;
  position: fixed;
  top: 0;
  width: 100%;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
 
}

.navbar-left {
  font-weight: bold;
  font-size: 1.2rem;
}

.navbar-right {
  list-style: none;
  display: flex;
  gap: 20px;
}

.navbar-right li a {
  text-decoration: none;
  color: black;
  transition: 0.3s ease;
  padding: 6px 10px;
  border-radius: 4px;
}

.navbar-right li a:hover {
  color: hsla(347, 64%, 20%, 1);
}

.btn.register {
  background-color: hsla(347, 64%, 20%, 1);
  color: white;
  border: none;
  padding-bottom: 12px;
}

.btn.register:hover {
  background-color: white;
  color: hsla(347, 64%, 20%, 1);
  border: 1px solid hsla(347, 64%, 20%, 1);
}

    </style>

<nav class="navbar">
  <div class="navbar-left" style="color: hsla(347, 64%, 20%, 1); font-weight: bold; font-size: 21px;">موقع التسجيل</div>
  <ul class="navbar-right">
    <li><a class="active" href="#" >الصفحة الرئيسية</a></li>
    <li><a class="active" href="{{ url('/') }}">تغيير اللغة</a></li>
    <li><a class="btn register" href="#about-us">معلومات عنا</a></li>
     
  </ul>
</nav>


