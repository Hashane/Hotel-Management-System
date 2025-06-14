<table class="table table-borderless mb-0">
    <tbody>
    <tr>
        <td>Bill No:</td>
        <td class="text-end">#{{ $bill['id'] ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td>Booking No:</td>
        <td class="text-end">#{{ $bill->reservation->booking_number }}</td>
    </tr>
    <tr>
        <td>Room Price:</td>
        <td class="text-end">LKR {{ number_format($bill['totalRoomCost'], 2) }}</td>
    </tr>
    <tr>
        <td>Subtotal:</td>
        <td class="text-end">LKR {{ number_format($bill['subtotal'], 2) }}</td>
    </tr>
    <tr>
        <td>Discount:</td>
        <td class="text-end">LKR {{ number_format($bill['discount'] ?? 0, 2) }}</td>
    </tr>
    <tr>
        <td>Tax:</td>
        <td class="text-end">LKR {{ number_format($bill['tax'], 2) }}</td>
    </tr>
    <tr>
        <td>Service Charges:</td>
        <td class="text-end">LKR {{ number_format($bill['serviceCharges'], 2) }}</td>
    </tr>
    @if ($bill->reservation->extraCharges->count())
        <tr>
            <td colspan="2"><strong>Additional Charges:</strong></td>
        </tr>
        @foreach ($bill->reservation->extraCharges as $charge)
            <tr>
                <td class="ps-4">{{ $charge->serviceType->name}}</td>
                <td class="text-end">LKR {{ number_format($charge->amount, 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td class="fw-semibold">Total Additional Charges:</td>
            <td class="text-end fw-semibold">
                LKR {{ number_format($bill->reservation->extraCharges->sum('amount'), 2) }}
            </td>
        </tr>
    @else
        <tr>
            <td>Additional Charges:</td>
            <td class="text-end">LKR 0.00</td>
        </tr>
    @endif
    <tr>
        <td>Late Checkout Fee:</td>
        <td class="text-end">LKR {{ number_format($bill['lateCheckoutFee'] ?? 0, 2) }}</td>
    </tr>
    <tr class="fw-bold border-top">
        <td>Total Amount:</td>
        <td class="text-end">LKR {{ number_format($bill['total'], 2) }}</td>
    </tr>
    </tbody>
</table>