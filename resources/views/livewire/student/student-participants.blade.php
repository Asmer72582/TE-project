<div>

    <html>

    <head>
        <link rel="stylesheet" href="{{ asset('css/Homepage.css') }}">
        <script src="https://www.gstatic.com/charts/loader.js"></script>
    </head>

    <body>
        @include('nav.student-nav')
        <div class="header-box">
          
            <span class="heading">PARTICIPANTS</span>
           

        </div>

        <style>
            body{
                padding: 0px;
                margin: 0px;

            }
            .rightside{
                display: flex;
                justify-content: end;
                width: 70%;
                float: right;

            }
            table {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                position: relative;
                top: 5vh;
                right: 5%;
                width: 500px;
                box-shadow: 0px 0px 10px gray;
            }

            table th {
                text-align: center;
                padding: 10px;

            }

            thead {
                background: #198753;
                color: white;
            }

            tr {
                text-align: center;
                /* padding: 10px; */
            }
           
            td {
                padding: 10px;
                background: whitesmoke;
            }
        </style>

  <div class="rightside">
    <table class="table table-striped table-bordered table-hover">

        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Group No</th>
            <th>Role</th>
        </thead>

        <tbody>

            @foreach ($participants as $participant)
                <tr>
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>{{ $participant->group_no }}</td>
                    <td>{{ $participant->user_type }}</td>

                </tr>
            @endforeach

        </tbody>

    </table>
  </div>


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
