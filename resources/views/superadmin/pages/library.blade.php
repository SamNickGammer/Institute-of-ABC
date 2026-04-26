<style>
    .lib-shell {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }
    .lib-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
    }
    .lib-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 24px 26px;
        flex-wrap: wrap;
    }
    .lib-title {
        font-size: 22px;
        color: #111827;
        margin: 0 0 6px;
    }
    .lib-subtitle {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }
    .lib-btn {
        border: none;
        border-radius: 12px;
        padding: 10px 18px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.16s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .lib-btn:disabled {
        opacity: 0.55;
        cursor: not-allowed;
    }
    .lib-btn-dark {
        background: #111827;
        color: #fff;
    }
    .lib-btn-dark:hover:not(:disabled) {
        background: #0f172a;
        transform: translateY(-1px);
    }
    .lib-btn-light {
        background: #f3f4f6;
        color: #111827;
    }
    .lib-btn-light:hover:not(:disabled) {
        background: #e5e7eb;
    }
    .lib-btn-green {
        background: #dcfce7;
        color: #166534;
    }
    .lib-btn-green:hover:not(:disabled) {
        background: #bbf7d0;
    }
    .lib-btn-red {
        background: #fee2e2;
        color: #b91c1c;
    }
    .lib-btn-red:hover:not(:disabled) {
        background: #fecaca;
    }
    .lib-btn-amber {
        background: #fef3c7;
        color: #b45309;
    }
    .lib-btn-amber:hover:not(:disabled) {
        background: #fde68a;
    }
    .lib-section {
        padding: 24px 26px 28px;
    }
    .lib-home-grid {
        display: grid;
        grid-template-columns: 600px minmax(0, 1fr);
        gap: 18px;
    }
    .lib-month-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
    }
    .lib-month-card {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 14px 14px 12px;
        cursor: pointer;
        transition: all 0.16s ease;
        background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%);
    }
    .lib-month-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.06);
        border-color: #d1d5db;
    }
    .lib-month-card.active {
        border-color: #111827;
        background: #111827;
        color: #fff;
    }
    .lib-month-name {
        font-size: 18px;
        margin-bottom: 8px;
    }
    .lib-mini-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #9ca3af;
    }
    .lib-month-card.active .lib-mini-label,
    .lib-month-card.active .lib-month-muted {
        color: rgba(255,255,255,0.68);
    }
    .lib-month-muted {
        font-size: 11px;
        color: #6b7280;
    }
    .lib-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
    }
    .lib-stat-card {
        border: 1px solid #eef2f7;
        border-radius: 16px;
        padding: 16px 18px;
        background: linear-gradient(180deg, #fff 0%, #f9fafb 100%);
    }
    .lib-stat-value {
        font-size: 28px;
        line-height: 1;
        margin-bottom: 6px;
    }
    .lib-stat-label {
        font-size: 11px;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: #9ca3af;
    }
    .lib-info-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }
    .lib-info-card {
        border: 1px solid #eef2f7;
        border-radius: 16px;
        padding: 14px 16px;
        background: #fff;
    }
    .lib-slot-strip {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .lib-pill {
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #374151;
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.16s ease;
    }
    .lib-pill:hover {
        border-color: #cbd5e1;
    }
    .lib-pill.active {
        background: #111827;
        border-color: #111827;
        color: #fff;
    }
    .lib-pill.soft-active {
        background: #eff6ff;
        border-color: #93c5fd;
        color: #1d4ed8;
    }
    .lib-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .lib-tab {
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #374151;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.16s ease;
    }
    .lib-tab.active {
        background: #111827;
        border-color: #111827;
        color: #fff;
    }
    .lib-grid-two {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }
    .lib-grid-three {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }
    .lib-label {
        display: block;
        font-size: 11px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 6px;
    }
    .lib-input,
    .lib-select,
    .lib-textarea {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        padding: 12px 14px;
        font-size: 13px;
        outline: none;
        background: #fff;
        transition: border-color 0.16s ease, box-shadow 0.16s ease;
    }
    .lib-input:focus,
    .lib-select:focus,
    .lib-textarea:focus {
        border-color: #111827;
        box-shadow: 0 0 0 3px rgba(17, 24, 39, 0.06);
    }
    .lib-textarea {
        min-height: 220px;
        resize: vertical;
        font-family: monospace;
    }
    .lib-seat-blocks {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }
    .lib-seat-block {
        border: 1px solid #eef2f7;
        border-radius: 16px;
        padding: 16px;
        background: #fff;
    }
    .lib-seat-row {
        margin-bottom: 10px;
    }
    .lib-seat-row-label {
        font-size: 10px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 6px;
    }
    .lib-seat-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
    }
    .lib-seat {
        min-width: 42px;
        height: 28px;
        border-radius: 8px;
        border: 1px solid transparent;
        font-size: 11px;
        font-family: monospace;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.12s ease, border-color 0.12s ease;
    }
    .lib-seat:hover:not(:disabled) {
        transform: scale(1.06);
    }
    .lib-seat.free {
        background: #dcfce7;
        color: #166534;
        border-color: #86efac;
    }
    .lib-seat.taken {
        background: #fee2e2;
        color: #b91c1c;
        border-color: #fca5a5;
        cursor: not-allowed;
    }
    .lib-seat.selected {
        background: #111827;
        color: #fff;
        border-color: #111827;
    }
    .lib-seat.small {
        min-width: 34px;
        height: 24px;
        font-size: 10px;
        cursor: default;
    }
    .lib-member-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .lib-member-card {
        border: 1px solid #eef2f7;
        border-radius: 16px;
        padding: 18px;
        background: #fff;
    }
    .lib-member-top {
        display: flex;
        justify-content: space-between;
        gap: 14px;
        align-items: flex-start;
    }
    .lib-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 700;
    }
    .lib-warning {
        background: #fff7ed;
        border: 1px solid #fdba74;
        color: #9a3412;
        border-radius: 16px;
        padding: 14px 16px;
        font-size: 12px;
        line-height: 1.6;
    }
    .lib-mono {
        font-family: monospace;
    }
    .lib-revenue-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }
    .lib-locker-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }
    .lib-locker-card {
        border: 1px solid #eef2f7;
        border-radius: 16px;
        padding: 16px;
        background: #fff;
    }
    .lib-progress {
        width: 100%;
        height: 7px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
    }
    .lib-progress > span {
        display: block;
        height: 100%;
        border-radius: 999px;
    }
    .lib-empty {
        text-align: center;
        padding: 46px 0;
        color: #9ca3af;
        font-size: 13px;
    }
    .lib-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
    }
    .lib-modal {
        background: #fff;
        border-radius: 20px;
        width: 100%;
        max-width: 560px;
        max-height: 88vh;
        overflow-y: auto;
        padding: 24px 24px 22px;
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.18);
    }
    .lib-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 18px;
        flex-wrap: wrap;
    }
    .lib-inline-note {
        font-size: 12px;
        color: #6b7280;
    }
    .lib-loading {
        padding: 48px 0;
        display: flex;
        justify-content: center;
    }
    .lib-loader {
        width: 34px;
        height: 34px;
        border-radius: 999px;
        border: 3px solid #e5e7eb;
        border-top-color: #111827;
        animation: libSpin 0.8s linear infinite;
    }
    @keyframes libSpin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    @media (max-width: 1200px) {
        .lib-home-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 980px) {
        .lib-stat-grid,
        .lib-info-grid,
        .lib-grid-two,
        .lib-grid-three,
        .lib-seat-blocks,
        .lib-locker-grid,
        .lib-revenue-row {
            grid-template-columns: 1fr;
        }
        .lib-month-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
</style>

<div class="lib-shell">
    <div class="lib-card">
        <div class="lib-toolbar">
            <div>
                <h1 class="lib-title font-HellixB">Library Management</h1>
                <p class="lib-subtitle font-HellixR">Separate from students, fully database-backed, and configurable from one place.</p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button type="button" class="lib-btn lib-btn-light font-HellixB" onclick="libGoHome()">Home</button>
                <button type="button" class="lib-btn lib-btn-dark font-HellixB" onclick="libOpenConfigTab()">Library Settings</button>
            </div>
        </div>
    </div>

    <div id="libRoot" class="lib-card">
        <div class="lib-loading">
            @include('admin.components.spinner', ['class' => ''])
        </div>
    </div>
</div>

<div id="libModalHost"></div>

<script>
const LIB_MONTH_NAMES = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const LIB_CURRENT_DATE = new Date();
const LIB_DEFAULT_YEAR = LIB_CURRENT_DATE.getFullYear();
const LIB_DEFAULT_MONTH = LIB_CURRENT_DATE.getMonth() + 1;

const LIB_STATE = {
    session: null,
    config: null,
    dashboard: null,
    year: LIB_DEFAULT_YEAR,
    currentMonth: LIB_DEFAULT_MONTH,
    previewMonth: LIB_DEFAULT_MONTH,
    selectedMonth: null,
    activeTab: 'dashboard',
    previewBookings: [],
    monthBookings: [],
    search: '',
    homeSlot: 'A',
    seatsSlot: 'A',
    loading: true,
    loadingMonth: false,
    availabilityLoading: false,
    availability: {
        occupiedSeatIds: [],
        usedLockers: []
    },
    form: null,
    modal: null,
    configForm: {
        slotsJson: '',
        layoutJson: '',
        lockersCsv: '',
        lockerPrice: '',
        price1: '',
        price2: '',
        price3: '',
        price4: ''
    }
};

function libEsc(text) {
    return String(text == null ? '' : text)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function libInr(value) {
    return '₹' + Number(value || 0).toLocaleString('en-IN', { maximumFractionDigits: 2 });
}

function libGetConfig() {
    return LIB_STATE.config || {};
}

function libSeatLayout() {
    return libGetConfig().seat_layout || {};
}

function libSlotDefinitions() {
    return libGetConfig().slot_definitions || [];
}

function libLockerNumbers() {
    return libGetConfig().locker_numbers || [];
}

function libPricingTiers() {
    return libGetConfig().pricing_tiers || {};
}

function libLockerPrice() {
    return Number(libGetConfig().locker_price || 0);
}

function libTotalSeats() {
    let total = 0;
    const layout = libSeatLayout();
    Object.keys(layout).forEach(function(blockKey) {
        (layout[blockKey] || []).forEach(function(row) {
            total += (row.seats || []).length;
        });
    });
    return total;
}

function libDefaultBlock() {
    const blocks = Object.keys(libSeatLayout());
    return blocks.length ? blocks[0] : 'A';
}

function libDefaultForm(month) {
    return {
        name: '',
        phone: '',
        note: '',
        status: 'confirmed',
        months: [month || LIB_STATE.selectedMonth || LIB_STATE.currentMonth],
        block: libDefaultBlock(),
        seatId: '',
        slots: [],
        lockers: [],
        customPrice: '',
        paymentStatus: 'pending',
        paymentMethod: 'cash',
        paymentCollectedBy: '',
        paymentNote: ''
    };
}

function libSlotById(slotId) {
    return libSlotDefinitions().find(function(slot) {
        return slot.id === slotId;
    }) || null;
}

function libToggleValue(list, value) {
    if (list.indexOf(value) >= 0) {
        return list.filter(function(item) { return item !== value; });
    }
    return list.concat([value]);
}

function libComputeStats(bookings) {
    const stats = {
        total: bookings.length,
        confirmed: 0,
        secured: 0,
        collected: 0,
        pending: 0,
        lockersUsed: 0
    };
    const lockerSet = new Set();

    bookings.forEach(function(booking) {
        if (booking.status === 'confirmed') {
            stats.confirmed += 1;
        }
        if (booking.status === 'secured') {
            stats.secured += 1;
        }
        if (booking.payment && booking.payment.status === 'paid') {
            stats.collected += Number(booking.price || 0);
        } else {
            stats.pending += Number(booking.price || 0);
        }
        (booking.lockers || []).forEach(function(locker) {
            lockerSet.add(locker);
        });
    });

    stats.lockersUsed = lockerSet.size;
    return stats;
}

function libBuildOccupancy(bookings) {
    const occupancy = {};
    libSlotDefinitions().forEach(function(slot) {
        occupancy[slot.id] = {
            tables: new Set(),
            occA: 0,
            occB: 0
        };
    });

    bookings.forEach(function(booking) {
        (booking.slots || []).forEach(function(slotId) {
            if (!occupancy[slotId]) {
                occupancy[slotId] = { tables: new Set(), occA: 0, occB: 0 };
            }
            occupancy[slotId].tables.add(booking.seat_id);
        });
    });

    Object.keys(occupancy).forEach(function(slotId) {
        const seatIds = Array.from(occupancy[slotId].tables);
        occupancy[slotId].occA = seatIds.filter(function(seatId) { return String(seatId).indexOf('A_') === 0; }).length;
        occupancy[slotId].occB = seatIds.filter(function(seatId) { return String(seatId).indexOf('B_') === 0; }).length;
    });

    return occupancy;
}

function libBuildLockerStatus(bookings) {
    const status = {};
    libLockerNumbers().forEach(function(locker) {
        status[locker] = null;
    });
    bookings.forEach(function(booking) {
        (booking.lockers || []).forEach(function(locker) {
            if (!status[locker]) {
                status[locker] = booking;
            }
        });
    });
    return status;
}

function libSelectedBookings() {
    return LIB_STATE.selectedMonth ? LIB_STATE.monthBookings : LIB_STATE.previewBookings;
}

function libCurrentMonthLabel() {
    const month = LIB_STATE.selectedMonth || LIB_STATE.previewMonth;
    return LIB_MONTH_NAMES[month - 1] || '-';
}

function libFormPricePreview() {
    const form = LIB_STATE.form || libDefaultForm();
    const base = Number(libPricingTiers()[String((form.slots || []).length)] || 300);
    const auto = base + ((form.lockers || []).length * libLockerPrice());
    const custom = form.customPrice !== '' && form.customPrice !== null ? Number(form.customPrice) : null;
    const monthly = custom !== null && !isNaN(custom) ? custom : auto;

    return {
        auto: auto,
        monthly: monthly,
        total: monthly * ((form.months || []).length || 1)
    };
}

async function libApiPost(endpoint, payload) {
    const response = await fetch(API_URL + endpoint, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    });
    const result = await response.json();
    if (!response.ok || result.error) {
        throw new Error(result.message || 'Request failed.');
    }
    return result;
}

function libSyncConfigForm() {
    const config = libGetConfig();
    const pricing = config.pricing_tiers || {};
    LIB_STATE.configForm = {
        slotsJson: JSON.stringify(config.slot_definitions || [], null, 2),
        layoutJson: JSON.stringify(config.seat_layout || {}, null, 2),
        lockersCsv: (config.locker_numbers || []).join(', '),
        lockerPrice: String(config.locker_price || 0),
        price1: String(pricing['1'] || 0),
        price2: String(pricing['2'] || 0),
        price3: String(pricing['3'] || 0),
        price4: String(pricing['4'] || 0)
    };
}

async function libLoadBootstrap() {
    LIB_STATE.loading = true;
    libRender();

    try {
        const adminId = LIB_STATE.session.adminData.branch_id;
        const responses = await Promise.all([
            libApiPost('/admin/library/config', { admin_branch_id: adminId }),
            libApiPost('/admin/library/dashboard', { admin_branch_id: adminId, year: LIB_STATE.year }),
            libApiPost('/admin/library/bookings', { admin_branch_id: adminId, year: LIB_STATE.year, month: LIB_STATE.previewMonth })
        ]);

        LIB_STATE.config = responses[0].data.config;
        LIB_STATE.dashboard = responses[1].data;
        LIB_STATE.previewBookings = responses[2].data || [];
        LIB_STATE.homeSlot = libSlotDefinitions()[0] ? libSlotDefinitions()[0].id : 'A';
        LIB_STATE.seatsSlot = libSlotDefinitions()[0] ? libSlotDefinitions()[0].id : 'A';
        LIB_STATE.form = libDefaultForm(LIB_STATE.currentMonth);
        libSyncConfigForm();
    } catch (error) {
        toastr.error(error.message || 'Failed to load library data.');
    } finally {
        LIB_STATE.loading = false;
        libRender();
    }
}

async function libLoadDashboardAndPreview() {
    const adminId = LIB_STATE.session.adminData.branch_id;
    const dashboardResponse = await libApiPost('/admin/library/dashboard', {
        admin_branch_id: adminId,
        year: LIB_STATE.year
    });
    LIB_STATE.dashboard = dashboardResponse.data;

    const previewResponse = await libApiPost('/admin/library/bookings', {
        admin_branch_id: adminId,
        year: LIB_STATE.year,
        month: LIB_STATE.previewMonth
    });
    LIB_STATE.previewBookings = previewResponse.data || [];
}

async function libLoadSelectedMonthBookings(showLoader) {
    if (!LIB_STATE.selectedMonth) {
        return;
    }

    if (showLoader !== false) {
        LIB_STATE.loadingMonth = true;
        libRender();
    }

    try {
        const response = await libApiPost('/admin/library/bookings', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            year: LIB_STATE.year,
            month: LIB_STATE.selectedMonth
        });
        LIB_STATE.monthBookings = response.data || [];
    } catch (error) {
        toastr.error(error.message || 'Failed to load month data.');
    } finally {
        LIB_STATE.loadingMonth = false;
        libRender();
    }
}

