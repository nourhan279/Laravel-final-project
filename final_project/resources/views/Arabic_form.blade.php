
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/favicon.jpeg') }}">
    <style>

        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        main {
            background-color: #F1FEFC;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            position: relative;
            display: flex;
            justify-content: center;
        }
        .form-container {
            margin-left: 503px;
            margin-top:30px;
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 23px 33px hsla(348, 29%, 93%, 1), 0 -10px 20px hsla(348, 29%, 93%, 1);
            width: 100%;
            max-width: 500px;
            /* position: relative; */
            flex: 1;
            left: 200px;
            align-items: center;
        }

        h2 {
            text-align: center;
            color: #444;
        }
        label {
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }
        input[type=text]:focus {
            border: 3px solid #555;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 4px;
            margin-bottom: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .error {
            color: red;
            font-size: 0.85em;
           /* margin-bottom: 5px;*/
        }
        select {
            width: 100%;
            padding: 13px 16px;
            border: none;
            border-radius: 3px;
            background-color: #f1f1f1;
        }
        button {
            background-color:hsla(347, 64%, 20%, 1);
            color: white;
            /*padding: 10px 20px;*/
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 13px;
            width: 100%;
            padding: 10px 20px;
        }
        button:hover {
            background-color: rgb(107, 103, 104);
        }
        .meter-section {
            margin-top: 1px;
        }
        .meter-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #444;
        }
        meter {
            width: 100%;
            height: 20px;
        }

        .required:after {
             content:" *";
             color: red;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
.input-button-group {
     display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    flex-direction: row-reverse;
  }
  #wpbutton {
  padding: 13px 12px;
  display: flex;
  justify-content: center;  /* center horizontally */
  align-items: center;
  margin-bottom: 20px;   /* center vertically */
   width:30%;
  white-space: nowrap; /* prevent text from wrapping */
}

  .error-message {
    color: red;
    font-size: 14px;
    margin-top: 2px;
     }

.is-invalid { border-color: red !important; }
 .text-danger { color: red; font-size: 0.85em; margin-top: 2px; margin-bottom: 5px; }
 input:not(.is-invalid) { border-color: #ccc; } 


    </style>
</head>
<body>

@include('includes.Arabic_header')
<div id ="main">
<div class="form-container">
<div id="alertBox" style="display: none;" class="alert"></div>
<h2 dir="rtl" style="text-align: center;" >موقع التسجيل</h2>
<form id="myForm" method="POST" enctype="multipart/form-data" action="DB_Ops.php" onsubmit="return validateForm()" >
 <input type="hidden" name="lang" value="ar"> <label dir="rtl" for="full_name">الاسم الكامل:</label>
            <input dir="rtl" type="text" id="full_name" name="full_name" placeholder="الاسم الكامل" value="{{ old('full_name') }}" class="@error('full_name') is-invalid @enderror">
            <div class="text-danger" id="full_name_error">@error('full_name'){{ $message }}@enderror</div>

    <label dir="rtl" for="user_name">اسم المستخدم:</label>
            <input dir="rtl" type="text" id="user_name" placeholder="اسم المستخدم" name="user_name" value="{{ old('user_name') }}" class="@error('user_name') is-invalid @enderror">
            <div class="text-danger" id="user_name_error">@error('user_name'){{ $message }}@enderror</div>

    <label dir="rtl" for="email">البريد الإلكتروني:</label>
            <input dir="rtl" type="email" id="email" placeholder="Example@domain.com" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
            <div class="text-danger" id="email_error">@error('email'){{ $message }}@enderror</div>

            <label dir="rtl" for="phone">الهاتف:</label>
            <input dir="rtl" type="text" id="phone" placeholder="رقم الهاتف" name="phone" value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror">
            <div class="text-danger" id="phone_error">@error('phone'){{ $message }}@enderror</div>



    <label dir="rtl" for="whatsapp">رقم تطبيق الواتس:</label>
            <div class="input-button-group">
                <input dir="rtl" type="text" id="whatsapp" placeholder="رقم تطبيق الواتس" name="whatsapp" value="{{ old('whatsapp') }}" class="@error('whatsapp') is-invalid @enderror">
                <button type="button" onclick="checkWhatsAppNumber()" id="wpbutton">التحقق من الصحة</button>
            </div>
            <div class="text-danger" id="whatsapp_error">@error('whatsapp'){{ $message }}@enderror</div>


    <label dir="rtl" for="country">العنوان:</label>
            <div style="display: flex; gap: 10px; flex-direction: row-reverse;">
                <input dir="rtl" type="text" id="city" name="city" placeholder="المدينة" style="flex: 1;" value="{{ old('city') }}" class="@error('city') is-invalid @enderror">
                <input dir="rtl" type="text" id="country" name="country" placeholder="الدولة" style="flex: 1;" value="{{ old('country') }}" class="@error('country') is-invalid @enderror">
            </div>
            <div class="text-danger" id="country_error">@error('country'){{ $message }}@enderror</div>
            <div class="text-danger" id="city_error">@error('city'){{ $message }}@enderror</div>

            <label dir="rtl" for="password">كلمة المرور:</label>
            <input dir="rtl" type="password" id="password" placeholder="8 أحرف أو أكثر (حرف خاص واحد على الأقل ورقم واحد)" name="password" class="@error('password') is-invalid @enderror">
            <div class="text-danger" id="password_error">@error('password'){{ $message }}@enderror</div>

            <label dir="rtl" for="confirm_password">تأكيد كلمة المرور:</label>
            <input dir="rtl" type="password" id="confirm_password" placeholder="تأكيد كلمة المرور" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror">
            <div class="text-danger" id="confirm_password_error">
                @error('password_confirmation'){{ $message }}@enderror
                @error('password') @if ($message === '*كلمة المرور غير متطابقة'){{ $message }}@endif @enderror
            </div>
    <div dir="rtl">
                <label for="user_image">صورة المستخدم:</label>
                <input lang="ar" type="file" id="file" name="file" accept="image/*" class="@error('file') is-invalid @enderror">
            </div>
            <div class="text-danger" id="file_error">@error('file'){{ $message }}@enderror</div>

    <p dir="rtl" style="color: gray; font-size: 0.85em; margin-bottom: 2px; margin-top: 4px;">كل البيانات مطلوبة *</p>
    <button type="submit" name="register" style="margin-bottom: 10px;" >تسجيل</button>

    <!-- <div class="meter-section">
            <meter id="progressMeter" min="0" max="4" value="0"></meter>
        </div> -->

        </div>
    </div>
</form>


<script>
const lang = '{{ str_contains(request()->path(), "Arabic") ? "ar" : "en" }}';
</script>
<script src="{{ asset('js/Validations.js') }}"></script>
<script src="{{ asset('js/whatsapp-checker.js') }}"></script>



@include('includes.Arabic_footer')


</body>
</html>

