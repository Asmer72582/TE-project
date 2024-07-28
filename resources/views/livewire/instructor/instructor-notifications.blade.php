<div>

    <html>

    <head>
        <link rel="stylesheet" href="{{ asset('css/Homepage.css') }}">
        <script src="https://www.gstatic.com/charts/loader.js"></script>
    </head>

    <body>
        <div class="header-box">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                class="navigation-icon" onclick="TabDisplay(event)">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <span class="heading">NOTIFICATIONS</span>

            @include('nav.instructor-nav')
        </div>

        <style>
            .notification-container {
                width: 70%;
                height: auto;
                position: relative;
                left: 20%;
                top: 2vh;
                color: white;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                font-weight: bold;
            }

            .notifications {
                background: -webkit-linear-gradient(right, rgb(242, 26, 242), rgba(94, 94, 242));
                box-shadow: 0px 0px 10px black;
                padding: 20px;
                margin-top: 20px;
            }

            .notification_title,
            .notification_message {
                line-height: 40px;
            }



            .created_at {
                text-align: right;
            }

            .repositories {
                width: 75%;
                height: auto;
                position: relative;
                left: 20%;
                padding: 20px;
                overflow: hidden;
            }

            .repo-header {
                background: whitesmoke;
                padding: 20px;
                position: relative;
                box-shadow: 0px 0px 5px black;
            }


            .create-folder-section {
                width: 20%;
                float: left;
                position: relative;
                z-index: 100;
            }

            .create-folder-section input {
                padding: 10px;
            }

            .create-folder-section button,
            .upload-file-section input[type="submit"] {
                color: white;
                background: black;
                padding: 10px;
                outline: none;
            }

            .upload-file-section {
                /* display: inline; */
                /* float:left; */
                position: relative;
            }

            .create_folder{
                padding:10px;
                cursor: pointer;
                outline: none;
                background:black;
                color:white;
                position: absolute;
                top:30%;
                right:40%;
            }

        </style>

        <div class="repositories">

            <div class="repo-header">

                <div class="upload-section">

                    <div class="create-folder-section">
                        <input type="text" name="" wire:model="notification_title" id="Notifiation Title"
                            placeholder="Notification title.." id="" required>
                        </div>
                        <textarea name="" placeholder="Notification Message" wire:model="notification_message"  id="" cols="30" rows="2"></textarea>
                        <button wire:click="create_notification" class="create_folder">Send Notification</button>


                    </form>
                </div>
            </div>
        </div>

        <div class="notification-container">
            @foreach ($notifications as $notification)
                <div class="notifications">
                    <div class="notification_title">Title: {{ $notification->notification_title }}</div>
                    <div class="notification_message">Message: {{ $notification->notification_message }}</div>
                    <div class="created_at">{{ $notification->created_at }}</div>
                </div>
            @endforeach
        </div>

    </body>


    <script>
        function TabDisplay(event) {
            let tab = document.getElementsByClassName("navigation-tab")[0];
            if (tab.style.display === 'flex') {
                tab.style.display = 'none';
            } else {
                tab.style.display = 'flex';
            }
        }
    </script>

    </html>

</div>