async function libSetPreviewMonth(month) {
    LIB_STATE.previewMonth = month;
    LIB_STATE.loadingMonth = true;
    libRender();
    try {
        const response = await libApiPost('/admin/library/bookings', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            year: LIB_STATE.year,
            month: LIB_STATE.previewMonth
        });
        LIB_STATE.previewBookings = response.data || [];
    } catch (error) {
        toastr.error(error.message || 'Failed to load preview month.');
    } finally {
        LIB_STATE.loadingMonth = false;
        libRender();
    }
}

async function libChangeYear(delta) {
    LIB_STATE.year += delta;
    LIB_STATE.selectedMonth = null;
    LIB_STATE.activeTab = 'dashboard';
    LIB_STATE.loading = true;
    libRender();

    try {
        await libLoadDashboardAndPreview();
    } catch (error) {
        toastr.error(error.message || 'Failed to switch year.');
    } finally {
        LIB_STATE.loading = false;
        libRender();
    }
}

async function libOpenMonth(month) {
    LIB_STATE.selectedMonth = month;
    LIB_STATE.activeTab = 'dashboard';
    LIB_STATE.search = '';
    LIB_STATE.form = libDefaultForm(month);
    LIB_STATE.modal = null;
    await libLoadSelectedMonthBookings(true);
}

function libGoHome() {
    LIB_STATE.selectedMonth = null;
    LIB_STATE.activeTab = 'dashboard';
    LIB_STATE.search = '';
    LIB_STATE.modal = null;
    libRender();
}

function libOpenConfigTab() {
    LIB_STATE.selectedMonth = null;
    LIB_STATE.activeTab = 'config';
    LIB_STATE.modal = null;
    libRender();
}

