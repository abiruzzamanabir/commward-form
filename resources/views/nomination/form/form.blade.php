<form action="{{ route('form.store') }}" method="POST" class="was-validated">
    @csrf

    <h5 class="text-center text-uppercase"><span class="text-decoration-underline">Personal Details</span></h5>
    <p class="text-center">This is for billing</p>

    <div class="border p-3 shadow my-3">
        @php
            $personalFields = [
                ['name' => 'name', 'label' => 'Full Name', 'placeholder' => 'Enter your full name', 'type' => 'text'],
                [
                    'name' => 'email',
                    'label' => 'Official Email Address',
                    'placeholder' => 'example@company.com',
                    'type' => 'email',
                ],
                [
                    'name' => 'phone',
                    'label' => 'Official Contact Number',
                    'placeholder' => '+8801XXXXXXXXX',
                    'type' => 'text',
                ],
                [
                    'name' => 'designation',
                    'label' => 'Designation',
                    'placeholder' => 'Your designation or job title',
                    'type' => 'text',
                ],
                [
                    'name' => 'organization',
                    'label' => 'Agency / Organization',
                    'placeholder' => 'Name of your agency or organization',
                    'type' => 'text',
                ],
                [
                    'name' => 'address',
                    'label' => 'Office Address',
                    'placeholder' => 'Your office address',
                    'type' => 'text',
                ],
            ];
        @endphp

        @foreach ($personalFields as $field)
            <div class="mb-2">
                <label class="form-label"><b>{{ $field['label'] }} <span class="text-danger">*</span></b></label>
                <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" class="form-control"
                    placeholder="{{ $field['placeholder'] }}" value="{{ old($field['name']) }}" required>
                <div class="invalid-feedback text-uppercase">Enter Your {{ strtoupper($field['label']) }}</div>
            </div>
            <hr>
        @endforeach
    </div>

    <h5 class="text-center text-uppercase"><span class="text-decoration-underline">Campaign Details</span></h5>

    <div class="border p-3 shadow my-3">
        @php
            $campaignFields = [
                [
                    'name' => 'campaign_name',
                    'label' => 'Campaign Name',
                    'placeholder' => 'Enter your campaign name',
                    'type' => 'text',
                    'required' => true,
                ],
                [
                    'name' => 'agency',
                    'label' => 'Advertising Agency/Organization',
                    'placeholder' => 'Name of advertising agency or organization',
                    'type' => 'text',
                    'required' => true,
                ],
                [
                    'name' => 'production_house',
                    'label' => 'Production House',
                    'placeholder' => 'Name of production house',
                    'type' => 'text',
                    'required' => true,
                ],
                [
                    'name' => 'brand',
                    'label' => 'Brand Name',
                    'placeholder' => 'Name of the brand',
                    'type' => 'text',
                    'required' => true,
                ],
                [
                    'name' => 'type',
                    'label' => 'Type of Product Or Service',
                    'placeholder' => 'Describe the product or service type',
                    'type' => 'text',
                    'required' => true,
                ],
                [
                    'name' => 'date',
                    'label' => 'Campaign Duration (Start Date - End Date)',
                    'placeholder' => 'e.g. 01/01/2025 - 31/01/2025',
                    'type' => 'text',
                    'required' => false,
                ],
            ];
            $categories = [
                'ART DIRECTION',
                'B2B (NEW)',
                'BEST CAMPAIGN BY NEW AGENCY',
                'BEST CREATIVE STRATEGY',
                'BEST UNPUBLISHED WORK (NEW)',
                'BEST USE OF BRANDED CONTENT',
                'BEST USE OF DIGITAL MEDIA',
                'BEST USE OF INFLUENCER',
                'BRAND EXPERIENCE & PROMOTION',
                'CAMPAIGN FOR POSITIVITY (NEW)',
                'CAMPAIGN FOR SUSTAINABILITY',
                'CAMPAIGN FOR WOMEN',
                'COPYWRITING',
                'CREATIVE BUSINESS TRANSFORMATION (NEW)',
                'EFFICACY',
                'FILM',
                'FILM CRAFT',
                'INNOVATION IN MEDIA',
                'INTEGRATED CAMPAIGN',
                'LONG TERM BRAND PLATFORM (NEW)',
                'LUXURY (NEW)',
                'MOST CREATIVE USE OF MEDIA',
                'MOST EFFECTIVE USE OF MEDIA',
                'MUSIC / JINGLE',
                'NATIVE',
                'OUTDOOR',
                'PACKAGING',
                'PR',
                'PRINT & PUBLISHING',
                'RURAL MARKETING',
                'SMALL-BUDGET MEDIA CAMPAIGN',
                'TITANIUM',
            ];
            $costs = [
                'BDT 0 - BDT 49,999',
                'BDT 50,000 - BDT 99,999',
                'BDT 100,000 - BDT 249,999',
                'BDT 250,000 - BDT 499,999',
                'BDT 500,000 - BDT 999,999',
                'BDT 1 Million - BDT 9.9 Million',
                'Over BDT 10 Million',
            ];
        @endphp

        @foreach ($campaignFields as $field)
            <div class="mb-2">
                <label class="form-label"><b>{{ $field['label'] }} @if ($field['required'])
                            <span class="text-danger">*</span>
                        @endif
                    </b></label>
                <input type="{{ $field['type'] }}" name="{{ $field['name'] }}" class="form-control"
                    placeholder="{{ $field['placeholder'] }}" value="{{ old($field['name']) }}"
                    @if ($field['required']) required @endif>
                <div class="invalid-feedback text-uppercase">Enter Your {{ strtoupper($field['label']) }}</div>
                @if ($field['name'] === 'date')
                    <p class="text-danger mt-2" style="font-size:.875em">CAMPAIGN DATE SHOULD MATCH THE NF AND NOC</p>
                @endif
            </div>
            <hr>
        @endforeach

        <div class="mb-2">
            <label class="form-label"><b>Select Your Nomination Category <span class="text-danger">*</span></b></label>
            <select name="category" class="form-select" required>
                <option value="" disabled selected>SELECT NOMINATION CATEGORY *</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @if (old('category') === $category) selected @endif>
                        {{ $category }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback text-uppercase">SELECT YOUR NOMINATION CATEGORY</div>
        </div>
        <hr>

        <div class="mb-2">
            <label class="form-label"><b>Select Your Cost of Campaign <span class="text-danger">*</span></b></label>
            <select name="cost" class="form-select" required>
                <option value="" disabled selected>Select Cost of Campaign *</option>
                @foreach ($costs as $cost)
                    <option value="{{ $cost }}" @if (old('cost') === $cost) selected @endif>
                        {{ $cost }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback text-uppercase">SELECT YOUR CAMPAIGN COST</div>
        </div>
    </div>

    <h5 class="text-center text-uppercase text-decoration-underline">Campaign Story</h5>

    <div class="border p-3 shadow my-3">
        <div class="my-4">
            <label class="form-label">
                Please Share the link containing Nomination Form, PPT, NOC, Case AV, Campaign AV, Creatives, Case Board,
                Insights, and Logo <b><u>(Template & Format provided on the website)</u></b> <span
                    class="text-danger">*</span>
            </label>
            <input type="text" name="link" placeholder="Paste your shared link here" class="form-control"
                value="{{ old('link') }}" required>
        </div>
    </div>

    <h5 class="text-center text-uppercase text-decoration-underline">Team Member</h5>

    <div class="border p-3 shadow my-3">
        <div class="my-4">
            <label class="form-label">
                <b>Please Share the Google Doc link</b> of the detailed information about your Team Members in
                the campaign (Campaign Title, Name & Designation) <span class="text-danger">*</span>
            </label>
            <input type="text" name="member_name" placeholder="Paste Google Doc link here" class="form-control"
                value="{{ old('member_name') }}" required>
        </div>
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary" style="width: 120px;">Submit</button>
        </div>
    </div>
</form>
