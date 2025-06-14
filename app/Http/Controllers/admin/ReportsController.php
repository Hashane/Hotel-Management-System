<?php

namespace App\Http\Controllers\admin;

use App\Exports\ReservationsExport;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController
{
    public function dailyReport(Request $request)
    {
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        $startDate = ! empty($startDateInput) ? $startDateInput : Carbon::today()->toDateString();
        $endDate = ! empty($endDateInput) ? $endDateInput : Carbon::today()->addDay()->toDateString();

        // Total rooms
        $totalRooms = Room::count();

        // Booked rooms on that date
        $bookedRoomsCount = Room::whereHas('roomReservations', function ($query) use ($startDate, $endDate) {
            $query->where(function ($query) use ($startDate, $endDate) {
                $query->where('check_in', '<', $endDate)
                    ->where('check_out', '>', $startDate);
            });
        })->count();

        // Occupancy percentage
        $occupancyPercent = $totalRooms > 0 ? ($bookedRoomsCount / $totalRooms) * 100 : 0;

        // Revenue for that date (sum of price for reservations overlapping this date)
        $revenue = Reservation::whereHas('roomReservations', function ($query) use ($startDate, $endDate) {
            $query->where('check_in', '<', $endDate)
                ->where('check_out', '>', $startDate);
        })->sum('amount');

        $reservations = Reservation::whereHas('roomReservations', function ($query) use ($startDate, $endDate) {
            $query->where('check_in', '<', $endDate)
                ->where('check_out', '>', $startDate);
        })->with('roomReservations.room')->get();

        return view('admin.report', compact(
            'reservations',
            'startDate',
            'endDate',
            'totalRooms',
            'bookedRoomsCount',
            'occupancyPercent',
            'revenue'
        ));
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::today()->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->addDay()->toDateString());

        $fileName = "reservations_report_{$startDate}_to_{$endDate}.xlsx";

        return Excel::download(new ReservationsExport($startDate, $endDate), $fileName);
    }
}