async function libSetActiveTab(tab) {
    LIB_STATE.activeTab = tab;
    LIB_STATE.modal = null;
    if (tab === 'admit' && !LIB_STATE.form) {
        LIB_STATE.form = libDefaultForm(LIB_STATE.selectedMonth || LIB_STATE.currentMonth);
    }
    if (tab === 'admit') {
        await libRefreshAvailability(false);
        libRender();
    } else {
        libRender();
    }
}

async function libRefreshAvailability(showLoader) {
    const form = LIB_STATE.form || libDefaultForm();

    if (!(form.months || []).length || !(form.slots || []).length) {
        LIB_STATE.availability = {
            occupiedSeatIds: [],
            usedLockers: []
        };
        if (showLoader !== false) {
            libRender();
        }
        return;
    }

    LIB_STATE.availabilityLoading = true;
    if (showLoader !== false) {
        libRender();
    }

    try {
        const response = await libApiPost('/admin/library/availability', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            year: LIB_STATE.year,
            months: form.months,
            slots: form.slots
        });
        LIB_STATE.availability = {
            occupiedSeatIds: response.data.occupied_seat_ids || [],
            usedLockers: response.data.used_lockers || []
        };
    } catch (error) {
        toastr.error(error.message || 'Failed to load seat availability.');
    } finally {
        LIB_STATE.availabilityLoading = false;
        libRender();
    }
}

function libToggleFormMonth(month) {
    const form = LIB_STATE.form || libDefaultForm();
    form.months = libToggleValue(form.months || [], month).sort(function(a, b) { return a - b; });
    if (!form.months.length) {
        form.months = [LIB_STATE.selectedMonth || LIB_STATE.currentMonth];
    }
    form.seatId = '';
    LIB_STATE.form = form;
    libRefreshAvailability(true);
}

function libToggleFormSlot(slotId) {
    const form = LIB_STATE.form || libDefaultForm();
    form.slots = libToggleValue(form.slots || [], slotId);
    form.seatId = '';
    LIB_STATE.form = form;
    libRefreshAvailability(true);
}

function libSetFormBlock(block) {
    const form = LIB_STATE.form || libDefaultForm();
    form.block = block;
    form.seatId = '';
    LIB_STATE.form = form;
    libRender();
}

function libSelectFormSeat(seatId) {
    const form = LIB_STATE.form || libDefaultForm();
    form.seatId = seatId;
    LIB_STATE.form = form;
    libRender();
}

function libToggleLocker(lockerNumber) {
    const form = LIB_STATE.form || libDefaultForm();
    form.lockers = libToggleValue(form.lockers || [], lockerNumber).sort(function(a, b) { return a - b; });
    LIB_STATE.form = form;
    libRender();
}

function libSetFormStatus(status) {
    const form = LIB_STATE.form || libDefaultForm();
    form.status = status;
    LIB_STATE.form = form;
    libRender();
}

function libSetPaymentStatus(status) {
    const form = LIB_STATE.form || libDefaultForm();
    form.paymentStatus = status;
    LIB_STATE.form = form;
    libRender();
}

function libSetPaymentMethod(method) {
    const form = LIB_STATE.form || libDefaultForm();
    form.paymentMethod = method;
    LIB_STATE.form = form;
    libRender();
}

function libSetCustomPrice(value) {
    const form = LIB_STATE.form || libDefaultForm();
    form.customPrice = value;
    LIB_STATE.form = form;
    libRender();
}

function libSetFormField(field, value) {
    const form = LIB_STATE.form || libDefaultForm();
    form[field] = value;
    LIB_STATE.form = form;
}

async function libSubmitAdmission() {
    const form = LIB_STATE.form || libDefaultForm();
    const name = form.name || '';
    const phone = form.phone || '';
    const note = form.note || '';
    const collectedBy = form.paymentCollectedBy || '';
    const paymentNote = form.paymentNote || '';

    if (!name.trim()) {
        toastr.error('Name is required.');
        return;
    }
    if (!(form.slots || []).length) {
        toastr.error('Select at least one slot.');
        return;
    }
    if (!(form.months || []).length) {
        toastr.error('Select at least one month.');
        return;
    }
    if (!form.seatId) {
        toastr.error('Select a seat.');
        return;
    }
    if (form.paymentStatus === 'paid' && !collectedBy.trim()) {
        toastr.error('Collected by is required for paid entry.');
        return;
    }

    const priceValue = form.customPrice !== '' && form.customPrice !== null ? Number(form.customPrice) : null;

    try {
        await libApiPost('/admin/library/admit', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            name: name.trim(),
            phone: phone.trim() || null,
            note: note.trim() || null,
            year: LIB_STATE.year,
            months: form.months,
            status: form.status,
            block: form.block,
            seat_id: form.seatId,
            slots: form.slots,
            lockers: form.lockers || [],
            custom_price: priceValue,
            payment_status: form.paymentStatus,
            payment_method: form.paymentStatus === 'paid' ? form.paymentMethod : null,
            payment_collected_by: form.paymentStatus === 'paid' ? collectedBy.trim() : null,
            payment_note: form.paymentStatus === 'paid' ? paymentNote.trim() : null
        });

        toastr.success('Library member admitted successfully.');
        LIB_STATE.form = libDefaultForm(LIB_STATE.selectedMonth || LIB_STATE.currentMonth);
        await libLoadDashboardAndPreview();
        if (LIB_STATE.selectedMonth) {
            await libLoadSelectedMonthBookings(false);
            LIB_STATE.activeTab = 'members';
        }
        libRender();
    } catch (error) {
        toastr.error(error.message || 'Failed to admit member.');
    }
}

function libHandleSearch(value) {
    LIB_STATE.search = value;
    libRender();
}

function libFilteredBookings() {
    const search = (LIB_STATE.search || '').trim().toLowerCase();
    if (!search) {
        return LIB_STATE.monthBookings;
    }

    return LIB_STATE.monthBookings.filter(function(booking) {
        return (booking.name || '').toLowerCase().indexOf(search) >= 0
            || (booking.phone || '').toLowerCase().indexOf(search) >= 0
            || (booking.seat_label || '').toLowerCase().indexOf(search) >= 0
            || (booking.seat_id || '').toLowerCase().indexOf(search) >= 0;
    });
}

function libOpenModal(type, bookingId) {
    const booking = LIB_STATE.monthBookings.find(function(item) {
        return Number(item.booking_id) === Number(bookingId);
    });
    if (!booking) {
        return;
    }

    LIB_STATE.modal = {
        type: type,
        booking: booking,
        price: booking.price,
        payMethod: 'cash',
        payCollectedBy: '',
        payNote: '',
        extendMonths: []
    };
    libRender();
}

function libCloseModal() {
    LIB_STATE.modal = null;
    libRender();
}

function libSetModalPrice(value) {
    if (!LIB_STATE.modal) return;
    LIB_STATE.modal.price = value;
}

function libSetModalField(field, value) {
    if (!LIB_STATE.modal) return;
    LIB_STATE.modal[field] = value;
}

function libSetModalPayMethod(value) {
    if (!LIB_STATE.modal) return;
    LIB_STATE.modal.payMethod = value;
    libRender();
}

function libSetModalExtendMonth(month) {
    if (!LIB_STATE.modal) return;
    const extendMonths = LIB_STATE.modal.extendMonths || [];
    LIB_STATE.modal.extendMonths = libToggleValue(extendMonths, month).sort(function(a, b) { return a - b; });
    libRender();
}

async function libConfirmBookingAction() {
    if (!LIB_STATE.modal) return;
    try {
        await libApiPost('/admin/library/booking/confirm', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            booking_id: LIB_STATE.modal.booking.booking_id
        });
        toastr.success('Booking confirmed.');
        LIB_STATE.modal = null;
        await libLoadDashboardAndPreview();
        await libLoadSelectedMonthBookings(false);
    } catch (error) {
        toastr.error(error.message || 'Failed to confirm booking.');
    }
}

async function libSavePriceAction() {
    if (!LIB_STATE.modal) return;
    const price = Number(LIB_STATE.modal.price);
    if (isNaN(price) || price < 0) {
        toastr.error('Enter a valid price.');
        return;
    }

    try {
        await libApiPost('/admin/library/booking/update_price', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            booking_id: LIB_STATE.modal.booking.booking_id,
            monthly_price: price
        });
        toastr.success('Price updated.');
        LIB_STATE.modal = null;
        await libLoadDashboardAndPreview();
        await libLoadSelectedMonthBookings(false);
    } catch (error) {
        toastr.error(error.message || 'Failed to update price.');
    }
}

async function libRecordPaymentAction() {
    if (!LIB_STATE.modal) return;
    const collectedBy = LIB_STATE.modal.payCollectedBy || '';
    const note = LIB_STATE.modal.payNote || '';
    if (!collectedBy.trim()) {
        toastr.error('Collected by is required.');
        return;
    }

    try {
        await libApiPost('/admin/library/booking/record_payment', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            booking_id: LIB_STATE.modal.booking.booking_id,
            payment_method: LIB_STATE.modal.payMethod || 'cash',
            payment_collected_by: collectedBy.trim(),
            payment_note: note.trim() || null
        });
        toastr.success('Payment recorded.');
        LIB_STATE.modal = null;
        await libLoadDashboardAndPreview();
        await libLoadSelectedMonthBookings(false);
    } catch (error) {
        toastr.error(error.message || 'Failed to record payment.');
    }
}

