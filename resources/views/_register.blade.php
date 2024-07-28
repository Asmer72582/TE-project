<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
</head>

<body>
    <form method="POST" action="{{ route('register') }}" class="form-container" name="Login">
        @csrf
        <p>
        <h1 class="form-header text-center text-light">REGISTER</h1>
        </p>
        <br>
        <div class="fields-container">
            <p class="common-container"><b>role:</b>
                <select style="" id="role-input" name="role" required
                    onclick="notBackground1(), notBackground2(), notBackground3(), Background4()">
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="instructor" {{ old('role') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                </select>

            </p>
            <p class="common-container"><b>Department:</b>
                <input type="text" size="25" name="department" id="field-1" required
                    style="" placeholder=" Enter Department"
                    onclick="Background1()" value="{{ old('department') }}">
            </p>
            <p class="common-container"><b>Name:</b>
                <input type="text" size="25" name="name" id="field-1" required
                    style="" placeholder=" Enter Name"
                    onclick="Background1()" value="{{ old('name') }}">
            </p>
            <p class="common-container"><b>Email-Id:</b>
                <input type="text" size="25" name="email" id="field-1" required
                    style="" placeholder=" Enter Email-Address"
                    onclick="Background1()" value="{{ old('email') }}">
            </p>


            <p class="common-container" id="group_container"><b>group_no:</b>
                <input type="text" size="25" name="group_no" required id="group_input"
                    style="" placeholder=" Enter group_no"
                    onclick="notBackground1(), Background2()" value="{{ old('group_no') }}">
            </p>
            <p class="common-container"><b>password:</b>
                <input type="password" size="25" id="field-2" required
                    style="" placeholder=" Enter password"
                    name="password" onclick="notBackground1(), notBackground2(), Background3()">
            </p>
            <br><br>
            <input type="submit" value="SUBMIT" class="btn-submit">
        </div>
        <br>
    <div class="login_links">
        <a class="forgot-password" href="{{ route('login') }}" onclick="color()" style="left:10%;">Login</a>
        <a class="forgot-password" href="{{ route('password.request') }}" onclick="color()">FORGOT password</a>

    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script defer>
            $(document).ready(function() {
                $(document).on("change", "#role-input", function() {
                    let selected = $("#role-input").val();

                    if (selected === "superadmin") {
                        $("#group_input").val("superadmin");
                        // $("#group_input").prop("disabled", true);
                        $("#group_input").prop('required', false);
                        $("#group_container").fadeOut();
                    } else {
                        $("#group_input").val("");
                        // $("#group_input").prop("disabled", false);
                        $("#group_input").prop('required', true);
                        $("#group_container").fadeIn();
                    }

                })
            })

            @if ($errors->any())
                var errorMessages = @json($errors->all());

                var errorMessageString = "";

                for (var i = 0; i < errorMessages.length; i++) {
                    errorMessageString += "- " + errorMessages[i] + "\n";
                }

                alert(errorMessageString);
            @endif
        </script>

    </form>



    <script>
        function Background1() {
            const emailField = document.forms["Login"]["email"];
            emailField.style.boxShadow = (emailField.style.boxShadow === 'none') ? '0px 0px 3px 4px rgba(63,63,244,0.5)' :
                'none';
        }

        function notBackground1() {
            document.forms["Login"]["email"].style.boxShadow = 'none';
        }

        function Background2() {
            const groupNoField = document.forms["Login"]["group_no"];
            groupNoField.style.boxShadow = (groupNoField.style.boxShadow === 'none') ?
                '0px 0px 3px 4px rgba(63,63,244,0.5)' : 'none';
        }

        function notBackground2() {
            document.forms["Login"]["group_no"].style.boxShadow = 'none';
        }

        function Background3() {
            const passwordField = document.forms["Login"]["password"];
            passwordField.style.boxShadow = (passwordField.style.boxShadow === 'none') ?
                '0px 0px 3px 4px rgba(63,63,244,0.5)' : 'none';
        }

        function notBackground3() {
            document.forms["Login"]["password"].style.boxShadow = 'none';
        }

        function Background4() {
            const roleField = document.forms["Login"]["role"];
            roleField.style.boxShadow = (roleField.style.boxShadow === 'none') ? '0px 0px 3px 4px rgba(63,63,244,0.5)' :
                'none';
        }

        function notBackground4() {
            document.forms["Login"]["role"].style.boxShadow = 'none';
        }

        function color() {
            document.getElementsByClassName('forgot-password')[0].style.color = 'orange';
        }
    </script>
</body>

</html>
