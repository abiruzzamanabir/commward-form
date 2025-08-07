@php
use App\Models\Theme;
$theme = Theme::findOrFail(1);

use Carbon\Carbon;
$time = Carbon::parse($theme->close);
$close = $time;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nomination Form | {{ $theme->title }}</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/sweetalert2.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <style>
        body {
            background-color: #f2f2f2;
            background-image: url("{{ asset('assets/img/' . $theme->background) }}");
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

        .session-info {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background-color: #f2f2f2;
            padding: 5px 10px 0px;
            color: black;
            border-radius: 10px;
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
                    <!-- <div class="time py-1" id="countdown"></div> -->
                    @if (Carbon::now() <= $close)
                        <div class="session-info shadow-sm">
                        <h1 id="sessionTime"></h1>
                        <!-- <p id="warningTime"></p> -->
                </div>
                @endif
            </div>
            <div class="card shadow">
                @if ($form_type == 'store')
                @if (Carbon::now() <= $close) <div class="card-body">
                    @include('validate')
                    <form action="{{ route('form.store') }}" method="POST" class="was-validated">
                        @csrf
                        <h5 class="text-center text-uppercase"><span class="text-decoration-underline">Personal Details</span></h5>
                        <p class="text-center">This is for billing</p>
                        <div class="border p-3 shadow my-3">
                            <div class="mb-2">
                                <label for="validationName" class="form-label">
                                    <b>Full Name <span class="text-danger">*</span></b>
                                </label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                <div class="invalid-feedback text-uppercase">Enter Your Full Name</div>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <label for="validationEmail" class="form-label">
                                    <b>Official Email Address<span class="text-danger">*</span></b>
                                </label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                <div class="invalid-feedback text-uppercase">Enter Your Official Email</div>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <label for="validationPhone" class="form-label">
                                    <b>Official Contact Number<span class="text-danger">*</span></b>
                                </label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                <div class="invalid-feedback text-uppercase">Enter Your Official Contact Number</div>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <label for="validationName" class="form-label">
                                    <b>Designation <span class="text-danger">*</span></b>
                                </label>
                                <input type="text" name="designation" class="form-control" value="{{ old('designation') }}" required>
                                <div class="invalid-feedback text-uppercase">Enter Your Designation</div>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <label for="validationPhone" class="form-label">
                                    <b>Agency / Organization <span class="text-danger">*</span></b>
                                </label>
                                <input type="text" name="organization" class="form-control" value="{{ old('organization') }}" required>
                                <div class="invalid-feedback text-uppercase">Enter Your Agency / Organization Name
                                </div>
                            </div>
                            <hr>
                            <div class="mb-2">
                                <label for="validationPhone" class="form-label">
                                    <b>Office Address <span class="text-danger">*</span></b>
                                </label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                                <div class="invalid-feedback text-uppercase">Enter Your Office Address</div>
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

        <h5 class="text-center text-uppercase"><span class="text-decoration-underline">Campaign Details</span></h5>

        <div class="border p-3 shadow my-3">
            <div class="mb-2">
                <label for="validationName" class="form-label">
                    <b>Campaign Name <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="campaign_name" class="form-control" value="{{ old('campaign_name') }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Campaign NAME</div>
            </div>
            <hr>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Select Your Nomination Category <span class="text-danger">*</span></b>
                </label>
                <select name="category" class="form-select">
                    <option value="">SELECT NOMINATION CATEGORY *</option>
                    <option value="BEST APP MARKETING">BEST APP MARKETING</option>
                    <option value="BEST CONTENT MARKETING">BEST CONTENT MARKETING</option>
                    <option value="BEST DIGITAL CAMPAIGN BY NEW AGENCY">BEST DIGITAL CAMPAIGN BY NEW AGENCY</option>
                    <option value="BEST DIGITAL CAMPAIGN FOR SUSTAINABILITY">BEST DIGITAL CAMPAIGN FOR SUSTAINABILITY</option>
                    <option value="BEST DIGITAL EXPERIENCE MARKETING">BEST DIGITAL EXPERIENCE MARKETING</option>
                    <option value="BEST DIGITAL MARKETING FOR OTT PLATFORM">BEST DIGITAL MARKETING FOR OTT PLATFORM</option>
                    <option value="BEST DIGITAL PERFORMANCE MARKETING">BEST DIGITAL PERFORMANCE MARKETING</option>
                    <option value="BEST E-COMMERCE PLATFORM">BEST E-COMMERCE PLATFORM</option>
                    <option value="BEST INTEGRATED DIGITAL CAMPAIGN">BEST INTEGRATED DIGITAL CAMPAIGN</option>
                    <option value="BEST UGC">BEST UGC</option>
                    <option value="BEST USE OF DATA & ANALYTICS">BEST USE OF DATA & ANALYTICS</option>
                    <option value="BEST USE OF DISPLAY">BEST USE OF DISPLAY</option>
                    <option value="BEST USE OF FACEBOOK">BEST USE OF FACEBOOK</option>
                    <option value="BEST USE OF INFLUENCER">BEST USE OF INFLUENCER</option>
                    <option value="BEST USE OF INSTAGRAM">BEST USE OF INSTAGRAM</option>
                    <option value="BEST USE OF MOBILE">BEST USE OF MOBILE</option>
                    <option value="BEST USE OF PR IN DIGITAL PLATFORM">BEST USE OF PR IN DIGITAL PLATFORM</option>
                    <option value="BEST USE OF SEARCH">BEST USE OF SEARCH</option>
                    <option value="BEST USE OF TIKTOK">BEST USE OF TIKTOK</option>
                    <option value="BEST USE OF UNDER 10 SECONDS VIDEO">BEST USE OF UNDER 10 SECONDS VIDEO</option>
                    <option value="BEST USE OF USER COMMUNITY PLATFORM/ NEW PLATFORMS/ OWN PLATFORMS">BEST USE OF USER COMMUNITY PLATFORM/ NEW PLATFORMS/ OWN PLATFORMS</option>
                    <option value="BEST USE OF YOUTUBE">BEST USE OF YOUTUBE</option>
                    <option value="BEST VIDEO">BEST VIDEO</option>
                    <option value="TITANIUM">TITANIUM</option>
                </select>



                <div class="invalid-feedback text-uppercase">SELECT YOUR NOMINATION
                    CATEGORY</div>
            </div>
            <hr>
            <div class="mb-2">
                <label for="validationName" class="form-label">
                    <b>Advertising Agency/Organization <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="agency" class="form-control" value="{{ old('agency') }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Advertising Agency/Organization
                </div>
            </div>
            <hr>
            <div class="mb-2">
                <label for="validationName" class="form-label">
                    <b>Production House <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="production_house" class="form-control" value="{{ old('production_house') }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Production house
                </div>
            </div>
            <hr>
            <div class="mb-2">
                <label for="validationName" class="form-label">
                    <b>Brand Name <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your brand name</div>
            </div>
            <hr>
            <div class="mb-2">
                <label for="validationName" class="form-label">
                    <b>Type of Product Or Service <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="type" class="form-control" value="{{ old('type') }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Type of Product Or
                    Service</div>
            </div>
            <hr>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Campaign Duration (Start Date - End Date)</b>
                </label>
                <input type="text" id="daterange" name="date" class="form-control" value="{{ old('date') }}">
                <div class="invalid-feedback text-uppercase">Enter Your Campaign Duration
                </div>
                <p class="text-danger mt-2" style="font-size:.875em">CAMPAIGN DATE SHOULD
                    MATCH THE NF AND NOC</p>
            </div>
            <hr>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Select Your Cost of Campaign <span class="text-danger">*</span></b>
                </label>
                <select name="cost" class="form-select">
                    <option value="">Select Cost of Campaign *</option>
                    <option value="BDT 0 - BDT 49,999">BDT 0 - BDT 49,999</option>
                    <option value="BDT 50,000 - BDT 99,999">BDT 50,000 - BDT 99,999
                    </option>
                    <option value="BDT 100,000 - BDT 249,999">BDT 100,000 - BDT 249,999
                    </option>
                    <option value="BDT 250,000 - BDT 499,999">BDT 250,000 - BDT 499,999
                    </option>
                    <option value="BDT 500,000 - BDT 999,999">BDT 500,000 - BDT 999,999
                    </option>
                    <option value="BDT 1 Million - BDT 9.9 Million">BDT 1 Million - BDT 9.9
                        Million</option>
                    <option value="Over BDT 10 Million">Over BDT 10 Million</option>
                </select>
                <div class="invalid-feedback text-uppercase">SELECT YOUR Campaign Cost
                </div>
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
    <u>
        <h5 class="text-center text-uppercase">Campaign Story</h5>
    </u>
    <!--<p class="text-center text-muted">Detail Information About Your Campaign</p>-->
    <div class="border p-3 shadow my-3">


        <!--<div class="mb-2">-->
        <!--    <label for="validationBackground" class="form-label">-->
        <!--        <b>BACKGROUND <span class="text-danger">*</span></b> --->
        <!--        <span class="text-danger">(Not more than 150 words)</span>-->
        <!--    </label>-->
        <!--    <p id="backgroundcount" class="text-left text-center mb-1 d-none count">-->
        <!--        Word Count: <span id="display_backgroundcount">0</span> |-->
        <!--        Words left: <span id="backgroundword_left">150</span>-->
        <!--    </p>-->
        <!--    <textarea name="background" id="background" class="form-control" cols="10"-->
        <!--        rows="3" required>{{ old('background') }}</textarea>-->
        <!--    <div class="invalid-feedback">Enter Your Background of the Nomination</div>-->
        <!--</div>-->

        <!--<div class="mb-2">-->
        <!--    <label for="validationObjectives" class="form-label">-->
        <!--        <b>OBJECTIVES <span class="text-danger">*</span></b> --->
        <!--        <span class="text-danger">(Not more than 50 words)</span>-->
        <!--    </label>-->
        <!--    <p id="objectivescount" class="text-left text-center mb-1 d-none count">-->
        <!--        Word Count: <span id="display_objectivescount">0</span> |-->
        <!--        Words left: <span id="objectivesword_left">50</span>-->
        <!--    </p>-->
        <!--    <textarea name="objectives" id="objectives" class="form-control" cols="10"-->
        <!--        rows="3" required>{{ old('objectives') }}</textarea>-->
        <!--    <div class="invalid-feedback">Enter Your Objectives of the Nomination</div>-->
        <!--</div>-->

        <!--<div class="mb-2">-->
        <!--    <label for="validationCoreIdea" class="form-label">-->
        <!--        <b>CORE IDEA <span class="text-danger">*</span></b> --->
        <!--        <span class="text-danger">(Not more than 100 words)</span>-->
        <!--    </label>-->
        <!--    <p id="coreideacount" class="text-left text-center mb-1 d-none count">-->
        <!--        Word Count: <span id="display_coreideacount">0</span> |-->
        <!--        Words left: <span id="coreideaword_left">100</span>-->
        <!--    </p>-->
        <!--    <textarea name="core_idea" id="core_idea" class="form-control" cols="10"-->
        <!--        rows="3" required>{{ old('core_idea') }}</textarea>-->
        <!--    <div class="invalid-feedback">Enter Your Core Idea of the Nomination</div>-->
        <!--</div>-->

        <!--<div class="mb-2">-->
        <!--    <label for="validationExecution" class="form-label">-->
        <!--        <b>EXECUTION <span class="text-danger">*</span></b> --->
        <!--        <span class="text-danger">(Not more than 150 words)</span>-->
        <!--    </label>-->
        <!--    <p id="executioncount" class="text-left text-center mb-1 d-none count">-->
        <!--        Word Count: <span id="display_executioncount">0</span> |-->
        <!--        Words left: <span id="executionword_left">150</span>-->
        <!--    </p>-->
        <!--    <textarea name="execution" id="execution" class="form-control" cols="10"-->
        <!--        rows="3" required>{{ old('execution') }}</textarea>-->
        <!--    <div class="invalid-feedback">Enter Your Execution of the Nomination</div>-->
        <!--</div>-->

        <!--<div class="mb-2">-->
        <!--    <label for="validationResult" class="form-label">-->
        <!--        <b>RESULT <span class="text-danger">*</span></b> --->
        <!--        <span class="text-danger">(Not more than 150 words)</span>-->
        <!--    </label>-->
        <!--    <p id="resultcount" class="text-left text-center mb-1 d-none count">-->
        <!--        Word Count: <span id="display_resultcount">0</span> |-->
        <!--        Words left: <span id="resultword_left">150</span>-->
        <!--    </p>-->
        <!--    <textarea name="result" id="result" class="form-control" cols="10"-->
        <!--        rows="3" required>{{ old('result') }}</textarea>-->
        <!--    <div class="invalid-feedback">Enter Your Result of the Nomination</div>-->
        <!--</div>-->


        <div class="my-4">
            <label for="validationPhone" class="form-label">
                Please Share the link containing Nomination Form, PPT, NOC, Case AV,
                Campaign AV, Creatives, Case Board, Insights, and Logo <b><u>(Template & Format
                        provided on the website)</u></b><span class="text-danger">*</span>
            </label>
            <input type="text" name="link" placeholder="Share link here" class="form-control" value="{{ old('link') }}" required>
            <!--    <div class="invalid-feedback text-uppercase">Share link here</div>-->
            <!--</div>-->
        </div>
    </div>
    <u>
        <h5 class="text-center text-uppercase">Team Member</h5>
    </u>
    <!--<p class="text-center text-muted">Detail Information About Your Team Member</p>-->
    <div class="border p-3 shadow my-3">
        <div class="my-4">
            <div class="form-group order member-btn-opt">
                <div class="my-4">
                    <label for="validationPhone" class="form-label">
                        <b>Please Share the Google Doc link</b> of the detailed information about your Team Members in the campaign (Campaign Title, Name & Designation)</u></b><span class="text-danger">*</span>
                    </label>
                    <input type="text" name="member_name" placeholder="Share link here" class="form-control" value="{{ old('member_name') }}" required>
                    <!--    <div class="invalid-feedback text-uppercase">Share link here</div>-->
                    <!--</div>-->
                </div>
            </div>
            <div class="mt-2 text-center">
                <button style="width: 120px;" type="submit" class="btn btn-primary">Submit</button>
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

    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let btn_no = $(".member-btn-opt-area .btn-section").length + 1;

            // Add new member button
            $("#add-new-member-button").click(function(e) {
                e.preventDefault();

                $(".member-btn-opt-area").append(`
                <div class="btn-section">
                    <div class="d-flex justify-content-between">
                        <b>Member ${btn_no}</b>
                        <span style="cursor: pointer" class="bg-danger px-2 py-1 rounded text-white remove-btn">Remove <i class="fas fa-times"></i></span>
                    </div>
                    <input name="member_name[]" required class="form-control my-3" type="text" placeholder="Team Member Name">
                    <input name="member_designation[]" required class="form-control my-3" type="text" placeholder="Team Member Designation">
                </div>
            `);
                btn_no++;
            });

            // Remove member button
            $(document).on("click", ".remove-btn", function() {
                $(this).closest(".btn-section").remove();
                $(".member-btn-opt-area .btn-section").each(function(index) {
                    $(this).find("b:first-child").text(`Member ${index + 1}`);
                });
                btn_no = $(".member-btn-opt-area .btn-section").length + 1;
            });

            // Define the sections with max length
            var sections = [{
                    id: "#background",
                    displayId: "#display_backgroundcount",
                    wordLeftId: "#backgroundword_left",
                    countId: "#backgroundcount",
                    maxLength: 150
                },
                {
                    id: "#objectives",
                    displayId: "#display_objectivescount",
                    wordLeftId: "#objectivesword_left",
                    countId: "#objectivescount",
                    maxLength: 50
                },
                {
                    id: "#core_idea",
                    displayId: "#display_coreideacount",
                    wordLeftId: "#coreideaword_left",
                    countId: "#coreideacount",
                    maxLength: 100
                },
                {
                    id: "#execution",
                    displayId: "#display_executioncount",
                    wordLeftId: "#executionword_left",
                    countId: "#executioncount",
                    maxLength: 150
                },
                {
                    id: "#result",
                    displayId: "#display_resultcount",
                    wordLeftId: "#resultword_left",
                    countId: "#resultcount",
                    maxLength: 150
                }
            ];

            // Monitor input events for each section
            sections.forEach(function(section) {
                $(section.id).on('input', function() {
                    var words = this.value.match(/\S+/g)?.length || 0; // Handle empty input

                    // If word limit exceeded, trim the text and show SweetAlert
                    if (words > section.maxLength) {
                        var trimmed = $(this).val().split(/\s+/, section.maxLength).join(" ");
                        $(this).val(trimmed + " ");
                        // Show SweetAlert when word limit is exceeded
                        Swal.fire({
                            icon: 'warning',
                            title: 'Word Limit Exceeded!',
                            text: `You can only enter a maximum of ${section.maxLength} words.`
                        });
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

            // Hide alert after 3 seconds
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 3000);
        });
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
                    document.getElementById('countdown').innerHTML = '<p>Time Remaining: ' + '<span>' + hz + hours + ' ' +
                        ': ' + '</span>' + '<span>' + mz + minutes + ' ' + ': ' + '</span>' + '<span>' + sz + seconds +
                        ' Until This Form Closes.</p>';
                }
                timeRemaining--;
                setTimeout(updateCountdown, 1000); // Update the countdown every second
            }
        }

        // Start the countdown
        updateCountdown();
    </script>
    <script>
        $(function() {
            var dateRangePicker = $('input[name="date"]').daterangepicker({
                opens: 'left',
                startDate: moment('11/01/2023'),
                endDate: moment('10/31/2024'),
                minDate: moment('11/01/2023'),
                maxDate: moment('10/31/2024')
            });

            dateRangePicker.on('apply.daterangepicker', function(ev, picker) {
                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');
                console.log("A new date selection was made: " + startDate + ' to ' + endDate);
            });
        });
    </script>
    @if (Carbon::now() <= $close)
        <script>
        // Function to initialize the session timeout countdown
        function startSessionTimeout() {
        var timeoutMinutes = {{ config('session.lifetime', 30) }}-5; // Example: Replace with your actual session timeout in minutes
        var timeoutSeconds = timeoutMinutes * 60;
        var warningTime = timeoutSeconds - 300; // 60 seconds before timeout

        // Function to format seconds into minutes:seconds format
        function formatTime(seconds) {
        var min = Math.floor(seconds / 60);
        var sec = seconds % 60;
        return min + ':' + (sec < 10 ? '0' : '' ) + sec;
            }

            // Function to update HTML elements
            function updateTimes() {
            document.getElementById('sessionTime').innerHTML='<span>' + formatTime(timeoutSeconds) + '</span>' ;
            // document.getElementById('warningTime').innerHTML='<span>' + formatTime(warningTime) + '</span>' ;
            }

            // Initial update
            updateTimes();

            // Show initial warning
            Swal.fire({
            icon: 'warning' ,
            title: 'Warning' ,
            text: 'Your time is set to ' + timeoutMinutes + ' minutes. Please fill and submit within ' + timeoutMinutes + ' minutes.' ,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: 'OK'
            }).then((result)=> {
            if (result.isConfirmed) {
            // Reset countdown and start
            var intervalId = setInterval(function() {
            timeoutSeconds--;
            warningTime--;
            updateTimes();

            // Check if warning time is reached
            if (warningTime === 0) {
            Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Your session is about to expire in 5 minutes. Please finalize and submit your work promptly.',
            timer: 10000, // Close alert after 10 seconds
            timerProgressBar: true,
            allowOutsideClick: false,
            allowEscapeKey: false
            });
            }

            // Check if session has expired
            if (timeoutSeconds <= 0) {
                clearInterval(intervalId); // Stop updating
                Swal.fire({
                icon: 'error' ,
                title: 'Timeout' ,
                text: 'Your session has timed out.' ,
                showConfirmButton: false,
                timer: 5000, // Close alert after 5 seconds
                timerProgressBar: true,
                willClose: ()=> {
                // Reload the page after the alert is closed
                window.location.reload();
                }
                });
                }
                }, 1000); // 1000 milliseconds = 1 second
                }
                });
                }

                // Start the session timeout countdown when the page is loaded
                startSessionTimeout();
                </script>
                @endif




                @include('feature.kill')
                <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
