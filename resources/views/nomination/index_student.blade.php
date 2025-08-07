@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nomination Form | {{ $theme->title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <style>
        body {
            background-color: #f2f2f2;
            background-image: url('{{ asset('assets/img/' . $theme->background) }}');
        }

        .container {
            max-width: 700px;
            padding: 20px;
            margin: 40px auto;
            background-color: #f2f2f2;
            border-radius: 15px;
            /* box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1), -10px -10px 20px rgba(255, 255, 255, 0.5); */
        }

        .border {
            border-radius: 15px;
        }

        .form-control {
            background-color: #f2f2f2;
            border: none;
            border-radius: 10px;
            box-shadow: inset 6px 6px 6px rgba(0, 0, 0, 0.1), inset -6px -6px 6px rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            outline: none;
            box-shadow: inset 4px 4px 4px rgba(0, 0, 0, 0.1), inset -4px -4px 4px rgba(255, 255, 255, 0.5);
        }

        .btn-primary {
            background-color: #65a9e6;
            border-color: #65a9e6;
            border-radius: 10px;
            box-shadow: 6px 6px 6px rgba(0, 0, 0, 0.1), -6px -6px 6px rgba(255, 255, 255, 0.5);
        }

        .btn-primary:hover {
            background-color: #5593cd;
            border-color: #5593cd;
        }

        .card {
            background-color: #f2f2f2;
            border: none;
            border-radius: 15px;
            /* box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1), -10px -10px 20px rgba(255, 255, 255, 0.5); */
        }

        .card-header {
            background-color: #f2f2f2;
            border-bottom: none;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            background-color: #f2f2f2;
            border-top: none;
            border-radius: 0 0 15px 15px;
        }

        h5 {
            color: #333;
        }

        label {
            color: #555;
        }

        .count {
            font-size: 10px;
            box-shadow: inset 6px 6px 6px rgba(0, 0, 0, 0.1), inset -6px -6px 6px rgba(255, 255, 255, 0.5);
            display: block;
            text-align: center;
            margin: 5px auto 20px !important;
            width: 30%;
            padding: 5px;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container shadow">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="card-header text-center">
                    <a href="{{ $theme->url }}">
                        <img width="150px" src="{{ asset('assets/img/' . $theme->logo) }}" alt="">
                    </a>
                    <div class="time py-1" id="countdown"></div>
                </div>
                <div class="card shadow">
                    @php
                        use Carbon\Carbon;
                        $time = Carbon::parse($theme->close);
                        $close = $time;
                    @endphp
                    @if ($form_type == 'store')
                        @if (Carbon::now() <= $close)
                            <div class="card-body">
                                @include('validate')
                                <form action="{{ route('form.store') }}" method="POST" class="was-validated">
                                    @csrf
                                    <u>
                                        <h5 class="text-center text-uppercase">Nominator's Details</h5>
                                    </u>
                                    <p class="text-center">Nominator's Contact Information</p>
                                    <div class="border p-3 shadow my-3">
                                        <div class="mb-2">
                                            <label for="validationName" class="form-label">
                                                <b>Full Name <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Full Name</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationEmail" class="form-label">
                                                <b>Email <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Email</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Contact Number <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Contact Number</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationName" class="form-label">
                                                <b>University <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="university" class="form-control"
                                                value="{{ old('university') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your University Name
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Department <span class="text-danger">*</span></b>
                                            </label>
                                            <input list="organisations" type="text" name="department"
                                                class="form-control" value="{{ old('department') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Department</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Stage Of Education <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="sob" class="form-control"
                                                value="{{ old('sob') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Stage Of Education</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Address <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ old('address') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Address</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationName" class="form-label">
                                                <b>Date Of Birth </b> <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="date" name="dob" class="form-control"
                                                value="{{ old('dob') }}" required>
                                                <div class="invalid-feedback text-uppercase">Enter Your Date Of Birth</div>
                                        </div>
                                        {{-- <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Agency / Organization <span class="text-danger">*</span></b>
                                            </label>
                                            <input list="organisations" type="text" name="organization"
                                                class="form-control" value="{{ old('organization') }}" required>
                                            <!--<datalist id="organisations">-->
                                            <!--    @foreach ($invoices as $invoice)
-->
                                            <!--        <option value="{{ $invoice->name }}">-->
                                            <!--
@endforeach-->
                                            <!--</datalist>-->
                                            <div class="invalid-feedback text-uppercase">Enter Your Agency /
                                                Organization Name</div>
                                        </div> --}}
                                        {{-- <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Office Address <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ old('address') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Office Address</div>
                                        </div> --}}

                                        <!--<div class="mb-2">-->
                                        <!--    <label for="validationPhone" class="form-label">-->
                                        <!--        <b>Emergency Contact Number <span class="text-danger">*</span></b>-->
                                        <!--    </label>-->
                                        <!--    <input type="text" name="phone1" class="form-control"-->
                                        <!--        value="{{ old('phone1') }}" required>-->
                                        <!--    <div class="invalid-feedback text-uppercase">Enter Your Emergency Contact Number</div>-->
                                        <!--</div>-->
                                    </div>

                                    <h5 class="text-center text-uppercase"><span
                                            class="text-decoration-underline">Faculty Contact Details</span></h5>

                                    <div class="border p-3 shadow my-3">
                                        <div class="mb-2">
                                            <label for="validationName" class="form-label">
                                                <b>Full Name <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="alternative_name" class="form-control"
                                                value="{{ old('alternative_name') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Full Name</div>
                                        </div>
                                        {{-- <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Agency / Organization <span class="text-danger">*</span></b>
                                            </label>
                                            <input list="organisations" type="text" name="organization"
                                                class="form-control" value="{{ old('organization') }}" required>
                                            <!--<datalist id="organisations">-->
                                            <!--    @foreach ($invoices as $invoice)
-->
                                            <!--        <option value="{{ $invoice->name }}">-->
                                            <!--
@endforeach-->
                                            <!--</datalist>-->
                                            <div class="invalid-feedback text-uppercase">Enter Your Agency /
                                                Organization Name</div>
                                        </div> --}}
                                        {{-- <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Office Address <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ old('address') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Office Address</div>
                                        </div> --}}
                                        <div class="mb-2">
                                            <label for="validationEmail" class="form-label">
                                                <b>Email <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="email" name="alternative_email" class="form-control"
                                                value="{{ old('alternative_email') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Alternative Email
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Contact Number <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="alternative_phone" class="form-control"
                                                value="{{ old('alternative_phone') }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Alternative Contact
                                                Number
                                            </div>
                                        </div>
                                        <!--<div class="mb-2">-->
                                        <!--    <label for="validationPhone" class="form-label">-->
                                        <!--        <b>Emergency Contact Number <span class="text-danger">*</span></b>-->
                                        <!--    </label>-->
                                        <!--    <input type="text" name="phone1" class="form-control"-->
                                        <!--        value="{{ old('phone1') }}" required>-->
                                        <!--    <div class="invalid-feedback text-uppercase">Enter Your Emergency Contact Number</div>-->
                                        <!--</div>-->
                                    </div>

                                    <u>
                                        <h5 class="text-center text-uppercase">Information about the Nomination</h5>
                                    </u>
                                    <p class="text-center text-muted">Please fill up the following information</p>
                                    <div class="border p-3 shadow my-3">
                                        {{-- <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Select Your Nomination Category <span
                                                        class="text-danger">*</span></b>
                                            </label>
                                            <select name="category" class="form-select">
                                                <option value="">Select Nomination Category *</option>
                                                <option value="Innovation By Student">Innovation By Student</option>
                                            </select>
                                            <div class="invalid-feedback text-uppercase">SELECT YOUR INNOVATION
                                                CATEGORY</div>
                                        </div> --}}
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Category <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="category" class="form-control"
                                                value="{{ 'Innovation By Student' }}" readonly required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Alternative Contact
                                                Number
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Background <span class="text-danger">*</span></b></label>
                                            <p id="backgroundcount" class="text-left text-center mb-1 d-none" style="font-size: 10px;">
                                                Word Count: <span id="display_backgroundcount">0</span> | Word Left: <span id="backgroundword_left">50</span>
                                            </p>
                                            <textarea name="background" id="background" class="form-control" cols="10" rows="3"
                                                placeholder="A concise description of the context of how the innovation was designed (problem statement). (Not more than 50 words)"
                                                value="{{ old('background') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Background</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Objective <span class="text-danger">*</span></b></label>
                                            <p id="objectivecount" class="text-left text-center mb-1 d-none" style="font-size: 10px;">
                                                Word Count: <span id="display_objectivecount">0</span> | Word Left: <span id="objectiveword_left">100</span>
                                            </p>
                                            <textarea name="objective" id="objective" class="form-control" cols="10" rows="3"
                                                placeholder="Define specific objectives of the innovation in the given amount of time and highlight other important factors relative to its success. (Not more than 100 words)"
                                                value="{{ old('objective') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Objective</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Vision <span class="text-danger">*</span></b></label>
                                            <p id="visioncount" class="text-left text-center mb-1 d-none" style="font-size: 10px;">
                                                Word Count: <span id="display_visioncount">0</span> | Word Left: <span id="visionword_left">50</span>
                                            </p>
                                            <textarea name="vision" id="vision" class="form-control" cols="10" rows="3"
                                                placeholder="What is the long-term vision of this innovation? (Not more than 50 words)"
                                                value="{{ old('vision') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Vision</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Explain Your Innovation: <span class="text-danger">*</span></b></label>
                                            <p id="ideacount" class="text-left text-center mb-1 d-none" style="font-size: 10px;">
                                                Word Count: <span id="display_ideacount">0</span> | Word Left: <span id="ideaword_left">150</span>
                                            </p>
                                            <textarea name="idea" id="idea" class="form-control" cols="10" rows="3"
                                                placeholder="What was the innovation idea/ concept of the innovation? (Not more than 150 words)"
                                                value="{{ old('idea') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Innovation Idea</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Execution <span class="text-danger">*</span></b></label>
                                            <p id="executioncount" class="text-left text-center mb-1 d-none" style="font-size: 10px;">
                                                Word Count: <span id="display_executioncount">0</span> | Word Left: <span id="executionword_left">150</span>
                                            </p>
                                            <textarea name="execution" id="execution" class="form-control" cols="10" rows="3"
                                                placeholder="Describe the strategy implied and how it was executed. What were the challenges in the execution and how were they addressed? (Not more than 150 words)"
                                                value="{{ old('execution') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Execution Plan</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Value Addition <span class="text-danger">*</span></b></label>
                                            <p id="value_additioncount" class="text-left text-center mb-1 d-none" style="font-size: 10px;">
                                                Word Count: <span id="display_value_additioncount">0</span> | Word Left: <span id="value_additionword_left">75</span>
                                            </p>
                                            <textarea name="value_addition" id="value_addition" class="form-control" cols="10" rows="3"
                                                placeholder="How has the innovation added to the wellbeing of the society/organization/nation? (Not more than 75 words)"
                                                value="{{ old('value_addition') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Value Addition</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Result/Impact OR Expected Result/Impact <span class="text-danger">*</span></b></label>
                                            <p id="resultcount" class="text-left text-center mb-1 d-none" style="font-size: 10px;">
                                                Word Count: <span id="display_resultcount">0</span> | Word Left: <span id="resultword_left">100</span>
                                            </p>
                                            <textarea name="result" id="result" class="form-control" cols="10" rows="4"
                                                placeholder="Describe the tangible results or expected impact of your innovation, including any positive outcomes achieved or anticipated outcomes in terms of societal, economic, or environmental benefits for Bangladesh. (Not more than 100 words)"
                                                value="{{ old('result') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Result/Impact</div>
                                        </div>

                                        <div class="my-4">
                                            <label for="validationPhone" class="form-label"><b>Supporting Documents
                                                    Google Drive Link <span class="text-danger">*</span></b></label>
                                            <textarea name="link" class="form-control" cols="10" rows="3"
                                                placeholder="Paste the Google Drive Link Here. (Upload the necessary materials in a folder and share the link here. The contents must include: PPT, Recommendation Letter and any other supporting documents)"
                                                value="{{ old('link') }}" required></textarea>
                                            <p class="text-danger mt-1">Disclaimer: Without proper supporting documents
                                                nomination will be disqualified.</p>
                                        </div>
                                        <div class="mt-2 text-center">
                                            <button style="width: 120px;" type="submit"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                </form>
                            </div>
                        @else
                            <div class="card-body">
                                <h3 class="text-center text-danger">
                                    Nomination submission window is now closed.
                                </h3>
                            </div>
                        @endif
                    @endif
                    @if ($form_type == 'edit')
                        @include('nomination.edit')
                    @endif
                </div>
                <div class="card-footer text-muted text-center">
                    @include('footer')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var sections = [{
                    id: "#background",
                    displayId: "#display_backgroundcount",
                    wordLeftId: "#backgroundword_left",
                    countId: "#backgroundcount",
                    maxLength: 50
                },
                {
                    id: "#objective",
                    displayId: "#display_objectivecount",
                    wordLeftId: "#objectiveword_left",
                    countId: "#objectivecount",
                    maxLength: 100
                },
                {
                    id: "#vision",
                    displayId: "#display_visioncount",
                    wordLeftId: "#visionword_left",
                    countId: "#visioncount",
                    maxLength: 50
                },
                {
                    id: "#idea",
                    displayId: "#display_ideacount",
                    wordLeftId: "#ideaword_left",
                    countId: "#ideacount",
                    maxLength: 150
                },
                {
                    id: "#execution",
                    displayId: "#display_executioncount",
                    wordLeftId: "#executionword_left",
                    countId: "#executioncount",
                    maxLength: 150
                },
                {
                    id: "#value_addition",
                    displayId: "#display_value_additioncount",
                    wordLeftId: "#value_additionword_left",
                    countId: "#value_additioncount",
                    maxLength: 75
                },
                {
                    id: "#result",
                    displayId: "#display_resultcount",
                    wordLeftId: "#resultword_left",
                    countId: "#resultcount",
                    maxLength: 100
                }
            ];

            sections.forEach(function(section) {
                $(section.id).on('input', function() {
                    var words = this.value.match(/\S+/g).length;
                    if (words > section.maxLength) {
                        var trimmed = $(this).val().split(/\s+/, section.maxLength).join(" ");
                        $(this).val(trimmed + " ");
                    } else {
                        $(section.displayId).text(words);
                        $(section.wordLeftId).text(section.maxLength - words);
                        if (words > 1) {
                            $(section.countId).removeClass('d-none');
                        } else if (words < 1) {
                            $(section.countId).addClass('d-none');
                        } else {
                            $(section.countId).addClass('d-none');
                        }
                    }
                });
            });
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
    @php
        $databaseDatetime = strtotime($theme->close);

        // Calculate time remaining
        $currentDatetime = time();
        $timeRemaining = $databaseDatetime - $currentDatetime;

        // Send the time remaining to the client-side JavaScript
        echo '<script>
            var timeRemaining = ' . $timeRemaining . ';
        </script>';
    @endphp
    <script>
        // Receive the time remaining value from the server-side code
        var timeRemaining = <?php echo $timeRemaining; ?>;

        // Function to update the countdown timer
        function updateCountdown() {
            if (timeRemaining <= 0) {
                // The countdown has expired, you can handle this case here
                if (timeRemaining == 0) {
                    location.reload();
                }
            } else {
                var hours = Math.floor(timeRemaining / 3600);
                var minutes = Math.floor((timeRemaining % 3600) / 60);
                var seconds = timeRemaining % 60;
                var h = hours > 1 ? 'hours ' : 'hour ';
                var hz = hours < 10 ? '0' : '';
                var m = minutes > 1 ? 'minutes ' : 'minute ';
                var mz = minutes < 10 ? '0' : '';
                var s = seconds > 1 ? 'seconds ' : 'second ';
                var sz = seconds < 10 ? '0' : '';
                if (timeRemaining <= 86400) {
                    document.getElementById('countdown').innerHTML = '<p>Time Remain: ' + '<span>' + hz + hours + ' ' +
                        ': ' + '</span>' + '<span>' + mz + minutes + ' ' + ': ' + '</span>' + '<span>' + sz + seconds +
                        '</p>';
                }
                timeRemaining--;
                setTimeout(updateCountdown, 1000); // Update the countdown every second
            }
        }

        // Start the countdown
        updateCountdown();
    </script>
    @include('feature.kill')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
