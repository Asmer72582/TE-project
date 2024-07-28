<div>


    <html>

    <head>
        <link rel="stylesheet" href="{{ asset('css/Tasks.css') }}">
        <script src="https://www.gstatic.com/charts/loader.js"></script>
    </head>

    <body>
        <div class="header-box">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                class="navigation-icon" onclick="TabDisplay(event)">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <span class="heading">PROPOSALS</span>

            @include('nav.instructor-nav')


        </div>

        <style>
            table {
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                position: absolute;
                left: 25.5%;
                top: 3.2vh;
                width: 60%;
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
                /* background: whitesmoke; */
            }

            .toggle_button {
                background: black;
                text-align: center;
                align-content: center;
                justify-content: center;
                color: white;
                padding: 10px;
                z-index: 100;
                cursor: pointer;
            }
        </style>

        <table>

            <thead>
                <th>Submitted By</th>
                <th>Proposal Title</th>
                <th>Proposal Description</th>
                <th>Proposal Domain</th>
                <th>Status</th>
            </thead>


            <tbody>
                @foreach ($proposals as $proposal)
                    <tr
                        style="background:@if ($proposal->is_accepted === 1) lightgreen @elseif($proposal->is_accepted === 0) pink @else whitesmoke @endif;">
                        <td>{{$proposal->student}}</td>
                        <td>{{ $proposal->proposal_name }}</td>
                        <td>{{ $proposal->proposal_description }}</td>
                        <td>{{ $proposal->proposal_domain }}</td>
                        <td>

                            @if ($proposal->is_accepted === null)
                                <button class="toggle_button" wire:click="MarkasAccepted({{ $proposal->proposal_id }})">
                                    Click here to Mark as Accepted <img src="{{ asset('img/tick.png') }}" height="20"
                                        alt="">
                                </button>

                                <button class="toggle_button" wire:click="MarkasRejected({{ $proposal->proposal_id }})">
                                    Click here to Mark as Rejected <img src="{{ asset('img/rejected.png') }}"
                                        height="20" alt="">
                                </button>
                            @else
                                <button class="toggle_button"
                                    wire:click="ToggleProposals({{ $proposal->proposal_id }})">
                                    @if ($proposal->is_accepted == 0)
                                        Click here to Mark as Accepted <img src="{{ asset('img/tick.png') }}"
                                            height="20" alt="">
                                    @else
                                        Click here to Mark as Rejected <img src="{{ asset('img/rejected.png') }}"
                                            height="20" alt="">
                                    @endif
                                </button>
                            @endif

                        </td>
                    </tr>
                @endforeach


            </tbody>

        </table>


    </body>

    </html>


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

    @script
        <script>
            window.addEventListener('proposal', event => {
                alert(event.detail[0].message);
            })
        </script>
    @endscript

</div>
