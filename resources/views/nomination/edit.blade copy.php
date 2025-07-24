<div class="card-body">
    @include('validate')
    <form action="{{ route('form.updateinfo', $edit->id) }}" method="POST"
        class="was-validated">
        @csrf
        <u>
            <h5 class="text-center text-uppercase">Personal Details</h5>
        </u>
        <div class="border p-3 shadow my-3">
            <div class="mb-2">
                <label for="validationName" class="form-label">
                    <b>Full Name <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="name" class="form-control"
                    value="{{ $edit->name }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Full Name</div>
            </div>
            <div class="mb-2">
                <label for="validationName" class="form-label">
                    <b>Designation <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="designation" class="form-control"
                    value="{{ $edit->designation }}" required>
                <div class="invalid-feedback text-uppercase">Designation of the Nominator</div>
            </div>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Agency / Organization <span class="text-danger">*</span></b>
                </label>
                <input list="organisations" autocomplete="off" autofill="off" type="text"
                    name="organization" class="form-control"
                    value="{{ $edit->organization }}" required>
                <datalist id="organisations">
                    @foreach ($invoices as $invoice)
                        <option value="{{ $invoice->name }}">
                    @endforeach
                </datalist>
                <div class="invalid-feedback text-uppercase">Enter Your Agency / Organization
                    Name</div>
            </div>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Office Address <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="address" class="form-control"
                    value="{{ $edit->address }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Office Address</div>
            </div>
            <div class="mb-2">
                <label for="validationEmail" class="form-label">
                    <b>Email <span class="text-danger">*</span></b>
                </label>
                <input type="email" name="email" class="form-control"
                    value="{{ $edit->email }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Agency / Organization
                    Email</div>
            </div>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Contact Number <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="phone" class="form-control"
                    value="{{ $edit->phone }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Contact Number</div>
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
            <h5 class="text-center">Campaign Details</h5>
        </u>
        <p class="text-center text-muted">Basic information about your campaign</p>
        <div class="border p-3 shadow my-3">

            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Campaign Name <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="title" class="form-control"
                    value="{{ $edit->title }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your Campaign Name</div>
            </div>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Select Your Campaign Category <span class="text-danger">*</span></b>
                </label>
                <select name="category" class="form-select">
                    <option value="">Select Campaign Category</option>
                    <option @if ($edit->category == 'Best App Marketing') selected @endif
                        value="Best App Marketing">Best App Marketing</option>
                    <option @if ($edit->category == 'Best Content Marketing') selected @endif
                        value="Best Content Marketing">Best Content Marketing </option>
                    <option @if ($edit->category == 'Best Digital Campaign by New Agency') selected @endif
                        value="Best Digital Campaign by New Agency">Best Digital Campaign
                        by New Agency</option>
                    <option @if ($edit->category == 'Best Digital Experience Marketing') selected @endif
                        value="Best Digital Experience Marketing">Best Digital Experience
                        Marketing</option>
                    <option @if ($edit->category == 'Best Digital Marketing for OTT Platform') selected @endif
                        value="Best Digital Marketing for OTT Platform">Best Digital
                        Marketing for OTT Platform (NEW)</option>
                    <option @if ($edit->category == 'Best Digital Performance Marketing') selected @endif
                        value="Best Digital Performance Marketing">Best Digital Performance
                        Marketing (NEW)</option>
                    <option @if ($edit->category == 'Best Digital Marketing in E-commerce') selected @endif
                        value="Best Digital Marketing in E-commerce">Best Digital Marketing
                        in E-commerce</option>
                    <option @if ($edit->category == 'Best Integrated Digital Campaign') selected @endif
                        value="Best Integrated Digital Campaign">Best Integrated Digital
                        Campaign</option>
                    <option @if ($edit->category == 'Best Digital Campaign For Sustainability') selected @endif
                        value="Best Digital Campaign For Sustainability">Best Digital
                        Campaign For Sustainability</option>
                    <option @if ($edit->category == 'Best UGC') selected @endif
                        value="Best UGC">Best UGC</option>
                    <option @if ($edit->category == 'Best Use of Data & Analytics') selected @endif
                        value="Best Use of Data & Analytics">Best Use of Data & Analytics
                    </option>
                    <option @if ($edit->category == 'Best Use of Display') selected @endif
                        value="Best Use of Display">Best Use of Display</option>
                    <option @if ($edit->category == 'Best Use of Facebook') selected @endif
                        value="Best Use of Facebook">Best Use of Facebook</option>
                    <option @if ($edit->category == 'Best Use of Influencer') selected @endif
                        value="Best Use of Influencer">Best Use of Influencer</option>
                    <option @if ($edit->category == 'Best Use of Instagram') selected @endif
                        value="Best Use of Instagram">Best Use of Instagram</option>
                    <option @if ($edit->category == 'Best Use of Mobile') selected @endif
                        value="Best Use of Mobile">Best Use of Mobile</option>
                    <option @if ($edit->category == 'Best Use of PR in Digital Platform') selected @endif
                        value="Best Use of PR in Digital Platform">Best Use of PR in
                        Digital Platform</option>
                    <option @if ($edit->category == 'Best Use of Search') selected @endif
                        value="Best Use of Search">Best Use of Search</option>
                    <option @if ($edit->category == 'Best Use of TikTok') selected @endif
                        value="Best Use of TikTok">Best Use of TikTok</option>
                    <option @if ($edit->category == 'Best Use of Under 10 Seconds Video') selected @endif
                        value="Best Use of Under 10 Seconds Video">Best Use of Under 10
                        Seconds Video</option>
                    <option @if ($edit->category == 'Best Use of User Community Platform/ New Platforms/ Own Platforms') selected @endif
                        value="Best Use of User Community Platform/ New Platforms/ Own Platforms">
                        Best Use of User Community Platform/ New Platforms/ Own Platforms
                    </option>
                    <option @if ($edit->category == 'Best Use of YouTube') selected @endif
                        value="Best Use of YouTube">Best Use of YouTube</option>
                    <option @if ($edit->category == 'Best Video') selected @endif
                        value="Best Video">Best Video</option>
                    <option @if ($edit->category == 'Titanium') selected @endif
                        value="Titanium">Titanium (NEW)</option>
                </select>
                <div class="invalid-feedback text-uppercase">SELECT YOUR NOMINATION CATEGORY
                </div>
            </div>

            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Agency / Organization Name <span class="text-danger">*</span></b>
                </label>
                <input list="organisations" autocomplete="off" autofill="off" type="text"
                    name="organization_name" class="form-control"
                    value="{{ $edit->organization_name }}" required>
                <datalist id="organisations">
                    @foreach ($invoices as $invoice)
                        <option value="{{ $invoice->name }}">
                    @endforeach
                </datalist>
                <div class="invalid-feedback text-uppercase">Enter Your Agency / Organization
                    Name</div>
            </div>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Production House <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="production_house" class="form-control"
                    value="{{ $edit->production_house }}" required>
                <div class="invalid-feedback text-uppercase">Enter The Production House Name
                </div>
            </div>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Brand Name <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="brand" class="form-control"
                    value="{{ $edit->brand }}" required>
                <div class="invalid-feedback text-uppercase">Enter The Brand Name</div>
            </div>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Type of Product or Service <span class="text-danger">*</span></b>
                </label>
                <input type="text" name="type" class="form-control"
                    value="{{ $edit->type }}" required>
                <div class="invalid-feedback text-uppercase">Enter The Type Of Product Or
                    Service</div>
            </div>
            <div class="mb-2">
                <label for="validationPhone" class="form-label">
                    <b>Campaign Duration</b>
                </label>
                <input type="text" id="daterange" name="date" class="form-control"
                    value="{{ $edit->date }}">
                <div class="invalid-feedback text-uppercase">Enter Your Type of Fintech
                    Innovation</div>
                <p class="text-danger mt-2" style="font-size:.875em">CAMPAIGN DATE SHOULD
                    MATCH THE NF AND NOC</p>
            </div>

        </div>
        <u>
            <h5 class="text-center">Campaign Story</h5>
        </u>
        <p class="text-center text-muted">Please fill up the following information</p>

        <div class="border p-3 shadow my-3">
            <div class="my-4">
                <label for="validationPhone" class="form-label">
                    Please Share the link containing Nomination Form, PPT, NOC, Case AV,
                    Campaign AV, Creatives, Insights, and Logo <b><u>(Template & Format provided
                            on the website)</u></b><span class="text-danger">*</span><br>
                    <span class="text-danger">
                        Please Share the link containing the Nomination Form, PPT, NOC, Case AV,
                        Campaign AV, Creatives, Insights, and Logo
                    </span>
                </label>
                <input type="text" name="link" placeholder="Share link here"
                    class="form-control" value="{{ $edit->link }}" required>
                <!--    <div class="invalid-feedback text-uppercase">Share link here</div>-->
            </div>
        </div>
        @if ($edit->payment != 2)
            <u>
                <h5 class="text-center">Invoice</h5>
            </u>
            <div class="border p-3 shadow my-3">
                <div class="my-4">
                    <label for="validationPhone" class="form-label">
                        Invoice
                    </label>
                    <input list="invoice" autocomplete="off" autofill="off" type="text"
                        name="invoice" placeholder="Enter Invoice Number"
                        class="form-control" value="{{ $edit->invoice }}">
                    <datalist id="invoice">
                        @foreach ($invoices as $invoice)
                            <option value="{{ $invoice->invoice }}">{{ $invoice->name }} |
                                {{ $invoice->invoice }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
        @endif
        <div class="mt-2 text-center">
            <button style="width: 120px;" type="submit"
                class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
