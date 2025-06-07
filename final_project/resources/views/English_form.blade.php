
<!DOCTYPE html>
<html lang="en">
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
     .error-message {
    color: red;
    font-size: 14px;
    margin-top: 2px;
     }

.is-invalid { border-color: red !important; }
 .text-danger { color: red; font-size: 0.85em; margin-top: 2px; margin-bottom: 5px; }
 input:not(.is-invalid) { border-color: #ccc; } 
.input-button-group {
     display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
  }#wpbutton {
  padding: 13px 12px;
  display: flex;
  justify-content: center;  /* center horizontally */
  align-items: center;
  margin-bottom: 20px;   /* center vertically */
   width:30%;
  white-space: nowrap; /* prevent text from wrapping */
}




    </style>
</head>
<body>

@include('includes.header')
<div id ="main">
<div class="form-container">
<div id="alertBox" style="display: none;" class="alert"></div>
<h2 style="text-align: center;" >Registration Form</h2>
<!-- <form method="POST" enctype="multipart/form-data" action="DB_Ops.php" onsubmit="return validateForm()" > -->
<form id="myForm" method="POST" action="{{ route('register.store') }}">
     @csrf
     <input type="hidden" name="register" value="1">
     <label for="full_name">Full Name:</label>
    <input type="text" id="full_name" name="full_name" placeholder="Full Name"
                   value="{{ old('full_name') }}" class="@error('full_name') is-invalid @enderror">
            <div class="text-danger" id="full_name_error">@error('full_name'){{ $message }}@enderror</div>


    <label for="user_name">Username:</label>
            <input type="text" id="user_name" placeholder="Username" name="user_name"
                   value="{{ old('user_name') }}" class="@error('user_name') is-invalid @enderror">
            <div class="text-danger" id="user_name_error">@error('user_name'){{ $message }}@enderror</div>



    <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Example@domain.com" name="email"
                   value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
            <div class="text-danger" id="email_error">@error('email'){{ $message }}@enderror</div>


    <label for="phone">Phone:</label>
            <input type="text" id="phone" placeholder="Phone number" name="phone"
                   value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror">
            <div class="text-danger" id="phone_error">@error('phone'){{ $message }}@enderror</div>

    <label for="whatsapp">WhatsApp Number:</label>
            <div class="input-button-group">
                <input type="text" id="whatsapp" placeholder="WhatsApp number" name="whatsapp"
                       value="{{ old('whatsapp') }}" class="@error('whatsapp') is-invalid @enderror">
                <button type="button" onclick="checkWhatsAppNumber()" id="wpbutton">Check Validity</button>
            </div>
            <div class="text-danger" id="whatsapp_error">@error('whatsapp'){{ $message }}@enderror</div>

 <label for="country">Address:</label>
            <div style="display: flex; gap: 10px;">
                <input type="text" id="country" name="country" placeholder="Country" style="flex: 1;"
                       value="{{ old('country') }}" class="@error('country') is-invalid @enderror">
                <input type="text" id="city" name="city" placeholder="City" style="flex: 1;"
                       value="{{ old('city') }}" class="@error('city') is-invalid @enderror">
            </div>
            <div class="text-danger" id="country_error">@error('country'){{ $message }}@enderror</div>
            <div class="text-danger" id="city_error">@error('city'){{ $message }}@enderror</div>


    <!-- <label for="address">Address:</label>
    <textarea id="address" name="address" required></textarea> -->

 
    <label for="password">Password:</label>
    <input type="password" id="password" placeholder="8+ characters (at least 1 special char & 1 number)" name="password"
        class="@error('password') is-invalid @enderror">
    <div class="text-danger" id="password_error">@error('password'){{ $message }}@enderror</div>

     <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" placeholder="Confirm Password" name="password_confirmation"
                   class="@error('password_confirmation') is-invalid @enderror">
            <div class="text-danger" id="confirm_password_error">
                @error('password_confirmation'){{ $message }}@enderror
                @error('password') @if ($message === '*Password doesn\'t match'){{ $message }}@endif @enderror
            </div>


     <label for="user_image">User Image:</label>
            <input type="file" id="file" name="file" accept="image/*"
                   class="@error('file') is-invalid @enderror">
            <div class="text-danger" id="file_error">@error('file'){{ $message }}@enderror</div>

    <p style="color: gray; font-size: 0.85em; margin-bottom: 2px; margin-top: 4px;">* All fields are required</p>
    <button type="submit" name="register" style="margin-bottom: 10px;" >Register</button>

    <!-- <div class="meter-section">
            <meter id="progressMeter" min="0" max="4" value="0"></meter>
        </div> -->

        </div>
    </div>
