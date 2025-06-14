@php use Carbon\Carbon; @endphp
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Invoice for Booking #{{ $bill->reservation->booking_number }}</title>
    <style>
        /* Reset and basic styles */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0 2rem;
            color: #333;
            line-height: 1.4;
        }

        h1, h2, h3, h4, h5, h6 {
            margin: 0;
        }

        .header, .footer {
            text-align: center;
            margin: 2rem 0;
            color: #555;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 0.25rem;
        }

        .header p {
            margin: 0;
            font-size: 14px;
        }

        .section-title {
            text-transform: uppercase;
            color: #666;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 0.5rem;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
        }

        .details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .details-label {
            font-weight: 600;
            width: 40%;
        }

        .details-value {
            width: 55%;
            text-align: right;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f7f7f7;
            font-weight: 600;
            text-align: left;
        }

        tfoot tr td {
            font-weight: bold;
            border-top: 2px solid #000;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Four Seasons</h1>
    <p>123 Main Street, Colombo, Sri Lanka</p>
    <p>Phone: +94 11 234 5678 | Email: info@fourseasons.com</p>
</div>

<h2 class="section-title">Reservation Details</h2>
<div class="details-row">
    <div class="details-label">Guest Name:</div>
    <div class="details-value">{{ $bill->reservation->customer->name ?? 'N/A' }}</div>
</div>
<div class="details-row">
    <div class="details-label">Email:</div>
    <div class="details-value">{{ $bill->reservation->customer->email ?? 'N/A' }}</div>
</div>
<div class="details-row">
    <div class="details-label">Phone:</div>
    <div class="details-value">{{ $bill->reservation->customer->phone ?? 'N/A' }}</div>
</div>
<div class="details-row">
    <div class="details-label">Reservation ID:</div>
    <div class="details-value">{{ $bill->reservation->id ?? 'N/A' }}</div>
</div>
<div class="details-row">
    <div class="details-label">Rooms:</div>
    <div class="details-value">
        @foreach ($bill->reservation->roomReservations as $roomReservation)
            {{ $roomReservation->room->room_number ?? $roomReservation->room->id ?? 'N/A' }}
            ({{ Carbon::parse($roomReservation->check_in)->format('Y-m-d') }}
            to {{ Carbon::parse($roomReservation->check_out)->format('Y-m-d') }})
            @if (! $loop->last)
                ,
            @endif
        @endforeach
    </div>
</div>

<h2 class="section-title">Charges Summary</h2>

@include('admin.partials.bill-details', ['bill' => $bill])

<div class="footer" style="margin-top: 3rem; font-size: 12px; color: #999;">
    <p>Thank you for choosing Four Seasons Hotel. We look forward to your next visit!</p>
</div>
</body>
</html>
