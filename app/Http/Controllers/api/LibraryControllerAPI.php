<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LibraryControllerAPI extends Controller
{
    private function getAdminBranchById($adminBranchId)
    {
        $admin = DB::table('branch')->where('id', $adminBranchId)->first();

        if (!$admin || strtolower((string) $admin->role) !== 'admin') {
            return null;
        }

        return $admin;
    }

    private function getDefaultConfigDefinitions()
    {
        return [
            'slot_definitions' => [
                'type' => 'json',
                'description' => 'Available library slot definitions.',
                'value' => [
                    ['id' => 'A', 'label' => 'Slot A', 'time' => '6AM-10AM', 'color' => '#f59e0b'],
                    ['id' => 'B', 'label' => 'Slot B', 'time' => '10AM-2PM', 'color' => '#10b981'],
                    ['id' => 'C', 'label' => 'Slot C', 'time' => '2PM-6PM', 'color' => '#3b82f6'],
                    ['id' => 'D', 'label' => 'Slot D', 'time' => '6PM-10PM', 'color' => '#a78bfa'],
                ],
            ],
            'pricing_tiers' => [
                'type' => 'json',
                'description' => 'Monthly pricing by number of selected slots.',
                'value' => [
                    '1' => 300,
                    '2' => 500,
                    '3' => 800,
                    '4' => 1000,
                ],
            ],
            'locker_price' => [
                'type' => 'number',
                'description' => 'Monthly price per locker.',
                'value' => 300,
            ],
            'locker_numbers' => [
                'type' => 'json',
                'description' => 'Available locker numbers.',
                'value' => [1, 2, 3, 4, 5, 6],
            ],
            'seat_layout' => [
                'type' => 'json',
                'description' => 'Library seat layout grouped by block and row.',
                'value' => [
                    'A' => [
                        ['row' => 'A', 'seats' => range(1, 19)],
                        ['row' => 'B', 'seats' => range(0, 11)],
                        ['row' => 'C', 'seats' => range(0, 11)],
                        ['row' => 'D', 'seats' => range(1, 17)],
                        ['row' => 'E', 'seats' => range(1, 7)],
                    ],
                    'B' => [
                        ['row' => 'A', 'seats' => range(1, 16)],
                        ['row' => 'B', 'seats' => range(1, 14)],
                        ['row' => 'C', 'seats' => range(1, 15)],
                        ['row' => 'D', 'seats' => range(1, 19)],
                    ],
                ],
            ],
        ];
    }

    private function parseConfigValue($valueType, $value)
    {
        if ($valueType === 'json') {
            $decoded = json_decode((string) $value, true);
            return $decoded !== null ? $decoded : [];
        }

        if ($valueType === 'number') {
            return is_numeric($value) ? (float) $value : 0;
        }

        return $value;
    }

    private function normalizeConfigMap()
    {
        $defaults = $this->getDefaultConfigDefinitions();
        $config = [];

        foreach ($defaults as $key => $definition) {
            $config[$key] = $definition['value'];
        }

        $rows = DB::table('library_config')->get();

        foreach ($rows as $row) {
            $config[$row->config_key] = $this->parseConfigValue($row->value_type, $row->config_value);
        }

        return $config;
    }

    private function formatConfigRows()
    {
        $definitions = $this->getDefaultConfigDefinitions();
        $config = $this->normalizeConfigMap();
        $rows = [];

        foreach ($definitions as $key => $definition) {
            $rows[] = [
                'config_key' => $key,
                'value_type' => $definition['type'],
                'description' => $definition['description'],
                'config_value' => $config[$key] ?? $definition['value'],
            ];
        }

        return $rows;
    }

    private function totalSeatsFromLayout(array $seatLayout)
    {
        $total = 0;

        foreach ($seatLayout as $rows) {
            foreach ((array) $rows as $row) {
                $total += count($row['seats'] ?? []);
            }
        }

        return $total;
    }

    private function calculatePrice(array $slotIds, array $lockerNumbers, array $config)
    {
        $pricingTiers = $config['pricing_tiers'] ?? [];
        $lockerPrice = (float) ($config['locker_price'] ?? 0);
        $slotCount = count($slotIds);
        $basePrice = isset($pricingTiers[(string) $slotCount]) ? (float) $pricingTiers[(string) $slotCount] : 300;

        return $basePrice + (count($lockerNumbers) * $lockerPrice);
    }

    private function seatExistsInLayout($seatId, array $seatLayout)
    {
        foreach ($seatLayout as $block => $rows) {
            foreach ((array) $rows as $row) {
                foreach ((array) ($row['seats'] ?? []) as $seatNumber) {
                    if ($seatId === $block . '_' . ($row['row'] ?? '') . $seatNumber) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    private function seatLabelFromSeatId($seatId)
    {
        if (!$seatId || strpos($seatId, '_') === false) {
            return (string) $seatId;
        }

        return substr($seatId, strpos($seatId, '_') + 1);
    }

    private function monthName($month)
    {
        $names = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec',
        ];

        return $names[(int) $month] ?? 'Unknown';
    }

    private function validateAdminRequest(Request $request)
    {
        $admin = $this->getAdminBranchById($request->input('admin_branch_id'));

        if (!$admin) {
            return response()->json([
                'error' => true,
                'message' => 'Unauthorized. Superadmin access required.',
            ], 403);
        }

        return $admin;
    }

    private function getMonthBookingsCollection($year, $month, $search = '')
    {
        $query = DB::table('library_bookings')
            ->join('library_members', 'library_bookings.member_id', '=', 'library_members.member_id')
            ->where('library_bookings.booking_year', $year)
            ->where('library_bookings.booking_month', $month)
            ->select(
                'library_bookings.*',
                'library_members.full_name',
                'library_members.phone',
                'library_members.notes as member_notes'
            )
            ->orderByDesc('library_bookings.created_at');

        if ($search !== '') {
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery
                    ->where('library_members.full_name', 'like', '%' . $search . '%')
                    ->orWhere('library_members.phone', 'like', '%' . $search . '%')
                    ->orWhere('library_bookings.seat_label', 'like', '%' . $search . '%')
                    ->orWhere('library_bookings.seat_id', 'like', '%' . $search . '%');
            });
        }

        return $query->get();
    }

    private function hydrateBookings($bookings, $year)
    {
        if ($bookings->isEmpty()) {
            return [];
        }

        $bookingIds = $bookings->pluck('booking_id')->values()->all();
        $groupIds = $bookings->pluck('booking_group_id')->filter()->unique()->values()->all();

        $slotMap = DB::table('library_booking_slots')
            ->whereIn('booking_id', $bookingIds)
            ->orderBy('slot_code')
            ->get()
            ->groupBy('booking_id');

        $lockerMap = DB::table('library_booking_lockers')
            ->whereIn('booking_id', $bookingIds)
            ->orderBy('locker_number')
            ->get()
            ->groupBy('booking_id');

        $groupMonths = [];
        if (!empty($groupIds)) {
            $groupMonthRows = DB::table('library_bookings')
                ->where('booking_year', $year)
                ->whereIn('booking_group_id', $groupIds)
                ->select('booking_group_id', 'booking_month')
                ->orderBy('booking_month')
                ->get()
                ->groupBy('booking_group_id');

            foreach ($groupMonthRows as $groupId => $rows) {
                $groupMonths[$groupId] = $rows->pluck('booking_month')->map(function ($month) {
                    return (int) $month;
                })->values()->all();
            }
        }

        return $bookings->map(function ($booking) use ($slotMap, $lockerMap, $groupMonths) {
            $slots = collect($slotMap->get($booking->booking_id, []))
                ->pluck('slot_code')
                ->map(function ($value) {
                    return (string) $value;
                })
                ->values()
                ->all();

            $lockers = collect($lockerMap->get($booking->booking_id, []))
                ->pluck('locker_number')
                ->map(function ($value) {
                    return (int) $value;
                })
                ->values()
                ->all();

            return [
                'booking_id' => $booking->booking_id,
                'booking_group_id' => $booking->booking_group_id,
                'member_id' => $booking->member_id,
                'name' => $booking->full_name,
                'phone' => $booking->phone,
                'note' => $booking->note ?: $booking->member_notes,
                'status' => $booking->status,
                'block' => $booking->block_code,
                'seat_id' => $booking->seat_id,
                'seat_label' => $booking->seat_label,
                'slots' => $slots,
                'lockers' => $lockers,
                'price' => (float) $booking->monthly_price,
                'booking_year' => (int) $booking->booking_year,
                'booking_month' => (int) $booking->booking_month,
                'group_months' => $groupMonths[$booking->booking_group_id] ?? [(int) $booking->booking_month],
                'payment' => [
                    'status' => $booking->payment_status,
                    'method' => $booking->payment_method,
                    'collectedBy' => $booking->payment_collected_by,
                    'note' => $booking->payment_note,
                    'paidAt' => $booking->payment_paid_at ? date('d/m/Y', strtotime($booking->payment_paid_at)) : null,
                ],
                'created_at' => $booking->created_at,
                'createdAt' => $booking->created_at ? date('d/m/Y', strtotime($booking->created_at)) : null,
            ];
        })->values()->all();
    }

    private function getUnavailableSeatIds($year, array $months, array $slots, $excludeBookingId = null)
    {
        $query = DB::table('library_booking_slots')
            ->where('booking_year', $year)
            ->whereIn('booking_month', $months)
            ->whereIn('slot_code', $slots);

        if ($excludeBookingId) {
            $query->where('booking_id', '!=', $excludeBookingId);
        }

        return $query->distinct()->pluck('seat_id')->map(function ($seatId) {
            return (string) $seatId;
        })->values()->all();
    }

    private function getUsedLockers($year, array $months, $excludeBookingId = null)
    {
        $query = DB::table('library_booking_lockers')
            ->where('booking_year', $year)
            ->whereIn('booking_month', $months);

        if ($excludeBookingId) {
            $query->where('booking_id', '!=', $excludeBookingId);
        }

        return $query->distinct()->pluck('locker_number')->map(function ($value) {
            return (int) $value;
        })->values()->all();
    }

    private function monthHasSeatConflict($year, $month, $seatId, array $slots, $excludeBookingId = null)
    {
        $query = DB::table('library_booking_slots')
            ->where('booking_year', $year)
            ->where('booking_month', $month)
            ->where('seat_id', $seatId)
            ->whereIn('slot_code', $slots);

        if ($excludeBookingId) {
            $query->where('booking_id', '!=', $excludeBookingId);
        }

        return $query->exists();
    }

    private function conflictingLockersForMonth($year, $month, array $lockers, $excludeBookingId = null)
    {
        if (empty($lockers)) {
            return [];
        }

        $query = DB::table('library_booking_lockers')
            ->where('booking_year', $year)
            ->where('booking_month', $month)
            ->whereIn('locker_number', $lockers);

        if ($excludeBookingId) {
            $query->where('booking_id', '!=', $excludeBookingId);
        }

        return $query->pluck('locker_number')->map(function ($value) {
            return (int) $value;
        })->values()->all();
    }

    private function insertBookingRelations($bookingId, $year, $month, $seatId, array $slots, array $lockers)
    {
        $slotRows = [];
        foreach ($slots as $slotCode) {
            $slotRows[] = [
                'booking_id' => $bookingId,
                'booking_year' => $year,
                'booking_month' => $month,
                'seat_id' => $seatId,
                'slot_code' => $slotCode,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($slotRows)) {
            DB::table('library_booking_slots')->insert($slotRows);
        }

        $lockerRows = [];
        foreach ($lockers as $lockerNumber) {
            $lockerRows[] = [
                'booking_id' => $bookingId,
                'booking_year' => $year,
                'booking_month' => $month,
                'locker_number' => $lockerNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($lockerRows)) {
            DB::table('library_booking_lockers')->insert($lockerRows);
        }
    }

    public function getConfig(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $config = $this->normalizeConfigMap();

        return response()->json([
            'error' => false,
            'message' => 'Library config fetched successfully.',
            'data' => [
                'config' => $config,
                'rows' => $this->formatConfigRows(),
                'meta' => [
                    'total_seats' => $this->totalSeatsFromLayout($config['seat_layout'] ?? []),
                    'total_slots' => count($config['slot_definitions'] ?? []),
                    'total_lockers' => count($config['locker_numbers'] ?? []),
                ],
            ],
        ], 200);
    }

    public function updateConfig(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'slot_definitions' => 'nullable|array|min:1',
            'pricing_tiers' => 'nullable|array|min:1',
            'locker_price' => 'nullable|numeric|min:0',
            'locker_numbers' => 'nullable|array|min:1',
            'seat_layout' => 'nullable|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $validated = $validator->validated();
        $definitions = $this->getDefaultConfigDefinitions();
        $updates = [];

        foreach (['slot_definitions', 'pricing_tiers', 'locker_price', 'locker_numbers', 'seat_layout'] as $key) {
            if (!$request->has($key)) {
                continue;
            }

            $type = $definitions[$key]['type'] ?? 'json';
            $value = $validated[$key] ?? $request->input($key);

            if ($key === 'slot_definitions') {
                foreach ((array) $value as $slot) {
                    if (empty($slot['id']) || empty($slot['label']) || empty($slot['time'])) {
                        return response()->json([
                            'error' => true,
                            'message' => 'Each slot must include id, label, and time.',
                        ], 422);
                    }
                }
            }

            $updates[] = [
                'config_key' => $key,
                'config_value' => $type === 'json' ? json_encode($value) : (string) $value,
                'value_type' => $type,
                'description' => $definitions[$key]['description'] ?? null,
                'updated_at' => now(),
                'created_at' => now(),
            ];
        }

        if (empty($updates)) {
            return response()->json([
                'error' => true,
                'message' => 'No config values were provided.',
            ], 422);
        }

        foreach ($updates as $row) {
            $existing = DB::table('library_config')
                ->where('config_key', $row['config_key'])
                ->exists();

            if ($existing) {
                DB::table('library_config')
                    ->where('config_key', $row['config_key'])
                    ->update([
                        'config_value' => $row['config_value'],
                        'value_type' => $row['value_type'],
                        'description' => $row['description'],
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('library_config')->insert($row);
            }
        }

        $config = $this->normalizeConfigMap();

        return response()->json([
            'error' => false,
            'message' => 'Library config updated successfully.',
            'data' => [
                'config' => $config,
                'meta' => [
                    'total_seats' => $this->totalSeatsFromLayout($config['seat_layout'] ?? []),
                    'total_slots' => count($config['slot_definitions'] ?? []),
                    'total_lockers' => count($config['locker_numbers'] ?? []),
                ],
            ],
        ], 200);
    }

    public function getDashboard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'year' => 'required|integer|min:2000|max:2100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $year = (int) $request->year;
        $config = $this->normalizeConfigMap();
        $totalSeats = max(1, $this->totalSeatsFromLayout($config['seat_layout'] ?? []));
        $slotCount = max(1, count($config['slot_definitions'] ?? []));

        $summaryRows = DB::table('library_bookings')
            ->where('booking_year', $year)
            ->selectRaw('booking_month')
            ->selectRaw('COUNT(*) as total_bookings')
            ->selectRaw("SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed_count")
            ->selectRaw("SUM(CASE WHEN status = 'secured' THEN 1 ELSE 0 END) as secured_count")
            ->selectRaw("SUM(CASE WHEN payment_status = 'paid' THEN monthly_price ELSE 0 END) as collected_amount")
            ->selectRaw("SUM(CASE WHEN payment_status != 'paid' THEN monthly_price ELSE 0 END) as pending_amount")
            ->groupBy('booking_month')
            ->get()
            ->keyBy('booking_month');

        $occupiedRows = DB::table('library_booking_slots')
            ->where('booking_year', $year)
            ->selectRaw('booking_month, COUNT(*) as occupied_slot_seats')
            ->groupBy('booking_month')
            ->get()
            ->keyBy('booking_month');

        $lockerRows = DB::table('library_booking_lockers')
            ->where('booking_year', $year)
            ->selectRaw('booking_month, COUNT(*) as used_lockers')
            ->groupBy('booking_month')
            ->get()
            ->keyBy('booking_month');

        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $summary = $summaryRows->get($month);
            $occupied = (int) ($occupiedRows->get($month)->occupied_slot_seats ?? 0);
            $months[] = [
                'month' => $month,
                'month_label' => $this->monthName($month),
                'total_bookings' => (int) ($summary->total_bookings ?? 0),
                'confirmed_count' => (int) ($summary->confirmed_count ?? 0),
                'secured_count' => (int) ($summary->secured_count ?? 0),
                'collected_amount' => (float) ($summary->collected_amount ?? 0),
                'pending_amount' => (float) ($summary->pending_amount ?? 0),
                'used_lockers' => (int) ($lockerRows->get($month)->used_lockers ?? 0),
                'occupied_slot_seats' => $occupied,
                'occupancy_percent' => (int) round(($occupied / ($totalSeats * $slotCount)) * 100),
            ];
        }

        return response()->json([
            'error' => false,
            'message' => 'Library dashboard loaded successfully.',
            'data' => [
                'year' => $year,
                'months' => $months,
                'meta' => [
                    'total_seats' => $totalSeats,
                    'total_slots' => $slotCount,
                    'total_lockers' => count($config['locker_numbers'] ?? []),
                    'config' => $config,
                ],
            ],
        ], 200);
    }

    public function getBookings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'year' => 'required|integer|min:2000|max:2100',
            'month' => 'required|integer|min:1|max:12',
            'search' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $year = (int) $request->year;
        $month = (int) $request->month;
        $search = trim((string) $request->input('search', ''));
        $bookings = $this->getMonthBookingsCollection($year, $month, $search);

        return response()->json([
            'error' => false,
            'message' => 'Library bookings loaded successfully.',
            'data' => $this->hydrateBookings($bookings, $year),
        ], 200);
    }

    public function getAvailability(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'year' => 'required|integer|min:2000|max:2100',
            'months' => 'required|array|min:1',
            'months.*' => 'required|integer|min:1|max:12',
            'slots' => 'required|array|min:1',
            'slots.*' => 'required|string|max:20',
            'exclude_booking_id' => 'nullable|integer|exists:library_bookings,booking_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $year = (int) $request->year;
        $months = collect($request->months)->map(function ($value) {
            return (int) $value;
        })->unique()->values()->all();
        $slots = collect($request->slots)->map(function ($value) {
            return (string) $value;
        })->unique()->values()->all();
        $excludeBookingId = $request->input('exclude_booking_id');

        return response()->json([
            'error' => false,
            'message' => 'Availability fetched successfully.',
            'data' => [
                'occupied_seat_ids' => $this->getUnavailableSeatIds($year, $months, $slots, $excludeBookingId),
                'used_lockers' => $this->getUsedLockers($year, $months, $excludeBookingId),
            ],
        ], 200);
    }

    public function admitMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'note' => 'nullable|string|max:1000',
            'year' => 'required|integer|min:2000|max:2100',
            'months' => 'required|array|min:1',
            'months.*' => 'required|integer|min:1|max:12',
            'status' => 'required|in:confirmed,secured',
            'block' => 'required|string|max:20',
            'seat_id' => 'required|string|max:100',
            'slots' => 'required|array|min:1',
            'slots.*' => 'required|string|max:20',
            'lockers' => 'nullable|array',
            'lockers.*' => 'integer|min:1|max:999',
            'custom_price' => 'nullable|numeric|min:0',
            'payment_status' => 'nullable|in:pending,paid',
            'payment_method' => 'nullable|string|max:50',
            'payment_collected_by' => 'nullable|string|max:255',
            'payment_note' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $validated = $validator->validated();
        $config = $this->normalizeConfigMap();
        $year = (int) $validated['year'];
        $months = collect($validated['months'])->map(function ($value) {
            return (int) $value;
        })->unique()->sort()->values()->all();
        $slots = collect($validated['slots'])->map(function ($value) {
            return (string) $value;
        })->unique()->values()->all();
        $lockers = collect($validated['lockers'] ?? [])->map(function ($value) {
            return (int) $value;
        })->unique()->values()->all();
        $paymentStatus = $validated['payment_status'] ?? 'pending';

        if (!$this->seatExistsInLayout($validated['seat_id'], $config['seat_layout'] ?? [])) {
            return response()->json([
                'error' => true,
                'message' => 'Selected seat does not exist in library layout.',
            ], 422);
        }

        if ($paymentStatus === 'paid' && (empty($validated['payment_method']) || empty($validated['payment_collected_by']))) {
            return response()->json([
                'error' => true,
                'message' => 'Payment method and collected by are required when payment status is paid.',
            ], 422);
        }

        foreach ($months as $month) {
            if ($this->monthHasSeatConflict($year, $month, $validated['seat_id'], $slots)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Seat ' . $this->seatLabelFromSeatId($validated['seat_id']) . ' is already booked in ' . $this->monthName($month) . ' for one of the selected slots.',
                ], 409);
            }

            $conflictingLockers = $this->conflictingLockersForMonth($year, $month, $lockers);
            if (!empty($conflictingLockers)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Locker ' . implode(', ', $conflictingLockers) . ' is already assigned in ' . $this->monthName($month) . '.',
                ], 409);
            }
        }

        $monthlyPrice = $validated['custom_price'] !== null
            ? (float) $validated['custom_price']
            : $this->calculatePrice($slots, $lockers, $config);

        DB::beginTransaction();

        try {
            $memberId = DB::table('library_members')->insertGetId([
                'full_name' => trim($validated['name']),
                'phone' => $validated['phone'] ?? null,
                'notes' => $validated['note'] ?? null,
                'is_active' => true,
                'created_by_admin_branch_id' => $admin->id,
                'updated_by_admin_branch_id' => $admin->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $groupId = (string) Str::uuid();

            foreach ($months as $month) {
                $bookingId = DB::table('library_bookings')->insertGetId([
                    'booking_group_id' => $groupId,
                    'member_id' => $memberId,
                    'booking_year' => $year,
                    'booking_month' => $month,
                    'status' => $validated['status'],
                    'block_code' => $validated['block'],
                    'seat_id' => $validated['seat_id'],
                    'seat_label' => $this->seatLabelFromSeatId($validated['seat_id']),
                    'note' => $validated['note'] ?? null,
                    'monthly_price' => $monthlyPrice,
                    'payment_status' => $paymentStatus,
                    'payment_method' => $paymentStatus === 'paid' ? ($validated['payment_method'] ?? null) : null,
                    'payment_collected_by' => $paymentStatus === 'paid' ? ($validated['payment_collected_by'] ?? null) : null,
                    'payment_note' => $paymentStatus === 'paid' ? ($validated['payment_note'] ?? null) : null,
                    'payment_paid_at' => $paymentStatus === 'paid' ? now() : null,
                    'created_by_admin_branch_id' => $admin->id,
                    'updated_by_admin_branch_id' => $admin->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->insertBookingRelations($bookingId, $year, $month, $validated['seat_id'], $slots, $lockers);

                if ($paymentStatus === 'paid') {
                    DB::table('library_payment_logs')->insert([
                        'booking_id' => $bookingId,
                        'amount' => $monthlyPrice,
                        'payment_method' => $validated['payment_method'] ?? null,
                        'collected_by' => $validated['payment_collected_by'] ?? null,
                        'note' => $validated['payment_note'] ?? null,
                        'paid_at' => now(),
                        'created_by_admin_branch_id' => $admin->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Library member admitted successfully.',
                'data' => [
                    'member_id' => $memberId,
                    'booking_group_id' => $groupId,
                    'monthly_price' => $monthlyPrice,
                    'months' => $months,
                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Library admit failed', [
                'error' => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to admit library member.',
            ], 500);
        }
    }

    public function confirmBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'booking_id' => 'required|exists:library_bookings,booking_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        DB::table('library_bookings')
            ->where('booking_id', $request->booking_id)
            ->update([
                'status' => 'confirmed',
                'updated_by_admin_branch_id' => $admin->id,
                'updated_at' => now(),
            ]);

        return response()->json([
            'error' => false,
            'message' => 'Booking confirmed successfully.',
        ], 200);
    }

    public function updateBookingPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'booking_id' => 'required|exists:library_bookings,booking_id',
            'monthly_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        DB::table('library_bookings')
            ->where('booking_id', $request->booking_id)
            ->update([
                'monthly_price' => (float) $request->monthly_price,
                'updated_by_admin_branch_id' => $admin->id,
                'updated_at' => now(),
            ]);

        return response()->json([
            'error' => false,
            'message' => 'Booking price updated successfully.',
        ], 200);
    }

    public function recordPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'booking_id' => 'required|exists:library_bookings,booking_id',
            'payment_method' => 'required|string|max:50',
            'payment_collected_by' => 'required|string|max:255',
            'payment_note' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $booking = DB::table('library_bookings')->where('booking_id', $request->booking_id)->first();

        if (!$booking) {
            return response()->json([
                'error' => true,
                'message' => 'Booking not found.',
            ], 404);
        }

        DB::beginTransaction();

        try {
            DB::table('library_bookings')
                ->where('booking_id', $booking->booking_id)
                ->update([
                    'payment_status' => 'paid',
                    'payment_method' => $request->payment_method,
                    'payment_collected_by' => $request->payment_collected_by,
                    'payment_note' => $request->payment_note,
                    'payment_paid_at' => now(),
                    'updated_by_admin_branch_id' => $admin->id,
                    'updated_at' => now(),
                ]);

            DB::table('library_payment_logs')->insert([
                'booking_id' => $booking->booking_id,
                'amount' => (float) $booking->monthly_price,
                'payment_method' => $request->payment_method,
                'collected_by' => $request->payment_collected_by,
                'note' => $request->payment_note,
                'paid_at' => now(),
                'created_by_admin_branch_id' => $admin->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Payment recorded successfully.',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Library payment recording failed', [
                'error' => $e->getMessage(),
                'booking_id' => $request->booking_id,
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to record payment.',
            ], 500);
        }
    }

    public function extendBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'booking_id' => 'required|exists:library_bookings,booking_id',
            'year' => 'required|integer|min:2000|max:2100',
            'months' => 'required|array|min:1',
            'months.*' => 'required|integer|min:1|max:12',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $sourceBooking = DB::table('library_bookings')->where('booking_id', $request->booking_id)->first();

        if (!$sourceBooking) {
            return response()->json([
                'error' => true,
                'message' => 'Booking not found.',
            ], 404);
        }

        $config = $this->normalizeConfigMap();
        $targetYear = (int) $request->year;
        $targetMonths = collect($request->months)->map(function ($value) {
            return (int) $value;
        })->unique()->sort()->values()->all();

        $slotIds = DB::table('library_booking_slots')
            ->where('booking_id', $sourceBooking->booking_id)
            ->orderBy('slot_code')
            ->pluck('slot_code')
            ->map(function ($value) {
                return (string) $value;
            })
            ->values()
            ->all();

        $lockerIds = DB::table('library_booking_lockers')
            ->where('booking_id', $sourceBooking->booking_id)
            ->orderBy('locker_number')
            ->pluck('locker_number')
            ->map(function ($value) {
                return (int) $value;
            })
            ->values()
            ->all();

        $existingGroupMonths = DB::table('library_bookings')
            ->where('booking_group_id', $sourceBooking->booking_group_id)
            ->where('booking_year', $targetYear)
            ->pluck('booking_month')
            ->map(function ($value) {
                return (int) $value;
            })
            ->values()
            ->all();

        $createdMonths = [];
        $skipped = [];

        DB::beginTransaction();

        try {
            foreach ($targetMonths as $month) {
                if (in_array($month, $existingGroupMonths, true)) {
                    $skipped[] = [
                        'month' => $month,
                        'reason' => 'Already booked in ' . $this->monthName($month) . '.',
                    ];
                    continue;
                }

                if ($this->monthHasSeatConflict($targetYear, $month, $sourceBooking->seat_id, $slotIds)) {
                    $skipped[] = [
                        'month' => $month,
                        'reason' => 'Seat conflict in ' . $this->monthName($month) . '.',
                    ];
                    continue;
                }

                $conflictingLockers = $this->conflictingLockersForMonth($targetYear, $month, $lockerIds);
                $safeLockers = array_values(array_diff($lockerIds, $conflictingLockers));
                $price = count($safeLockers) === count($lockerIds)
                    ? (float) $sourceBooking->monthly_price
                    : $this->calculatePrice($slotIds, $safeLockers, $config);

                $newBookingId = DB::table('library_bookings')->insertGetId([
                    'booking_group_id' => $sourceBooking->booking_group_id,
                    'member_id' => $sourceBooking->member_id,
                    'booking_year' => $targetYear,
                    'booking_month' => $month,
                    'status' => $sourceBooking->status,
                    'block_code' => $sourceBooking->block_code,
                    'seat_id' => $sourceBooking->seat_id,
                    'seat_label' => $sourceBooking->seat_label,
                    'note' => $sourceBooking->note,
                    'monthly_price' => $price,
                    'payment_status' => 'pending',
                    'payment_method' => null,
                    'payment_collected_by' => null,
                    'payment_note' => null,
                    'payment_paid_at' => null,
                    'created_by_admin_branch_id' => $admin->id,
                    'updated_by_admin_branch_id' => $admin->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->insertBookingRelations($newBookingId, $targetYear, $month, $sourceBooking->seat_id, $slotIds, $safeLockers);

                $createdMonths[] = [
                    'month' => $month,
                    'removed_lockers' => array_values($conflictingLockers),
                    'price' => $price,
                ];
            }

            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Booking extension processed.',
                'data' => [
                    'created_months' => $createdMonths,
                    'skipped_months' => $skipped,
                ],
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Library booking extension failed', [
                'error' => $e->getMessage(),
                'booking_id' => $request->booking_id,
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to extend booking.',
            ], 500);
        }
    }

    public function deleteBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_branch_id' => 'required|exists:branch,id',
            'booking_id' => 'required|exists:library_bookings,booking_id',
            'scope' => 'required|in:month,all',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $admin = $this->validateAdminRequest($request);
        if (!$admin || $admin instanceof \Illuminate\Http\JsonResponse) {
            return $admin;
        }

        $booking = DB::table('library_bookings')->where('booking_id', $request->booking_id)->first();

        if (!$booking) {
            return response()->json([
                'error' => true,
                'message' => 'Booking not found.',
            ], 404);
        }

        $query = DB::table('library_bookings');
        if ($request->scope === 'all') {
            $query->where('booking_group_id', $booking->booking_group_id);
        } else {
            $query->where('booking_id', $booking->booking_id);
        }

        $bookingIds = $query->pluck('booking_id')->values()->all();

        if (empty($bookingIds)) {
            return response()->json([
                'error' => true,
                'message' => 'No bookings found to delete.',
            ], 404);
        }

        DB::table('library_bookings')->whereIn('booking_id', $bookingIds)->delete();

        return response()->json([
            'error' => false,
            'message' => 'Booking deleted successfully.',
            'data' => [
                'deleted_count' => count($bookingIds),
            ],
        ], 200);
    }
}