async function libExtendBookingAction() {
    if (!LIB_STATE.modal) return;
    const months = LIB_STATE.modal.extendMonths || [];
    if (!months.length) {
        toastr.error('Select at least one month to extend.');
        return;
    }

    try {
        const result = await libApiPost('/admin/library/booking/extend', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            booking_id: LIB_STATE.modal.booking.booking_id,
            year: LIB_STATE.year,
            months: months
        });
        const data = result.data || {};
        const created = (data.created_months || []).map(function(item) {
            return LIB_MONTH_NAMES[item.month - 1];
        }).filter(Boolean);
        const skipped = (data.skipped_months || []).map(function(item) {
            return LIB_MONTH_NAMES[item.month - 1] + ': ' + item.reason;
        });

        if (created.length) {
            toastr.success('Extended to ' + created.join(', ') + '.');
        } else {
            toastr.info('No new months were added.');
        }
        if (skipped.length) {
            toastr.warning(skipped.join(' | '));
        }

        LIB_STATE.modal = null;
        await libLoadDashboardAndPreview();
        await libLoadSelectedMonthBookings(false);
    } catch (error) {
        toastr.error(error.message || 'Failed to extend booking.');
    }
}

async function libDeleteBookingAction(scope) {
    if (!LIB_STATE.modal) return;
    try {
        await libApiPost('/admin/library/booking/delete', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            booking_id: LIB_STATE.modal.booking.booking_id,
            scope: scope
        });
        toastr.success(scope === 'all' ? 'Removed from all months.' : 'Removed from current month.');
        LIB_STATE.modal = null;
        await libLoadDashboardAndPreview();
        await libLoadSelectedMonthBookings(false);
    } catch (error) {
        toastr.error(error.message || 'Failed to delete booking.');
    }
}

function libUpdateConfigField(field, value) {
    LIB_STATE.configForm[field] = value;
}

async function libSaveConfig() {
    let slotDefinitions;
    let seatLayout;
    let lockerNumbers;

    try {
        slotDefinitions = JSON.parse(LIB_STATE.configForm.slotsJson || '[]');
    } catch (error) {
        toastr.error('Slot definitions JSON is invalid.');
        return;
    }

    try {
        seatLayout = JSON.parse(LIB_STATE.configForm.layoutJson || '{}');
    } catch (error) {
        toastr.error('Seat layout JSON is invalid.');
        return;
    }

    lockerNumbers = (LIB_STATE.configForm.lockersCsv || '')
        .split(',')
        .map(function(value) { return Number(String(value).trim()); })
        .filter(function(value) { return !isNaN(value); });

    if (!slotDefinitions.length) {
        toastr.error('Add at least one slot definition.');
        return;
    }

    if (!Object.keys(seatLayout).length) {
        toastr.error('Seat layout cannot be empty.');
        return;
    }

    try {
        const result = await libApiPost('/admin/library/config/update', {
            admin_branch_id: LIB_STATE.session.adminData.branch_id,
            slot_definitions: slotDefinitions,
            seat_layout: seatLayout,
            locker_numbers: lockerNumbers,
            locker_price: Number(LIB_STATE.configForm.lockerPrice || 0),
            pricing_tiers: {
                '1': Number(LIB_STATE.configForm.price1 || 0),
                '2': Number(LIB_STATE.configForm.price2 || 0),
                '3': Number(LIB_STATE.configForm.price3 || 0),
                '4': Number(LIB_STATE.configForm.price4 || 0)
            }
        });

        LIB_STATE.config = result.data.config;
        LIB_STATE.homeSlot = libSlotDefinitions()[0] ? libSlotDefinitions()[0].id : 'A';
        LIB_STATE.seatsSlot = libSlotDefinitions()[0] ? libSlotDefinitions()[0].id : 'A';
        LIB_STATE.form = libDefaultForm(LIB_STATE.selectedMonth || LIB_STATE.currentMonth);
        libSyncConfigForm();
        await libLoadDashboardAndPreview();
        if (LIB_STATE.selectedMonth) {
            await libLoadSelectedMonthBookings(false);
        }
        toastr.success('Library config saved.');
        libRender();
    } catch (error) {
        toastr.error(error.message || 'Failed to save config.');
    }
}

function libRenderMonthCards() {
    const months = (LIB_STATE.dashboard && LIB_STATE.dashboard.months) || [];
    return months.map(function(monthData) {
        const isActive = Number(monthData.month) === Number(LIB_STATE.previewMonth);
        const progressColor = monthData.occupancy_percent > 70 ? '#ef4444' : (monthData.occupancy_percent > 40 ? '#f59e0b' : '#10b981');
        return '' +
            '<div class="lib-month-card ' + (isActive ? 'active' : '') + '" onclick="libSetPreviewMonth(' + monthData.month + ')">' +
                '<div class="lib-month-name font-HellixB">' + libEsc(monthData.month_label) + '</div>' +
                '<div class="lib-mini-label font-HellixB">Students</div>' +
                '<div class="font-HellixB" style="font-size:22px;margin:4px 0 6px;">' + monthData.total_bookings + '</div>' +
                '<div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:8px;">' +
                    (monthData.confirmed_count ? '<span class="lib-badge" style="background:#dcfce7;color:#166534;">' + monthData.confirmed_count + ' confirmed</span>' : '') +
                    (monthData.secured_count ? '<span class="lib-badge" style="background:#fef3c7;color:#b45309;">' + monthData.secured_count + ' hold</span>' : '') +
                '</div>' +
                '<div class="lib-progress"><span style="width:' + monthData.occupancy_percent + '%;background:' + progressColor + ';"></span></div>' +
                '<div class="lib-month-muted font-HellixR" style="margin-top:6px;">' + monthData.occupancy_percent + '% occupied</div>' +
            '</div>';
    }).join('');
}

function libRenderSeatMap(bookings, slotId, compact) {
    const slot = libSlotById(slotId) || { color: '#111827', label: 'Slot' };
    const occupancy = libBuildOccupancy(bookings);
    const slotData = occupancy[slotId] || { tables: new Set(), occA: 0, occB: 0 };
    const layout = libSeatLayout();

    return Object.keys(layout).map(function(blockKey) {
        return '' +
            '<div class="lib-seat-block">' +
                '<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">' +
                    '<div class="font-HellixB" style="font-size:14px;color:#111827;">Block ' + libEsc(blockKey) + '</div>' +
                    '<div class="lib-inline-note font-HellixR">' + ((blockKey === 'A' ? slotData.occA : slotData.occB)) + ' occupied</div>' +
                '</div>' +
                (layout[blockKey] || []).map(function(row) {
                    return '' +
                        '<div class="lib-seat-row">' +
                            '<div class="lib-seat-row-label font-HellixB">Row ' + libEsc(row.row) + '</div>' +
                            '<div class="lib-seat-wrap">' +
                                (row.seats || []).map(function(seatNumber) {
                                    const seatId = blockKey + '_' + row.row + seatNumber;
                                    const isFree = !slotData.tables.has(seatId);
                                    const booking = isFree ? null : bookings.find(function(item) {
                                        return item.seat_id === seatId && (item.slots || []).indexOf(slotId) >= 0;
                                    });
                                    return '<div class="lib-seat ' + (compact ? 'small ' : '') + (isFree ? 'free' : 'taken') + '" title="' + libEsc(isFree ? (row.row + seatNumber + ': Free') : ((row.row + seatNumber) + ': ' + (booking ? booking.name : 'Occupied'))) + '" style="' + (compact ? '' : 'cursor:default;') + '">' + libEsc(row.row + seatNumber) + '</div>';
                                }).join('') +
                            '</div>' +
                        '</div>';
                }).join('') +
            '</div>';
    }).join('');
}

