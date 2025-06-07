// public/js/register_validation.js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('myForm'); // Now correctly targets the form by ID
    if (!form) {
        console.error("Form with ID 'myForm' not found.");
        return;
    }
    console.log("Validation JS loaded with language:", lang);


    // Ensure `lang` is defined. It should be passed from Blade as a global const.
    // console.log("Validation JS loaded with language:", lang); // This should now work if `lang` is defined in Blade.

    const messages = {
        en: {
            full_name_required: "*This field is required",
            full_name_no_numbers: "*Full name must not contain numbers",
            user_name_required: "*This field is required",
            // user_name_taken: "This username is already taken.", // Client-side unique needs AJAX
            email_required: "*This field is required",
            email_format: "*Email must be in format: example@domain.com",
            // email_taken: "Invalid or duplicate email address.", // Client-side unique needs AJAX
            phone_required: "*This field is required",
            phone_format: "*Phone must be digits and may start with +",
            whatsapp_required: "*This field is required",
            whatsapp_format: "*WhatsApp must be digits and can start with +",
            password_required: "*This field is required",
            password_complex: "*At least 8 characters, 1 number, 1 special character",
            confirm_password_required: "*This field is required", // Added specific message
            password_match: "*Password doesn't match",
            file_required: "*User image is required",
            file_image: "*The file must be an image (jpeg, png, jpg, gif, svg).",
            file_size: "*The image may not be greater than 2MB."
        },
        ar: {
            full_name_required: "*هذه الخانة مطلوبة",
            full_name_no_numbers: "*لا يجب أن يحتوي الاسم الكامل على أرقام",
            user_name_required: "*هذه الخانة مطلوبة",
            password_required: "*هذه الخانة مطلوبة",
            confirm_password_required: "*هذه الخانة مطلوبة", 
            whatsapp_required: "*هذه الخانة مطلوبة",
             email_required: "*هذه الخانة مطلوبة",
            // user_name_taken: "اسم المستخدم هذا مأخوذ بالفعل.",
            email_format: "*يجب أن يكون البريد الإلكتروني مثل هذا: example@domain.com",
            // email_taken: "البريد الإلكتروني غير صالح أو مكرر.",
            phone_required: "*هذه الخانة مطلوبة",
            phone_format: "*يجب أن يكون رقم الهاتف أرقاماً وقد يبدأ بـ +",
            whatsapp_format: "*يجب أن يكون رقم الواتساب أرقاماً ويمكن أن يبدأ بـ +",
            password_complex: "*8 أحرف على الأقل، 1 رقم، 1 حرف خاص",
            password_match: "*كلمة المرور غير متطابقة",
            file_required: "*صورة المستخدم مطلوبة",
            file_image: "*يجب أن يكون الملف صورة (jpeg, png, jpg, gif, svg).",
            file_size: "*يجب ألا تتجاوز الصورة 2 ميجابايت."
        }
    };

  
    const langMessages = (typeof lang !== 'undefined' && lang === 'ar') ? messages.ar : messages.en;

    const showError = (inputId, message) => {
        const inputElement = document.getElementById(inputId);
        const errorDiv = document.getElementById(inputId + '_error'); // Get the existing error div

        if (inputElement && errorDiv) {
            errorDiv.textContent = message; // Set the message
            errorDiv.style.color = 'red';
            inputElement.classList.add('is-invalid'); //class
        }
        // Invalidate the form if any error occurs
        if (form) form.dataset.isValid = 'false';
    };

    // to remove an error message
    const removeError = (inputId) => {
        const inputElement = document.getElementById(inputId);
        const errorDiv = document.getElementById(inputId + '_error');

        if (inputElement && errorDiv) {
            errorDiv.textContent = ''; // Clear the message
            inputElement.classList.remove('is-invalid'); // Remove error class
        }
    };

    
    const validateField = (inputId) => {
        let valid = true;
        const inputElement = document.getElementById(inputId);
        if (!inputElement) return true; // Should not happen if HTML is correct

        const value = inputElement.value.trim();

        //validations
        switch (inputId) {
            case 'full_name':
                if (!value) { showError(inputId, langMessages.full_name_required); valid = false; }
                else if (/\d/.test(value)) { showError(inputId, langMessages.full_name_no_numbers); valid = false; }
                else { removeError(inputId); }
                break;
            case 'user_name':
                if (!value) { showError(inputId, langMessages.user_name_required); valid = false; }
                else { removeError(inputId); }
                // Client-side unique check requires AJAX to server, so not purely client-side here.
                break;
            case 'email':
                if (!value) { showError(inputId, langMessages.email_required); valid = false; }
                else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) { showError(inputId, langMessages.email_format); valid = false; }
                else { removeError(inputId); }
                break;
            case 'phone':
                if (!value) { showError(inputId, langMessages.phone_required); valid = false; }
                else if (!/^\+?\d+$/.test(value)) { showError(inputId, langMessages.phone_format); valid = false; }
                else { removeError(inputId); }
                break;
            case 'whatsapp':
                if (!value) { showError(inputId, langMessages.whatsapp_required); valid = false; }
                else if (!/^\+?\d+$/.test(value)) { showError(inputId, langMessages.whatsapp_format); valid = false; }
                else { removeError(inputId); }
                break;
            case 'country':
            case 'city':
                if (!value) { showError(inputId, langMessages.country_required); valid = false; } // Reusing for city too
                else { removeError(inputId); }
                break;
            case 'password':
                if (!value) { showError(inputId, langMessages.password_required); valid = false; }
                else if (!/^(?=.*\d)(?=.*[!@#$%^&*?]).{8,}$/.test(value)) { showError(inputId, langMessages.password_complex); valid = false; }
                else { removeError(inputId); }
                // Also re-validate confirm_password if password changes
                validateField('confirm_password');
                break;
            case 'confirm_password':
                const passwordValue = document.getElementById('password').value;
                if (!value) { showError(inputId, langMessages.confirm_password_required); valid = false; }
                else if (value !== passwordValue) { showError(inputId, langMessages.password_match); valid = false; }
                else { removeError(inputId); }
                break;
            case 'file':
                const fileInput = document.getElementById('file');
                if (!fileInput ) {
                    showError(inputId, langMessages.file_required);
                    valid = false;
                } else {
                    const file = fileInput.files[0];
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!allowedTypes.includes(file.type)) {
                        showError(inputId, langMessages.file_image);
                        valid = false;
                    } else if (file.size > maxSize) {
                        showError(inputId, langMessages.file_size);
                        valid = false;
                    } else {
                        removeError(inputId);
                    }
                }
                break;
        }
        return valid;
    };

    // Attach event listeners for real-time validation
    const fieldIds = ['full_name', 'user_name', 'email', 'phone', 'whatsapp', 'country', 'city', 'password', 'confirm_password', 'file'];

    fieldIds.forEach(id => {
        const inputElement = document.getElementById(id);
        if (inputElement) {
            // Validate on blur (when user leaves the field)
            inputElement.addEventListener('blur', () => validateField(id));
            // Validate on input (as user types, for immediate feedback)
            // For file input, use 'change' event
            if (id === 'file') {
                inputElement.addEventListener('change', () => validateField(id));
            } else {
                inputElement.addEventListener('input', () => validateField(id));
            }
        }
    });


    // Form submission validation
    form.addEventListener('submit', function (e) {
        // Reset the form's validity state for this submission attempt
        form.dataset.isValid = 'true';

        // Validate all fields on submit
        fieldIds.forEach(id => {
            validateField(id); // This will update form.dataset.isValid if any error is found
        });

        // Prevent form submission if any field was invalid
        if (form.dataset.isValid === 'false') {
            e.preventDefault();
        }
    });
});