</form>
<!-- 
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    let isUsernameAvailable = true;

    const fields = { -->
<!-- //         full_name: {
//             el: document.getElementById("full_name"),
//             error: document.getElementById("full_name_error"),
//             validate: value => {
//                 if (value.trim() === "") return "*This field is required";
//                 if (/[^a-zA-Z\s]/.test(value)) return "*Full name must contain only letters and spaces";
//                 return "";
//             }
//         },
//         user_name: {
//             el: document.getElementById("user_name"),
//             error: document.getElementById("user_name_error"),
//             validate: value => {
//                 if (value.trim() === "") return "*This field is required";
//                 return "";
//             }
//         },
//         country: {
//             el: document.getElementById("country"),
//             error: document.getElementById("country_error"),
//             validate: value => {
//                 if (value.trim() === "") return "*This field is required";
//                 return "";
//             }
//         },
//         city: {
//             el: document.getElementById("city"),
//             error: document.getElementById("city_error"),
//             validate: value => {
//                 if (value.trim() === "") return "*This field is required";
//                 return "";
//             }
//         },
//         email: {
//             el: document.getElementById("email"),
//             error: document.getElementById("email_error"),
//             validate: value => {
//                 const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,6}$/;
//                 if (value.trim() === "") return "*This field is required";
//                 if (!emailPattern.test(value)) return "*Email must be in format: example@domain.com";
//                 return "";
//             }
//         },
//         phone: {
//             el: document.getElementById("phone"),
//             error: document.getElementById("phone_error"),
//             validate: value => {
//                 const phonePattern = /^\+?\d+$/;
//                 if (value.trim() === "") return "*This field is required";
//                 if (!phonePattern.test(value)) return "*Phone must be digits and may start with +";
//                 return "";
//             }
//         },
//         whatsapp: {
//     el: document.getElementById("whatsapp"),
//     error: document.getElementById("whatsapp_error"),
//     validate: value => {
//         const phonePattern = /^\+\d{6,15}$/;
//         if (value.trim() === "") return "*This field is required";
//         if (!phonePattern.test(value)) return "*WhatsApp must start with + followed by 6 to 15 digits according to your country";
//         return "";
//     }
// },
//         password: {
//             el: document.getElementById("password"),
//             error: document.getElementById("password_error"),
//             validate: value => {
//                 if (value.trim() === "") return "*This field is required";
//                 if (!/^(?=.*\d)(?=.*[!@#$%^&*?]).{8,}$/.test(value)) {
//                     return "*At least 8 characters, 1 number, 1 special character";
//                 }
//                 return "";
//             }
//         },
//         confirm_password: {
//             el: document.getElementById("confirm_password"),
//             error: document.getElementById("confirm_password_error"),
//             validate: (value) => {
//                 const passwordVal = document.getElementById("password").value;
//                 if (value.trim() === "") return "*This field is required";
//                 if (value !== passwordVal) return "*Password doesn't match";
//                 return "";
//             }
//         }
//     };

//     Object.values(fields).forEach(({ el, error, validate }) => {
//         el.addEventListener("blur", () => {
//             const err = validate(el.value);
//             error.textContent = err;
//             error.style.color = "red";
//             el.style.borderColor = err ? "red" : "#ccc";
//         });

//         el.addEventListener("input", () => {
//             const err = validate(el.value);
//             error.textContent = err;
//             el.style.borderColor = err ? "red" : "#ccc";
//         });
//     }); -->


     <!-- // Username availability check (on blur)
    document.getElementById("user_name").addEventListener("blur", function () {
        const username = this.value.trim();
        if (username !== "") {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "DB_Ops.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText === "exists") {
                        isUsernameAvailable = false;
                        fields.user_name.error.textContent = "*Username already taken";
                        fields.user_name.error.style.color = "red";
                        fields.user_name.el.style.borderColor = "red";
                    } else {
                        isUsernameAvailable = true;
                        fields.user_name.error.textContent = "";
                        fields.user_name.el.style.borderColor = "#ccc";
                    }
                }
            };
            xhr.send("user_name=" + encodeURIComponent(username));
        }
    });

    // Final form submission with AJAX
form.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent default form submission

    let isValid = true;

    // Validate all input fields
    Object.values(fields).forEach(({ el, error, validate }) => {
        const err = validate(el.value);
        if (err) {
            error.textContent = err;
            error.style.color = "red";
            el.style.borderColor = "red";
            isValid = false;
        } else {
            error.textContent = "";
            el.style.borderColor = "#ccc";
        }
    });

    // Validate the image upload field
    const fileInput = document.querySelector('input[type="file"]');
    if (!fileInput || !fileInput.files.length) {
        alert("Please upload an image.");
        isValid = false;
    }

    // Check if username has already been marked unavailable
    if (!isUsernameAvailable) {
        fields.user_name.error.textContent = "*Username already taken";
        fields.user_name.el.style.borderColor = "red";
        isValid = false;
    }

    // If all validations pass, proceed with AJAX form submission
    if (isValid) {
        const formData = new FormData(form);
        formData.append("register", "1"); // Append the register flag

        const submitXhr = new XMLHttpRequest();
        submitXhr.open("POST", "DB_Ops.php", true);
        submitXhr.onreadystatechange = function () {
            if (submitXhr.readyState === 4 && submitXhr.status === 200) {
                alert(submitXhr.responseText); // Show success or error message

                form.reset(); // Reset form fields

                // Reset UI styles
                Object.values(fields).forEach(({ el, error }) => {
                    el.style.borderColor = "#ccc";
                    error.textContent = "";
                });

                // Optional: reset file input styling or message if needed
                if (fileInput) {
                    fileInput.style.borderColor = "#ccc";
                }
            }
        };

        submitXhr.send(formData);
    }
});
}); -->

<script>
const lang = '{{ str_contains(request()->path(), "Arabic") ? "ar" : "en" }}';
</script>
<script src="{{ asset('js/Validations.js') }}"></script>
<script src="{{ asset('js/whatsapp-checker.js') }}"></script>


@include('includes.footer')


</body>
</html>