function libRenderHome() {
    const bookings = LIB_STATE.previewBookings || [];
    const stats = libComputeStats(bookings);
    const lockerStatus = libBuildLockerStatus(bookings);
    const occupancy = libBuildOccupancy(bookings);
    const activeSlotId = LIB_STATE.homeSlot || (libSlotDefinitions()[0] ? libSlotDefinitions()[0].id : 'A');

    return '' +
        '<div class="lib-section">' +
            '<div style="display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;margin-bottom:18px;">' +
                '<div>' +
                    '<div class="lib-mini-label font-HellixB">Library Year</div>' +
                    '<div class="font-HellixB" style="font-size:24px;color:#111827;margin-top:4px;">' + LIB_STATE.year + '</div>' +
                '</div>' +
                '<div style="display:flex;gap:10px;flex-wrap:wrap;">' +
                    '<button class="lib-btn lib-btn-light font-HellixB" onclick="libChangeYear(-1)">← ' + (LIB_STATE.year - 1) + '</button>' +
                    '<button class="lib-btn lib-btn-light font-HellixB" onclick="libChangeYear(1)">' + (LIB_STATE.year + 1) + ' →</button>' +
                    '<button class="lib-btn lib-btn-dark font-HellixB" onclick="libOpenMonth(' + LIB_STATE.previewMonth + ')">Open ' + libEsc(libCurrentMonthLabel()) + '</button>' +
                '</div>' +
            '</div>' +

            '<div class="lib-home-grid">' +
                '<div class="lib-card" style="padding:18px;">' +
                    '<div class="lib-mini-label font-HellixB" style="margin-bottom:10px;">Months</div>' +
                    '<div class="lib-month-grid">' + libRenderMonthCards() + '</div>' +
                '</div>' +

                '<div style="display:flex;flex-direction:column;gap:16px;">' +
                    '<div class="lib-card" style="padding:20px;">' +
                        '<div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;margin-bottom:16px;">' +
                            '<div>' +
                                '<div class="font-HellixB" style="font-size:20px;color:#111827;">' + libEsc(libCurrentMonthLabel()) + ' ' + LIB_STATE.year + ' Dashboard</div>' +
                                '<div class="lib-inline-note font-HellixR">Preview month for library operations.</div>' +
                            '</div>' +
                            '<button class="lib-btn lib-btn-light font-HellixB" onclick="libOpenMonth(' + LIB_STATE.previewMonth + ')">Manage Month</button>' +
                        '</div>' +
                        '<div class="lib-stat-grid">' +
                            '<div class="lib-stat-card"><div class="lib-stat-value font-HellixB" style="color:#111827;">' + stats.total + '</div><div class="lib-stat-label font-HellixB">Total Members</div></div>' +
                            '<div class="lib-stat-card"><div class="lib-stat-value font-HellixB" style="color:#16a34a;">' + stats.confirmed + '</div><div class="lib-stat-label font-HellixB">Confirmed</div></div>' +
                            '<div class="lib-stat-card"><div class="lib-stat-value font-HellixB" style="color:#d97706;">' + stats.secured + '</div><div class="lib-stat-label font-HellixB">On Hold</div></div>' +
                            '<div class="lib-stat-card"><div class="lib-stat-value font-HellixB" style="color:#7c3aed;">' + stats.lockersUsed + '</div><div class="lib-stat-label font-HellixB">Lockers Used</div></div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="lib-card" style="padding:20px;">' +
                        '<div class="lib-mini-label font-HellixB" style="margin-bottom:10px;">Revenue</div>' +
                        '<div class="lib-revenue-row">' +
                            '<div class="lib-info-card"><div class="font-HellixB" style="font-size:20px;color:#111827;">' + libInr(stats.collected + stats.pending) + '</div><div class="lib-inline-note font-HellixR">Expected</div></div>' +
                            '<div class="lib-info-card"><div class="font-HellixB" style="font-size:20px;color:#16a34a;">' + libInr(stats.collected) + '</div><div class="lib-inline-note font-HellixR">Collected</div></div>' +
                            '<div class="lib-info-card"><div class="font-HellixB" style="font-size:20px;color:#dc2626;">' + libInr(stats.pending) + '</div><div class="lib-inline-note font-HellixR">Pending</div></div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="lib-card" style="padding:20px;">' +
                        '<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:12px;">' +
                            '<div class="lib-mini-label font-HellixB">Slots & Seat Map</div>' +
                            '<div class="lib-slot-strip">' +
                                libSlotDefinitions().map(function(slot) {
                                    const slotOcc = occupancy[slot.id] || { tables: new Set() };
                                    return '<button class="lib-pill ' + (activeSlotId === slot.id ? 'active' : '') + ' font-HellixB" style="' + (activeSlotId === slot.id ? ('background:' + slot.color + ';border-color:' + slot.color + ';') : '') + '" onclick="LIB_STATE.homeSlot=\'' + libEsc(slot.id) + '\';libRender()">' + libEsc(slot.label) + '</button>';
                                }).join('') +
                            '</div>' +
                        '</div>' +
                        '<div class="lib-grid-three" style="margin-bottom:14px;">' +
                            libSlotDefinitions().map(function(slot) {
                                const slotOcc = occupancy[slot.id] || { tables: new Set() };
                                const occupiedCount = slotOcc.tables ? slotOcc.tables.size : 0;
                                const freeCount = libTotalSeats() - occupiedCount;
                                return '<div class="lib-info-card"><div class="font-HellixB" style="font-size:18px;color:' + libEsc(slot.color) + ';">' + freeCount + '</div><div class="font-HellixB" style="font-size:12px;color:#111827;margin-bottom:3px;">' + libEsc(slot.label) + '</div><div class="lib-inline-note font-HellixR">' + libEsc(slot.time) + ' · ' + occupiedCount + ' occupied</div></div>';
                            }).join('') +
                        '</div>' +
                        '<div class="lib-seat-blocks">' + libRenderSeatMap(bookings, activeSlotId, true) + '</div>' +
                    '</div>' +

                    '<div class="lib-card" style="padding:20px;">' +
                        '<div class="lib-mini-label font-HellixB" style="margin-bottom:12px;">Lockers</div>' +
                        '<div class="lib-locker-grid">' +
                            libLockerNumbers().map(function(locker) {
                                const owner = lockerStatus[locker];
                                return '<div class="lib-locker-card"><div class="font-HellixB" style="font-size:18px;color:' + (owner ? '#7c3aed' : '#111827') + ';">Locker ' + locker + '</div><div class="lib-inline-note font-HellixR" style="margin-top:4px;">' + (owner ? libEsc(owner.name + ' · ' + owner.seat_label) : 'Available') + '</div></div>';
                            }).join('') +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>';
}

function libRenderMonthOverview() {
    const bookings = LIB_STATE.monthBookings || [];
    const stats = libComputeStats(bookings);
    const occupancy = libBuildOccupancy(bookings);
    const totalSeats = libTotalSeats();

    return '' +
        '<div style="display:flex;flex-direction:column;gap:16px;">' +
            '<div class="lib-stat-grid">' +
                '<div class="lib-stat-card"><div class="lib-stat-value font-HellixB" style="color:#111827;">' + stats.total + '</div><div class="lib-stat-label font-HellixB">Members</div></div>' +
                '<div class="lib-stat-card"><div class="lib-stat-value font-HellixB" style="color:#16a34a;">' + stats.confirmed + '</div><div class="lib-stat-label font-HellixB">Confirmed</div></div>' +
                '<div class="lib-stat-card"><div class="lib-stat-value font-HellixB" style="color:#d97706;">' + stats.secured + '</div><div class="lib-stat-label font-HellixB">On Hold</div></div>' +
                '<div class="lib-stat-card"><div class="lib-stat-value font-HellixB" style="color:#7c3aed;">' + stats.lockersUsed + '</div><div class="lib-stat-label font-HellixB">Lockers Used</div></div>' +
            '</div>' +

            '<div class="lib-card" style="padding:20px;">' +
                '<div class="lib-mini-label font-HellixB" style="margin-bottom:10px;">Revenue</div>' +
                '<div class="lib-revenue-row">' +
                    '<div class="lib-info-card"><div class="font-HellixB" style="font-size:20px;color:#111827;">' + libInr(stats.collected + stats.pending) + '</div><div class="lib-inline-note font-HellixR">Expected</div></div>' +
                    '<div class="lib-info-card"><div class="font-HellixB" style="font-size:20px;color:#16a34a;">' + libInr(stats.collected) + '</div><div class="lib-inline-note font-HellixR">Collected</div></div>' +
                    '<div class="lib-info-card"><div class="font-HellixB" style="font-size:20px;color:#dc2626;">' + libInr(stats.pending) + '</div><div class="lib-inline-note font-HellixR">Pending</div></div>' +
                '</div>' +
            '</div>' +

            '<div class="lib-grid-two">' +
                libSlotDefinitions().map(function(slot) {
                    const slotOcc = occupancy[slot.id] || { tables: new Set(), occA: 0, occB: 0 };
                    const occupiedCount = slotOcc.tables ? slotOcc.tables.size : 0;
                    const freeCount = totalSeats - occupiedCount;
                    const percent = totalSeats ? Math.round((occupiedCount / totalSeats) * 100) : 0;
                    return '<div class="lib-card" style="padding:20px;border-left:4px solid ' + libEsc(slot.color) + ';">' +
                        '<div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:10px;">' +
                            '<div><div class="font-HellixB" style="font-size:16px;color:#111827;">' + libEsc(slot.label) + '</div><div class="lib-inline-note font-HellixR">' + libEsc(slot.time) + '</div></div>' +
                            '<div class="font-HellixB" style="font-size:24px;color:' + libEsc(slot.color) + ';">' + freeCount + '</div>' +
                        '</div>' +
                        '<div class="lib-progress"><span style="width:' + percent + '%;background:' + libEsc(slot.color) + ';"></span></div>' +
                        '<div style="display:flex;justify-content:space-between;gap:12px;margin-top:10px;flex-wrap:wrap;"><div class="lib-inline-note font-HellixR">Block A occupied: ' + slotOcc.occA + '</div><div class="lib-inline-note font-HellixR">Block B occupied: ' + slotOcc.occB + '</div><div class="lib-inline-note font-HellixR">' + occupiedCount + ' occupied</div></div>' +
                    '</div>';
                }).join('') +
            '</div>' +
        '</div>';
}

