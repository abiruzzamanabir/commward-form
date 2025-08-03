@php
    // Prefetch order details indexed by transaction_id for all nominations
    $orderDetailsMap = DB::table('orders')
        ->whereIn('transaction_id', $all_nomination->pluck('ukey'))
        ->select('transaction_id', 'status', 'currency', 'amount', 'card_issuer')
        ->orderByDesc('id')
        ->get()
        ->groupBy('transaction_id')
        ->map(fn($items) => $items->first());
@endphp

<table id="dashboard" class="table table-striped table-bordered table-hover align-middle text-center">
    <thead class="table-info sticky-top">
        <tr>
            <th>#</th>
            <th>Submitted On</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Designation</th>
            <th>Organization</th>
            <th>Address</th>
            <th>Campaign Name</th>
            <th>Category</th>
            <th>Agency</th>
            <th>Production House</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Campaign Date</th>
            <th>Cost</th>
            <th>Link</th>
            <th>Members Link</th>
            <th>Comment</th>
            <th>Payment Method</th>
            @if ($page == 'pv')
                <th>Confirmation</th>
            @endif
            @if (in_array($page, ['dashboard', 'trash']))
                <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($all_nomination as $index => $item)
            @php
                $order = $orderDetailsMap[$item->ukey] ?? null;
            @endphp
            <tr @if (!empty($item->comment)) style="background:#fadbd8" @endif>
                <th scope="row" style="cursor:pointer;" onclick="copyUserId('{{ $item->ukey }}')"
                    title="Copy user key">{{ $loop->iteration }}</th>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('l, F j, Y, g:i A') }}</td>
                <td class="text-capitalize">{{ $item->name }}</td>
                <td style="cursor:pointer;" onclick="copyUserEmail('{{ $item->email }}')" title="Copy email">
                    {{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->designation }}</td>
                <td>{{ $item->organization }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->campaign_name }}</td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->agency }}</td>
                <td>{{ $item->production_house }}</td>
                <td>{{ $item->brand }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ $item->cost }}</td>
                <td class="text-truncate" style="max-width:150px;">
                    <a href="{{ $item->link }}" target="_blank" class="text-decoration-none"
                        title="{{ $item->link }}">{{ Str::limit($item->link, 30) }}</a>
                </td>
                <td class="text-truncate" style="max-width:150px;">
                    @if ($item->members_link)
                        <a href="{{ $item->members_link }}" target="_blank" class="text-decoration-none"
                            title="{{ $item->members_link }}">{{ Str::limit($item->members_link, 30) }}</a>
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </td>
                <td class="p-2" style="min-width:200px;">
                    <form action="{{ route('dashboard.update', $item->id) }}" method="POST" class="mb-0">
                        @csrf @method('PUT')
                        <textarea name="comment" rows="3" class="form-control form-control-sm" placeholder="Enter Your Comment...">{{ $item->comment }}</textarea>
                        <div class="mt-1 d-flex gap-2 justify-content-end">
                            <button type="submit" class="btn btn-info btn-sm" title="Save"><i
                                    class="fa fa-check"></i></button>
                            <a href="{{ route('comment.empty', $item->id) }}" class="btn btn-secondary btn-sm"
                                title="Clear"><i class="fa fa-refresh"></i></a>
                        </div>
                    </form>
                </td>
                <td style="font-size:12px; min-width:150px;">
                    @if ($item->category === 'Innovation By Student')
                        <p class="mb-1">Free <span class="badge bg-success">Free</span></p>
                        <a href="{{ route('payment.status.update', $item->ukey) }}"
                            class="badge {{ $item->pv == 1 ? 'bg-success' : 'bg-danger' }}">{{ $item->pv == 1 ? 'Verified' : 'Unverified' }}</a>
                    @elseif($item->payment == 2)
                        <p class="mb-1">Paid Online</p>
                        <span
                            class="badge bg-success">Online</span><br><strong>{{ $order->card_issuer ?? 'N/A' }}</strong>
                    @elseif($item->invoice)
                        <p class="mb-1">Cheque Payment</p>
                        Invoice: <strong
                            class="{{ $item->pv == 1 ? 'text-success' : 'text-danger' }}">{{ $item->invoice }}</strong><br>
                        <a href="{{ route('payment.status.update', $item->ukey) }}"
                            class="badge {{ $item->pv == 1 ? 'bg-success' : 'bg-danger' }}">
                            {{ $item->pv == 1 ? 'Payment verified' : 'Payment unverified' }}
                        </a>
                    @else
                        <form action="{{ route('dashboard.payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="name" value="{{ $item->name }}">
                            <input type="hidden" name="email" value="{{ $item->email }}">
                            <input type="hidden" name="phone" value="{{ $item->phone }}">
                            <input type="hidden" name="ukey" value="{{ $item->ukey }}">
                            <button type="submit" class="btn btn-info btn-sm">Send Mail For Payment <span
                                    class="badge bg-success">{{ $item->paymentLinkSend }}</span></button>
                        </form>
                    @endif
                </td>

                @if ($page == 'pv')
                    <td>
                        @if ($item->payment == 2)
                            <form action="{{ route('dashboard.payment.confirm') }}" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="{{ $item->name }}">
                                <input type="hidden" name="email" value="{{ $item->email }}">
                                <input type="hidden" name="phone" value="{{ $item->phone }}">
                                <input type="hidden" name="ukey" value="{{ $item->ukey }}">
                                <button type="submit" class="btn btn-info btn-sm">Send Mail For Confirmation <span
                                        class="badge bg-success">{{ $item->confirmLinkSend }}</span></button>
                            </form>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                @endif

                @if (in_array($page, ['dashboard', 'trash']))
                    <td>
                        @if ($item->trash)
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('trash.update', $item->ukey) }}" class="btn btn-success btn-sm"
                                    title="Restore"><i class="fa fa-undo"></i></a>
                                <form action="{{ route('dashboard.destroy', $item->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Are you sure to permanently delete?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        @else
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('form.edit', $item->id) }}" class="btn btn-success btn-sm"
                                    title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('trash.update', $item->ukey) }}" class="btn btn-danger btn-sm"
                                    title="Trash"><i class="fa fa-trash"></i></a>
                            </div>
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
