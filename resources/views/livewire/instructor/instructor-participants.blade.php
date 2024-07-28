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
            <span class="heading">PARTICIPANTS</span>
            @include('nav.instructor-nav')

        </div>

        <style>
            table {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                position: relative;
                left: 15%;
                top: 10vh;
                width: 50%;
                box-shadow: 0px 0px 10px gray;
            }

            table tr {
                text-align: center;

            }

            thead {
                background: black;
                color: white;
            }

            th {
                padding: 10px;
            }

            td {
                padding: 10px;
                background: whitesmoke;
                z-index: 100;
            }
        </style>

        <table>

            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Group No</th>
                <th>Role</th>
                <th>Operation</th>
                {{-- <th>Operation</th> --}}
            </thead>

            <tbody>

                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->group_no }}</td>
                        <td>{{ $participant->user_type }}</td>
                        <td style="z-index: 2">
                            @if ($participant->user_type != "instructor")
                                <p style="background:red; color:white; border:none; padding:10px; cursor:pointer !important;" wire:click="deleteParticipants({{ $participant->id }})">Delete</p>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>


    </body>

    </html>
</div>

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

</div>