function libRenderAdmit() {
    const form = LIB_STATE.form || libDefaultForm(LIB_STATE.selectedMonth || LIB_STATE.currentMonth);
    const pricePreview = libFormPricePreview();
    const seatLayout = libSeatLayout();
    const occupiedSeats = new Set(LIB_STATE.availability.occupiedSeatIds || []);
    const usedLockers = new Set(LIB_STATE.availability.usedLockers || []);

    return '' +
        '<div class="lib-grid-two">' +
            '<div class="lib-card" style="padding:20px;">' +
                '<div class="font-HellixB" style="font-size:18px;color:#111827;margin-bottom:16px;">Admit Library Member</div>' +

                '<div class="lib-grid-two" style="margin-bottom:14px;">' +
                    '<div><label class="lib-label font-HellixB">Name</label><input id="libMemberName" class="lib-input font-HellixR" placeholder="Full name" value="' + libEsc(form.name || '') + '" oninput="libSetFormField(\'name\', this.value)"></div>' +
                    '<div><label class="lib-label font-HellixB">Phone</label><input id="libMemberPhone" class="lib-input font-HellixR" placeholder="Phone number" value="' + libEsc(form.phone || '') + '" oninput="libSetFormField(\'phone\', this.value)"></div>' +
                '</div>' +

                '<div style="margin-bottom:14px;">' +
                    '<label class="lib-label font-HellixB">Status</label>' +
                    '<div class="lib-slot-strip">' +
                        '<button class="lib-pill ' + (form.status === 'confirmed' ? 'soft-active' : '') + ' font-HellixB" onclick="libSetFormStatus(\'confirmed\')">Confirmed</button>' +
                        '<button class="lib-pill ' + (form.status === 'secured' ? 'soft-active' : '') + ' font-HellixB" onclick="libSetFormStatus(\'secured\')">Secured / Hold</button>' +
                    '</div>' +
                '</div>' +

                '<div style="margin-bottom:14px;">' +
                    '<label class="lib-label font-HellixB">Note</label>' +
                    '<input id="libMemberNote" class="lib-input font-HellixR" placeholder="Optional note or hold reason" value="' + libEsc(form.note || '') + '" oninput="libSetFormField(\'note\', this.value)">' +
                '</div>' +

                '<div style="margin-bottom:14px;">' +
                    '<label class="lib-label font-HellixB">Months</label>' +
                    '<div class="lib-slot-strip">' +
                        LIB_MONTH_NAMES.map(function(monthName, index) {
                            const monthNumber = index + 1;
                            return '<button class="lib-pill ' + ((form.months || []).indexOf(monthNumber) >= 0 ? 'soft-active' : '') + ' font-HellixB" onclick="libToggleFormMonth(' + monthNumber + ')">' + monthName + '</button>';
                        }).join('') +
                    '</div>' +
                '</div>' +

                '<div style="margin-bottom:14px;">' +
                    '<label class="lib-label font-HellixB">Slots</label>' +
                    '<div class="lib-slot-strip">' +
                        libSlotDefinitions().map(function(slot) {
                            const active = (form.slots || []).indexOf(slot.id) >= 0;
                            return '<button class="lib-pill ' + (active ? 'active' : '') + ' font-HellixB" style="' + (active ? ('background:' + slot.color + ';border-color:' + slot.color + ';') : '') + '" onclick="libToggleFormSlot(\'' + libEsc(slot.id) + '\')">' + libEsc(slot.label) + ' <span style="opacity:0.7;">' + libEsc(slot.time) + '</span></button>';
                        }).join('') +
                    '</div>' +
                '</div>' +

                '<div style="margin-bottom:14px;">' +
                    '<label class="lib-label font-HellixB">Block</label>' +
                    '<div class="lib-slot-strip">' +
                        Object.keys(seatLayout).map(function(blockKey) {
                            return '<button class="lib-pill ' + (form.block === blockKey ? 'soft-active' : '') + ' font-HellixB" onclick="libSetFormBlock(\'' + libEsc(blockKey) + '\')">Block ' + libEsc(blockKey) + '</button>';
                        }).join('') +
                    '</div>' +
                '</div>' +

                '<div style="margin-bottom:14px;">' +
                    '<label class="lib-label font-HellixB">Seat</label>' +
                    (LIB_STATE.availabilityLoading ? '<div class="lib-inline-note font-HellixR">Checking seat availability...</div>' : '') +
                    '<div class="lib-seat-block">' +
                        (seatLayout[form.block] || []).map(function(row) {
                            return '<div class="lib-seat-row"><div class="lib-seat-row-label font-HellixB">Row ' + libEsc(row.row) + '</div><div class="lib-seat-wrap">' +
                                (row.seats || []).map(function(seatNumber) {
                                    const seatId = form.block + '_' + row.row + seatNumber;
                                    const isTaken = occupiedSeats.has(seatId);
                                    const isSelected = form.seatId === seatId;
                                    return '<button type="button" class="lib-seat ' + (isSelected ? 'selected' : (isTaken ? 'taken' : 'free')) + '" ' + (isTaken ? 'disabled' : '') + ' onclick="libSelectFormSeat(\'' + libEsc(seatId) + '\')">' + libEsc(row.row + seatNumber) + '</button>';
                                }).join('') +
                            '</div></div>';
                        }).join('') +
                    '</div>' +
                '</div>' +

                '<div style="margin-bottom:14px;">' +
                    '<label class="lib-label font-HellixB">Lockers</label>' +
                    '<div class="lib-slot-strip">' +
                        libLockerNumbers().map(function(lockerNumber) {
                            const active = (form.lockers || []).indexOf(lockerNumber) >= 0;
                            const disabled = usedLockers.has(lockerNumber) && !active;
                            return '<button class="lib-pill ' + (active ? 'soft-active' : '') + ' font-HellixB" ' + (disabled ? 'disabled' : '') + ' onclick="libToggleLocker(' + lockerNumber + ')">Locker ' + lockerNumber + '</button>';
                        }).join('') +
                    '</div>' +
                '</div>' +

                '<button class="lib-btn lib-btn-dark font-HellixB" onclick="libSubmitAdmission()">Save Library Admission</button>' +
            '</div>' +

            '<div style="display:flex;flex-direction:column;gap:16px;">' +
                '<div class="lib-card" style="padding:20px;">' +
                    '<div class="font-HellixB" style="font-size:18px;color:#111827;margin-bottom:14px;">Monthly Price</div>' +
                    '<div class="lib-info-grid" style="grid-template-columns:1fr 1fr; margin-bottom:14px;">' +
                        '<div class="lib-info-card"><div class="font-HellixB" style="font-size:20px;color:#111827;">' + libInr(pricePreview.auto) + '</div><div class="lib-inline-note font-HellixR">Auto price</div></div>' +
                        '<div class="lib-info-card"><div class="font-HellixB" style="font-size:20px;color:#2563eb;">' + libInr(pricePreview.total) + '</div><div class="lib-inline-note font-HellixR">Total for selected months</div></div>' +
                    '</div>' +
                    '<label class="lib-label font-HellixB">Custom Monthly Price</label>' +
                    '<input class="lib-input font-HellixR" type="number" placeholder="Leave blank for auto price" value="' + libEsc(form.customPrice || '') + '" oninput="libSetCustomPrice(this.value)">' +
                    '<div class="lib-inline-note font-HellixR" style="margin-top:8px;">' +
                        'Slots: ' + ((form.slots || []).length || 0) + ' · Lockers: ' + ((form.lockers || []).length || 0) + ' · Locker price: ' + libInr(libLockerPrice()) +
                    '</div>' +
                '</div>' +

                '<div class="lib-card" style="padding:20px;">' +
                    '<div class="font-HellixB" style="font-size:18px;color:#111827;margin-bottom:14px;">Payment at Admission</div>' +
                    '<div class="lib-slot-strip" style="margin-bottom:14px;">' +
                        '<button class="lib-pill ' + (form.paymentStatus === 'pending' ? 'soft-active' : '') + ' font-HellixB" onclick="libSetPaymentStatus(\'pending\')">Pending</button>' +
                        '<button class="lib-pill ' + (form.paymentStatus === 'paid' ? 'soft-active' : '') + ' font-HellixB" onclick="libSetPaymentStatus(\'paid\')">Paid Now</button>' +
                    '</div>' +
                    (form.paymentStatus === 'paid' ? '' +
                        '<div style="margin-bottom:14px;">' +
                            '<label class="lib-label font-HellixB">Method</label>' +
                            '<div class="lib-slot-strip">' +
                                '<button class="lib-pill ' + (form.paymentMethod === 'cash' ? 'soft-active' : '') + ' font-HellixB" onclick="libSetPaymentMethod(\'cash\')">Cash</button>' +
                                '<button class="lib-pill ' + (form.paymentMethod === 'gpay' ? 'soft-active' : '') + ' font-HellixB" onclick="libSetPaymentMethod(\'gpay\')">GPay</button>' +
                            '</div>' +
                        '</div>' +
                        '<div style="margin-bottom:14px;"><label class="lib-label font-HellixB">Collected By</label><input id="libPaymentCollectedBy" class="lib-input font-HellixR" placeholder="Staff name" value="' + libEsc(form.paymentCollectedBy || '') + '" oninput="libSetFormField(\'paymentCollectedBy\', this.value)"></div>' +
                        '<div><label class="lib-label font-HellixB">Payment Note</label><input id="libPaymentNote" class="lib-input font-HellixR" placeholder="Optional payment note" value="' + libEsc(form.paymentNote || '') + '" oninput="libSetFormField(\'paymentNote\', this.value)"></div>'
                        : '<div class="lib-inline-note font-HellixR">Payment will stay pending until you record it from the Members tab.</div>') +
                '</div>' +
            '</div>' +
        '</div>';
}

function libRenderSeats() {
    const slotId = LIB_STATE.seatsSlot || (libSlotDefinitions()[0] ? libSlotDefinitions()[0].id : 'A');
    return '' +
        '<div style="display:flex;flex-direction:column;gap:16px;">' +
            '<div class="lib-slot-strip">' +
                libSlotDefinitions().map(function(slot) {
                    return '<button class="lib-pill ' + (slotId === slot.id ? 'active' : '') + ' font-HellixB" style="' + (slotId === slot.id ? ('background:' + slot.color + ';border-color:' + slot.color + ';') : '') + '" onclick="LIB_STATE.seatsSlot=\'' + libEsc(slot.id) + '\';libRender()">' + libEsc(slot.label) + '</button>';
                }).join('') +
            '</div>' +
            '<div class="lib-seat-blocks">' + libRenderSeatMap(LIB_STATE.monthBookings || [], slotId, false) + '</div>' +
        '</div>';
}

