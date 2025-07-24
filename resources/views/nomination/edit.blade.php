<div class="card-body">
    @include('validate')
    <form action="{{ route('form.updateinfo', $edit->id) }}" method="POST"
        class="was-validated">
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
                                                value="{{ $edit->name }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Full Name</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationEmail" class="form-label">
                                                <b>Email <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $edit->email }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Email</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Contact Number <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $edit->phone }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Contact Number</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationName" class="form-label">
                                                <b>Designation <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="designation" class="form-control"
                                                value="{{ $edit->designation }}" required>
                                            <div class="invalid-feedback text-uppercase">Designation of the Nominator
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Organization <span class="text-danger">*</span></b>
                                            </label>
                                            <input list="organisations" type="text" name="organization"
                                                class="form-control" value="{{ $edit->organization }}" required>
                                            <datalist id="organisations">
                                                @foreach ($invoices as $invoice)
                                                    <option value="{{ $invoice->name }}">
                                                @endforeach
                                            </datalist>
                                            <div class="invalid-feedback text-uppercase">Enter Your Organization Name
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Address <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ $edit->address }}" required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Address</div>
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

                                        
                                    </div>

                                        <h5 class="text-center text-uppercase"><span class="text-decoration-underline">HR Contact Details</span> <span class="text-danger">(Optional)</span></h5>

                                    <div class="border p-3 shadow my-3">
                                        <div class="mb-2">
                                            <label for="validationName" class="form-label">
                                                <b>Full Name</b>
                                            </label>
                                            <input type="text" name="alternative_name" class="form-control"
                                                value="{{ $edit->alternative_name }}">
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
                                                <b>Email</b>
                                            </label>
                                            <input type="email" name="alternative_email" class="form-control"
                                                value="{{ $edit->alternative_email }}">
                                            <div class="invalid-feedback text-uppercase">Enter Your Alternative Email</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Contact Number</b>
                                            </label>
                                            <input type="text" name="alternative_phone" class="form-control"
                                                value="{{ $edit->alternative_phone }}">
                                            <div class="invalid-feedback text-uppercase">Enter Your Alternative Contact Number
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <u>
                                        <h5 class="text-center text-uppercase">Information about the Nomination</h5>
                                    </u>
                                    <p class="text-center text-muted">Please fill up the following information</p>
                                    <div class="border p-3 shadow my-3">
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Select Your Nomination Category <span
                                                        class="text-danger">*</span></b>
                                            </label>
                                            <select name="category" class="form-select">
                                                <option value="">Select Nomination Category *</option>
                                                <option @if ($edit->category == 'Aspiring Women Leader') selected @endif value="Aspiring Women Leader">Aspiring Women Leader</option>
                                                <option @if ($edit->category == 'Progressive Women Leaders') selected @endif value="Progressive Women Leaders">Progressive Women Leaders</option>
                                                <option @if ($edit->category == 'Inspiring Women Leader') selected @endif value="Inspiring Women Leader">Inspiring Women Leader</option>
                                                <option @if ($edit->category == 'Leaders of Tomorrow') selected @endif value="Leaders of Tomorrow">Leaders of Tomorrow</option>
                                                <option @if ($edit->category == 'Inspiring Women Entrepreneur') selected @endif value="Inspiring Women Entrepreneur">Inspiring Women Entrepreneur</option>
                                                <option @if ($edit->category == 'Inspiring Women Entrepreneur (Social)') selected @endif value="Inspiring Women Entrepreneur (Social)">Inspiring Women Entrepreneur (Social)</option>
                                                <option @if ($edit->category == 'Inspiring Women Entrepreneur (Tech)') selected @endif value="Inspiring Women Entrepreneur (Tech)">Inspiring Women Entrepreneur (Tech)</option>
                                                <option @if ($edit->category == 'Inspiring Female Start-Up') selected @endif value="Inspiring Female Start-Up">Inspiring Female Start-Up</option>
                                                <option @if ($edit->category == 'Inspiring Women Leader (Development)') selected @endif value="Inspiring Women Leader (Development)">Inspiring Women Leader (Development)</option>
                                                <option @if ($edit->category == 'Inspiring Women Leader (IT)') selected @endif value="Inspiring Women Leader (IT)">Inspiring Women Leader (IT)</option>
                                                <option @if ($edit->category == 'Best Initiatives Taken for Female') selected @endif value="Best Initiatives Taken for Female">Best Initiatives Taken for Female</option>
                                            </select>
                                            <div class="invalid-feedback text-uppercase">SELECT YOUR INNOVATION
                                                CATEGORY</div>
                                        </div>
                                        <div class="my-4">
                                            <label for="validationPhone" class="form-label"><b>Supporting Documents
                                                    Google Drive Link <span
                                                    class="text-danger">*</span></b></label>
                                            <textarea name="link" class="form-control" cols="10" rows="3"
                                                placeholder="Paste the Google Drive Link Here. (Upload the necessary materials in a folder and share the link here. The contents must include: PPT, Visuals, NOC, Case AV and any other supporting documents)" value="{{ $edit->link }}" required>{{$edit->link}}</textarea>
                                            <p class="text-danger mt-1">Disclaimer: Without proper supporting documents
                                                nomination will be disqualified.</p>
                                        </div>
                                        <div class="mt-2 text-center">
                                            <button style="width: 120px;" type="submit"
                                                class="btn btn-primary">Submit</button>
                                        </div>
    </form>
</div>