// document.addEventListener('DOMContentLoaded', function () {
//     const form = document.getElementById('myForm'); // more specific
//     if (!form) return;

//     console.log("Validation JS loaded with language:", lang);

//     form.addEventListener('submit', function (e) {
//         let valid = true;

//         const messages = {
//             en: {
//                 full_name: "Full name is required and must not contain numbers.",
//                 user_name: "Username is required.",
//                 email: "Invalid or duplicate email address.",
//                 phone: "Phone number is required and must be digits only.",
//                 whatsapp: "WhatsApp number is required and must be digits only.",
//                 password: "Password must be at least 8 characters with a number and special character.",
//                 confirm_password: "Passwords do not match.",
//             },
//             ar: {
//                 full_name: "الاسم الكامل مطلوب ويجب ألا يحتوي على أرقام.",
//                 user_name: "اسم المستخدم مطلوب.",
//                 email: "البريد الإلكتروني غير صالح أو مكرر.",
//                 phone: "رقم الهاتف مطلوب ويجب أن يحتوي على أرقام فقط.",
//                 whatsapp: "رقم الواتساب مطلوب ويجب أن يحتوي على أرقام فقط.",
//                 password: "كلمة المرور يجب أن تكون 8 أحرف على الأقل مع رقم ورمز خاص.",
//                 confirm_password: "كلمة المرور غير متطابقة.",
//             }
//         };

//         const langMessages = lang === 'ar' ? messages.ar : messages.en;

//         // Remove previous error messages
//         document.querySelectorAll('.error-message').forEach(el => el.remove());

//         const showError = (id, message) => {
//             const input = document.getElementById(id);
//             if (!input) return;
//             const errorDiv = document.createElement('div');
//             errorDiv.className = 'error-message';
//             errorDiv.style.color = 'red';
//             errorDiv.innerText = message;
//             input.insertAdjacentElement('afterend', errorDiv);
//             valid = false;
//         };

//         const fullName = document.getElementById('full_name').value.trim();
//         if (!fullName || /\d/.test(fullName)) showError('full_name', langMessages.full_name);

//         const userName = document.getElementById('user_name').value.trim();
//         if (!userName) showError('user_name', langMessages.user_name);

//         const email = document.getElementById('email').value.trim();
//         if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) showError('email', langMessages.email);

//         const phone = document.getElementById('phone').value.trim();
//         if (!/^\+?\d+$/.test(phone)) showError('phone', langMessages.phone);

//         const whatsapp = document.getElementById('whatsapp').value.trim();
//         if (!/^\+?\d+$/.test(whatsapp)) showError('whatsapp', langMessages.whatsapp);

//         const password = document.getElementById('password').value;
//         if (!/^(?=.*\d)(?=.*[!@#$%^&*?]).{8,}$/.test(password)) showError('password', langMessages.password);

//         const confirmPassword = document.getElementById('confirm_password').value;
//         if (password !== confirmPassword) showError('confirm_password', langMessages.confirm_password);

//         if (!valid) {
//             e.preventDefault(); // Prevent form submission if any field is invalid
//         }
//     });
// });
