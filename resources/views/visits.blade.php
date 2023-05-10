<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/flag-icons.css') }}" />


</head>

<body class="antialiased">
    <div class="container mt-5">
        <h1>Visitors' Visits</h1>
        <ul class="nav nav-tabs" id="visits-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="browser-tab" data-bs-toggle="tab" data-bs-target="#browser" type="button" role="tab" aria-controls="browser" aria-selected="true">
                    Browser
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="operating-system-tab" data-bs-toggle="tab" data-bs-target="#operating-system" type="button" role="tab" aria-controls="operating-system" aria-selected="false">
                    Operating System
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="country-tab" data-bs-toggle="tab" data-bs-target="#country" type="button" role="tab" aria-controls="country" aria-selected="false">
                    Country
                </button>
            </li>
        </ul>
        <div class="tab-content" id="visits-tabs-content">
            <div class="tab-pane fade show active" id="browser" role="tabpanel" aria-labelledby="browser-tab">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Browser</th>
                            <th>Visits</th>
                            <th>Data in Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visit_info['browsers'] as $browser)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="./assets/icons/brands/{{$browser->browser_info}}.png" alt="{{$browser->browser_info}}" height="24" class="me-2">
                                    <span class="text-capitalize">{{$browser->browser_info}}</span>
                                </div>
                            </td>
                            <td>{{$browser->visits}}</td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="progress w-100" style="height:10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$browser->total}}%" aria-valuenow="{{$browser->total}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="fw-semibold">{{$browser->total}}%</small>
                                </div>
                            </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
                {{-- {{ $visits->links() }} --}}
            </div>
            <div class="tab-pane fade" id="operating-system" role="tabpanel" aria-labelledby="operating-system-tab">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Operating System</th>
                            <th>Visits</th>
                            <th>Data in Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visit_info['oss'] as $os)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="./assets/icons/brands/{{$os->os}}.png" alt="{{$os->os}}" height="24" class="me-2">
                                    <span class="text-capitalize">{{$os->os}}</span>
                                </div>
                            </td>
                            <td>{{$os->visits}}</td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="progress w-100" style="height:10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$os->total}}%" aria-valuenow="{{$os->total}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="fw-semibold">{{$os->total}}%</small>
                                </div>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                {{-- {{ $visits->links() }} --}}
            </div>
            <div class="tab-pane fade" id="country" role="tabpanel" aria-labelledby="country-tab">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Country</th>
                            <th>Visits</th>
                            <th>Data in Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visit_info['countries'] as $country)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="flag-icon flag-icon-{{$country->country_code}} flag-icon-squared rounded-circle me-1 fs-3"></i>
                                    <span class="text-capitalize">{{$country->country}}</span>
                                </div>
                            </td>
                            <td>{{$country->visits}}</td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center gap-3">
                                    <div class="progress w-100" style="height:10px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$country->total}}%" aria-valuenow="{{$country->total}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="fw-semibold">{{$country->total}}%</small>
                                </div>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                {{-- {{ $visits->links() }} --}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