function libRenderMembers() {
    const bookings = libFilteredBookings();
    if (!bookings.length) {
        return '<div class="lib-empty font-HellixR">No library members found for this month.</div>';
    }

    return '' +
        '<div style="display:flex;flex-direction:column;gap:16px;">' +
            '<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">' +
                '<input class="lib-input font-HellixR" style="max-width:320px;" placeholder="Search name, phone, seat..." value="' + libEsc(LIB_STATE.search || '') + '" oninput="libHandleSearch(this.value)">' +
                '<button class="lib-btn lib-btn-dark font-HellixB" onclick="libSetActiveTab(\'admit\')">+ Admit</button>' +
            '</div>' +
            '<div class="lib-member-list">' +
                bookings.map(function(booking) {
                    const statusBadge = booking.status === 'confirmed'
                        ? '<span class="lib-badge" style="background:#dcfce7;color:#166534;">Confirmed</span>'
                        : '<span class="lib-badge" style="background:#fef3c7;color:#b45309;">Secured</span>';
                    const paymentBadge = booking.payment && booking.payment.status === 'paid'
                        ? '<span class="lib-badge" style="background:#dbeafe;color:#1d4ed8;">Paid · ' + libEsc((booking.payment.method || '').toUpperCase()) + '</span>'
                        : '<span class="lib-badge" style="background:#fee2e2;color:#b91c1c;">Pending Payment</span>';

                    return '' +
                        '<div class="lib-member-card">' +
                            '<div class="lib-member-top">' +
                                '<div style="min-width:0;">' +
                                    '<div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;margin-bottom:8px;">' +
                                        '<div class="font-HellixB" style="font-size:18px;color:#111827;">' + libEsc(booking.name) + '</div>' +
                                        '<span class="lib-badge" style="background:#f3f4f6;color:#111827;">' + libEsc(booking.block) + ' · ' + libEsc(booking.seat_label) + '</span>' +
                                        statusBadge +
                                        paymentBadge +
                                        (booking.lockers || []).map(function(locker) {
                                            return '<span class="lib-badge" style="background:#f3e8ff;color:#7c3aed;">Locker ' + locker + '</span>';
                                        }).join('') +
                                    '</div>' +
                                    '<div class="lib-inline-note font-HellixR" style="margin-bottom:6px;">' +
                                        (booking.phone ? ('Phone: ' + libEsc(booking.phone) + ' · ') : '') +
                                        'Slots: ' + libEsc((booking.slots || []).join(', ')) + ' · ' +
                                        'Price: ' + libInr(booking.price) + '/month' +
                                    '</div>' +
                                    '<div class="lib-inline-note font-HellixR">' +
                                        (booking.note ? ('Note: ' + libEsc(booking.note) + ' · ') : '') +
                                        'Added: ' + libEsc(booking.createdAt || '-') +
                                        (booking.payment && booking.payment.paidAt ? (' · Paid: ' + libEsc(booking.payment.paidAt)) : '') +
                                    '</div>' +
                                '</div>' +
                                '<div style="display:flex;gap:8px;flex-wrap:wrap;justify-content:flex-end;">' +
                                    (booking.payment && booking.payment.status !== 'paid' ? '<button class="lib-btn lib-btn-green font-HellixB" onclick="libOpenModal(\'pay\',' + booking.booking_id + ')">Pay</button>' : '') +
                                    '<button class="lib-btn lib-btn-light font-HellixB" onclick="libOpenModal(\'price\',' + booking.booking_id + ')">Price</button>' +
                                    (booking.status === 'secured' ? '<button class="lib-btn lib-btn-amber font-HellixB" onclick="libOpenModal(\'confirm\',' + booking.booking_id + ')">Confirm</button>' : '') +
                                    '<button class="lib-btn lib-btn-light font-HellixB" onclick="libOpenModal(\'extend\',' + booking.booking_id + ')">Extend</button>' +
                                    '<button class="lib-btn lib-btn-red font-HellixB" onclick="libOpenModal(\'delete\',' + booking.booking_id + ')">Delete</button>' +
                                '</div>' +
                            '</div>' +
                        '</div>';
                }).join('') +
            '</div>' +
        '</div>';
}

function libRenderLockers() {
    const lockerStatus = libBuildLockerStatus(LIB_STATE.monthBookings || []);
    return '' +
        '<div style="display:flex;flex-direction:column;gap:16px;">' +
            '<div class="lib-locker-grid">' +
                libLockerNumbers().map(function(locker) {
                    const owner = lockerStatus[locker];
                    return '<div class="lib-locker-card">' +
                        '<div class="font-HellixB" style="font-size:20px;color:' + (owner ? '#7c3aed' : '#111827') + ';">Locker ' + locker + '</div>' +
                        '<div class="lib-inline-note font-HellixR" style="margin-top:6px;">' + (owner ? libEsc(owner.name + ' · ' + owner.seat_label + ' · Slots ' + (owner.slots || []).join(',')) : 'Available') + '</div>' +
                        (owner ? '<div class="lib-inline-note font-HellixR" style="margin-top:4px;">' + libEsc(owner.phone || '') + '</div>' : '') +
                    '</div>';
                }).join('') +
            '</div>' +
        '</div>';
}

function libRenderConfig() {
    return '' +
        '<div style="display:flex;flex-direction:column;gap:16px;">' +
            '<div class="lib-warning font-HellixB">' +
                'This config controls the library only. Prices, slots, lockers, seat rows, and seat counts come from here. Save carefully because seat layout changes affect future admissions and availability.' +
            '</div>' +

            '<div class="lib-grid-two">' +
                '<div class="lib-card" style="padding:20px;">' +
                    '<div class="font-HellixB" style="font-size:18px;color:#111827;margin-bottom:14px;">Pricing</div>' +
                    '<div class="lib-grid-two">' +
                        '<div><label class="lib-label font-HellixB">1 Slot Price</label><input class="lib-input font-HellixR" type="number" value="' + libEsc(LIB_STATE.configForm.price1) + '" oninput="libUpdateConfigField(\'price1\', this.value)"></div>' +
                        '<div><label class="lib-label font-HellixB">2 Slot Price</label><input class="lib-input font-HellixR" type="number" value="' + libEsc(LIB_STATE.configForm.price2) + '" oninput="libUpdateConfigField(\'price2\', this.value)"></div>' +
                        '<div><label class="lib-label font-HellixB">3 Slot Price</label><input class="lib-input font-HellixR" type="number" value="' + libEsc(LIB_STATE.configForm.price3) + '" oninput="libUpdateConfigField(\'price3\', this.value)"></div>' +
                        '<div><label class="lib-label font-HellixB">4 Slot Price</label><input class="lib-input font-HellixR" type="number" value="' + libEsc(LIB_STATE.configForm.price4) + '" oninput="libUpdateConfigField(\'price4\', this.value)"></div>' +
                    '</div>' +
                    '<div style="margin-top:14px;"><label class="lib-label font-HellixB">Locker Price</label><input class="lib-input font-HellixR" type="number" value="' + libEsc(LIB_STATE.configForm.lockerPrice) + '" oninput="libUpdateConfigField(\'lockerPrice\', this.value)"></div>' +
                    '<div style="margin-top:14px;"><label class="lib-label font-HellixB">Locker Numbers (comma separated)</label><input class="lib-input font-HellixR" value="' + libEsc(LIB_STATE.configForm.lockersCsv) + '" oninput="libUpdateConfigField(\'lockersCsv\', this.value)"></div>' +
                    '<div class="lib-inline-note font-HellixR" style="margin-top:10px;">Total seats from current layout: ' + libTotalSeats() + '</div>' +
                '</div>' +

                '<div class="lib-card" style="padding:20px;">' +
                    '<div class="font-HellixB" style="font-size:18px;color:#111827;margin-bottom:14px;">Slot Definitions JSON</div>' +
                    '<textarea class="lib-textarea font-HellixR" oninput="libUpdateConfigField(\'slotsJson\', this.value)">' + libEsc(LIB_STATE.configForm.slotsJson) + '</textarea>' +
                '</div>' +
            '</div>' +

            '<div class="lib-card" style="padding:20px;">' +
                '<div class="font-HellixB" style="font-size:18px;color:#111827;margin-bottom:14px;">Seat Layout JSON</div>' +
                '<textarea class="lib-textarea font-HellixR" oninput="libUpdateConfigField(\'layoutJson\', this.value)">' + libEsc(LIB_STATE.configForm.layoutJson) + '</textarea>' +
            '</div>' +

            '<div style="display:flex;justify-content:flex-end;">' +
                '<button class="lib-btn lib-btn-dark font-HellixB" onclick="libSaveConfig()">Save Library Config</button>' +
            '</div>' +
        '</div>';
}

function libRenderMonthShell() {
    const title = libCurrentMonthLabel() + ' ' + LIB_STATE.year;
    let innerContent = '';

    if (LIB_STATE.loadingMonth) {
        innerContent = '<div class="lib-loading"><div class="lib-loader"></div></div>';
    } else if (LIB_STATE.activeTab === 'dashboard') {
        innerContent = libRenderMonthOverview();
    } else if (LIB_STATE.activeTab === 'admit') {
        innerContent = libRenderAdmit();
    } else if (LIB_STATE.activeTab === 'seats') {
        innerContent = libRenderSeats();
    } else if (LIB_STATE.activeTab === 'members') {
        innerContent = libRenderMembers();
    } else if (LIB_STATE.activeTab === 'lockers') {
        innerContent = libRenderLockers();
    } else if (LIB_STATE.activeTab === 'config') {
        innerContent = libRenderConfig();
    }

    return '' +
        '<div class="lib-section">' +
            '<div style="display:flex;justify-content:space-between;align-items:center;gap:14px;flex-wrap:wrap;margin-bottom:16px;">' +
                '<div><div class="font-HellixB" style="font-size:22px;color:#111827;">' + libEsc(title) + '</div><div class="lib-inline-note font-HellixR">Manage this month separately from student records.</div></div>' +
                '<button class="lib-btn lib-btn-light font-HellixB" onclick="libGoHome()">← Back to Library Home</button>' +
            '</div>' +
            '<div class="lib-tabs" style="margin-bottom:18px;">' +
                '<button class="lib-tab ' + (LIB_STATE.activeTab === 'dashboard' ? 'active' : '') + ' font-HellixB" onclick="libSetActiveTab(\'dashboard\')">Overview</button>' +
                '<button class="lib-tab ' + (LIB_STATE.activeTab === 'admit' ? 'active' : '') + ' font-HellixB" onclick="libSetActiveTab(\'admit\')">Admit</button>' +
                '<button class="lib-tab ' + (LIB_STATE.activeTab === 'seats' ? 'active' : '') + ' font-HellixB" onclick="libSetActiveTab(\'seats\')">Seats</button>' +
                '<button class="lib-tab ' + (LIB_STATE.activeTab === 'members' ? 'active' : '') + ' font-HellixB" onclick="libSetActiveTab(\'members\')">Members</button>' +
                '<button class="lib-tab ' + (LIB_STATE.activeTab === 'lockers' ? 'active' : '') + ' font-HellixB" onclick="libSetActiveTab(\'lockers\')">Lockers</button>' +
                '<button class="lib-tab ' + (LIB_STATE.activeTab === 'config' ? 'active' : '') + ' font-HellixB" onclick="libSetActiveTab(\'config\')">Config</button>' +
            '</div>' +
            innerContent +
        '</div>';
}

function libRenderModal() {
    if (!LIB_STATE.modal) {
        return '';
    }

    const modal = LIB_STATE.modal;
    const booking = modal.booking;

    if (modal.type === 'delete') {
        return '' +
            '<div class="lib-modal-overlay" onclick="libCloseModal()">' +
                '<div class="lib-modal" onclick="event.stopPropagation()">' +
                    '<div class="font-HellixB" style="font-size:22px;color:#111827;margin-bottom:8px;">Remove Library Member</div>' +
                    '<div class="lib-inline-note font-HellixR">Remove <strong>' + libEsc(booking.name) + '</strong> from just this month or from all linked months.</div>' +
                    '<div class="lib-modal-actions">' +
                        '<button class="lib-btn lib-btn-red font-HellixB" onclick="libDeleteBookingAction(\'all\')">Delete All Months</button>' +
                        '<button class="lib-btn lib-btn-amber font-HellixB" onclick="libDeleteBookingAction(\'month\')">Delete This Month</button>' +
                        '<button class="lib-btn lib-btn-light font-HellixB" onclick="libCloseModal()">Cancel</button>' +
                    '</div>' +
                '</div>' +
            '</div>';
    }

    if (modal.type === 'confirm') {
        return '' +
            '<div class="lib-modal-overlay" onclick="libCloseModal()">' +
                '<div class="lib-modal" onclick="event.stopPropagation()">' +
                    '<div class="font-HellixB" style="font-size:22px;color:#111827;margin-bottom:8px;">Confirm Booking</div>' +
                    '<div class="lib-inline-note font-HellixR">Mark <strong>' + libEsc(booking.name) + '</strong> as confirmed for this month.</div>' +
                    '<div class="lib-modal-actions">' +
                        '<button class="lib-btn lib-btn-dark font-HellixB" onclick="libConfirmBookingAction()">Confirm</button>' +
                        '<button class="lib-btn lib-btn-light font-HellixB" onclick="libCloseModal()">Cancel</button>' +
                    '</div>' +
                '</div>' +
            '</div>';
    }

    if (modal.type === 'price') {
        return '' +
            '<div class="lib-modal-overlay" onclick="libCloseModal()">' +
                '<div class="lib-modal" onclick="event.stopPropagation()">' +
                    '<div class="font-HellixB" style="font-size:22px;color:#111827;margin-bottom:8px;">Edit Price</div>' +
                    '<div class="lib-inline-note font-HellixR" style="margin-bottom:14px;">' + libEsc(booking.name) + ' · ' + libEsc(booking.block + ' / ' + booking.seat_label) + '</div>' +
                    '<label class="lib-label font-HellixB">Monthly Price</label>' +
                    '<input class="lib-input font-HellixR" type="number" value="' + libEsc(modal.price) + '" oninput="libSetModalPrice(this.value)">' +
                    '<div class="lib-modal-actions">' +
                        '<button class="lib-btn lib-btn-dark font-HellixB" onclick="libSavePriceAction()">Save Price</button>' +
                        '<button class="lib-btn lib-btn-light font-HellixB" onclick="libCloseModal()">Cancel</button>' +
                    '</div>' +
                '</div>' +
            '</div>';
    }

    if (modal.type === 'pay') {
        return '' +
            '<div class="lib-modal-overlay" onclick="libCloseModal()">' +
                '<div class="lib-modal" onclick="event.stopPropagation()">' +
                    '<div class="font-HellixB" style="font-size:22px;color:#111827;margin-bottom:8px;">Record Payment</div>' +
                    '<div class="lib-inline-note font-HellixR" style="margin-bottom:14px;">' + libEsc(booking.name) + ' · Amount ' + libInr(booking.price) + '</div>' +
                    '<div style="margin-bottom:14px;">' +
                        '<label class="lib-label font-HellixB">Method</label>' +
                        '<div class="lib-slot-strip">' +
                            '<button class="lib-pill ' + (modal.payMethod === 'cash' ? 'soft-active' : '') + ' font-HellixB" onclick="libSetModalPayMethod(\'cash\')">Cash</button>' +
                            '<button class="lib-pill ' + (modal.payMethod === 'gpay' ? 'soft-active' : '') + ' font-HellixB" onclick="libSetModalPayMethod(\'gpay\')">GPay</button>' +
                        '</div>' +
                    '</div>' +
                    '<div style="margin-bottom:14px;"><label class="lib-label font-HellixB">Collected By</label><input id="libModalCollectedBy" class="lib-input font-HellixR" placeholder="Staff name" value="' + libEsc(modal.payCollectedBy || '') + '" oninput="libSetModalField(\'payCollectedBy\', this.value)"></div>' +
                    '<div><label class="lib-label font-HellixB">Note</label><input id="libModalPaymentNote" class="lib-input font-HellixR" placeholder="Optional note" value="' + libEsc(modal.payNote || '') + '" oninput="libSetModalField(\'payNote\', this.value)"></div>' +
                    '<div class="lib-modal-actions">' +
                        '<button class="lib-btn lib-btn-dark font-HellixB" onclick="libRecordPaymentAction()">Record Payment</button>' +
                        '<button class="lib-btn lib-btn-light font-HellixB" onclick="libCloseModal()">Cancel</button>' +
                    '</div>' +
                '</div>' +
            '</div>';
    }

    if (modal.type === 'extend') {
        return '' +
            '<div class="lib-modal-overlay" onclick="libCloseModal()">' +
                '<div class="lib-modal" onclick="event.stopPropagation()">' +
                    '<div class="font-HellixB" style="font-size:22px;color:#111827;margin-bottom:8px;">Extend Booking</div>' +
                    '<div class="lib-inline-note font-HellixR" style="margin-bottom:14px;">' + libEsc(booking.name) + ' · Existing months: ' + libEsc((booking.group_months || []).map(function(month) { return LIB_MONTH_NAMES[month - 1]; }).join(', ')) + '</div>' +
                    '<div class="lib-slot-strip">' +
                        LIB_MONTH_NAMES.map(function(monthName, index) {
                            const monthNumber = index + 1;
                            const disabled = (booking.group_months || []).indexOf(monthNumber) >= 0;
                            const selected = (modal.extendMonths || []).indexOf(monthNumber) >= 0;
                            return '<button class="lib-pill ' + (selected ? 'soft-active' : '') + ' font-HellixB" ' + (disabled ? 'disabled' : '') + ' onclick="libSetModalExtendMonth(' + monthNumber + ')">' + monthName + (disabled ? ' ✓' : '') + '</button>';
                        }).join('') +
                    '</div>' +
                    '<div class="lib-modal-actions">' +
                        '<button class="lib-btn lib-btn-dark font-HellixB" onclick="libExtendBookingAction()">Extend</button>' +
                        '<button class="lib-btn lib-btn-light font-HellixB" onclick="libCloseModal()">Cancel</button>' +
                    '</div>' +
                '</div>' +
            '</div>';
    }

    return '';
}

function libRender() {
    const root = document.getElementById('libRoot');
    const modalHost = document.getElementById('libModalHost');

    if (!root || !modalHost) {
        return;
    }

    if (LIB_STATE.loading) {
        root.innerHTML = '<div class="lib-loading"><div class="lib-loader"></div></div>';
        modalHost.innerHTML = '';
        return;
    }

    if (LIB_STATE.activeTab === 'config' && LIB_STATE.selectedMonth === null) {
        root.innerHTML = '<div class="lib-section">' + libRenderConfig() + '</div>';
        modalHost.innerHTML = libRenderModal();
        return;
    }

    root.innerHTML = LIB_STATE.selectedMonth ? libRenderMonthShell() : libRenderHome();
    modalHost.innerHTML = libRenderModal();
}

document.addEventListener('DOMContentLoaded', function() {
    verifyAdminAccess(function(session) {
        LIB_STATE.session = session;
        libLoadBootstrap();
    });
});
</script>
