<style>
/* ========== GALLERY HERO ========== */
.gal-hero {
    background: #0a0a0a; padding: 80px 24px 60px; text-align: center;
    position: relative; overflow: hidden;
}
.gal-hero-glow {
    position: absolute; width: 600px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(96,165,250,0.08) 0%, transparent 70%);
    top: 20%; left: 50%; transform: translateX(-50%); pointer-events: none;
}
.gal-hero-label {
    font-size: 12px; text-transform: uppercase; letter-spacing: 0.12em;
    color: rgba(255,255,255,0.4); margin-bottom: 16px;
}
.gal-hero-title {
    font-size: clamp(32px, 5vw, 52px); color: #fff; margin: 0 0 16px;
    letter-spacing: -0.02em; position: relative; z-index: 1;
}
.gal-hero-desc {
    font-size: clamp(15px, 1.8vw, 17px); color: rgba(255,255,255,0.55);
    max-width: 550px; margin: 0 auto; line-height: 1.7; position: relative; z-index: 1;
}

/* ========== FILTER ========== */
.gal-filter-bar {
    background: #fff; border-bottom: 1px solid #e5e7eb; position: sticky;
    top: 72px; z-index: 50; padding: 14px 24px;
}
.gal-filter-inner {
    max-width: 1100px; margin: 0 auto; display: flex; gap: 8px;
    flex-wrap: wrap; align-items: center;
}
.gal-filter-btn {
    padding: 8px 18px; border-radius: 20px; font-size: 13px;
    border: 1px solid #e5e7eb; background: #fff; color: #6b7280;
    cursor: pointer; transition: all 0.2s; white-space: nowrap;
}
.gal-filter-btn:hover { border-color: #d1d5db; color: #111; }
.gal-filter-btn.active { background: #121212; color: #fff; border-color: #121212; }
.gal-count {
    margin-left: auto; font-size: 13px; color: #9ca3af;
}
.gal-count span { color: #111; }

/* ========== MASONRY GRID ========== */
.gal-grid-section {
    max-width: 1100px; margin: 0 auto; padding: 32px 24px 80px;
}
.gal-masonry {
    columns: 3; column-gap: 16px;
}
.gal-item {
    break-inside: avoid; margin-bottom: 16px; border-radius: 14px;
    overflow: hidden; position: relative; cursor: pointer;
    animation: galFadeUp 0.5s ease both;
}
.gal-item img {
    width: 100%; display: block; transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}
.gal-item:hover img { transform: scale(1.05); }
.gal-item-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 50%, rgba(0,0,0,0.7) 100%);
    opacity: 0; transition: opacity 0.3s;
    display: flex; flex-direction: column; justify-content: flex-end; padding: 20px;
}
.gal-item:hover .gal-item-overlay { opacity: 1; }
.gal-item-title { font-size: 15px; color: #fff; margin: 0 0 3px; }
.gal-item-cat { font-size: 12px; color: rgba(255,255,255,0.6); margin: 0; }
.gal-item-zoom {
    position: absolute; top: 12px; right: 12px; width: 36px; height: 36px;
    background: rgba(0,0,0,0.4); border-radius: 50%; display: flex;
    align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s; backdrop-filter: blur(4px);
}
.gal-item:hover .gal-item-zoom { opacity: 1; }
.gal-item-zoom svg { width: 16px; height: 16px; stroke: #fff; }

/* ========== EMPTY STATE ========== */
.gal-empty {
    text-align: center; padding: 80px 24px; color: #9ca3af;
}
.gal-empty svg { width: 56px; height: 56px; margin: 0 auto 16px; stroke: #d1d5db; }
.gal-empty-title { font-size: 18px; color: #6b7280; margin: 0 0 6px; }
.gal-empty-desc { font-size: 14px; margin: 0; }

/* ========== LIGHTBOX ========== */
.gal-lightbox {
    position: fixed; inset: 0; background: rgba(0,0,0,0.9); z-index: 9999;
    display: none; align-items: center; justify-content: center;
    backdrop-filter: blur(8px); padding: 24px;
}
.gal-lightbox.open { display: flex; }
.gal-lightbox-content {
    position: relative; max-width: 90vw; max-height: 90vh;
}
.gal-lightbox-content img {
    max-width: 90vw; max-height: 85vh; object-fit: contain; border-radius: 10px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.4);
}
.gal-lightbox-info {
    text-align: center; margin-top: 14px;
}
.gal-lightbox-title { font-size: 16px; color: #fff; margin: 0 0 2px; }
.gal-lightbox-cat { font-size: 13px; color: rgba(255,255,255,0.5); margin: 0; }
.gal-lightbox-close {
    position: absolute; top: -48px; right: 0; background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2); border-radius: 50%; width: 40px; height: 40px;
    display: flex; align-items: center; justify-content: center; cursor: pointer;
    transition: all 0.2s;
}
.gal-lightbox-close:hover { background: rgba(255,255,255,0.2); }
.gal-lightbox-close svg { width: 18px; height: 18px; stroke: #fff; }
.gal-lightbox-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);
    border-radius: 50%; width: 44px; height: 44px; display: flex;
    align-items: center; justify-content: center; cursor: pointer;
    transition: all 0.2s; backdrop-filter: blur(4px);
}
.gal-lightbox-nav:hover { background: rgba(255,255,255,0.2); }
.gal-lightbox-nav svg { width: 20px; height: 20px; stroke: #fff; }
.gal-lightbox-prev { left: -60px; }
.gal-lightbox-next { right: -60px; }

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .gal-masonry { columns: 2; }
    .gal-lightbox-prev { left: 8px; }
    .gal-lightbox-next { right: 8px; }
    .gal-filter-bar { top: 64px; }
}
@media (max-width: 480px) {
    .gal-masonry { columns: 1; }
    .gal-lightbox-nav { width: 36px; height: 36px; }
}

@keyframes galFadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

{{-- ===== HERO ===== --}}
<div class="gal-hero">
    <div class="gal-hero-glow"></div>
    <div class="gal-hero-label font-HellixSB">Life at ABC</div>
    <h1 class="gal-hero-title font-HellixB">Gallery</h1>
    <p class="gal-hero-desc font-HellixR">Moments captured from events, celebrations, and daily life at Institute of ABC.</p>
</div>

{{-- ===== FILTER ===== --}}
<div class="gal-filter-bar">
    <div class="gal-filter-inner">
        <button class="gal-filter-btn font-HellixSB active" data-gal-filter="all">All</button>
        <button class="gal-filter-btn font-HellixSB" data-gal-filter="events">Events</button>
        <button class="gal-filter-btn font-HellixSB" data-gal-filter="celebrations">Celebrations</button>
        <button class="gal-filter-btn font-HellixSB" data-gal-filter="campus">Campus</button>
        <button class="gal-filter-btn font-HellixSB" data-gal-filter="students">Students</button>
        <div class="gal-count font-HellixR"><span class="font-HellixSB" id="galCount">0</span> photos</div>
    </div>
</div>

{{-- ===== GRID ===== --}}
<div class="gal-grid-section">
    <div class="gal-masonry" id="galGrid"></div>
    <div class="gal-empty" id="galEmpty" style="display:none;">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <div class="gal-empty-title font-HellixB">No photos in this category</div>
        <div class="gal-empty-desc font-HellixR">Try selecting a different filter.</div>
    </div>
</div>

{{-- ===== LIGHTBOX ===== --}}
<div class="gal-lightbox" id="galLightbox">
    <div class="gal-lightbox-content">
        <button class="gal-lightbox-close" onclick="closeGalLightbox()">
            <svg fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <button class="gal-lightbox-nav gal-lightbox-prev" onclick="galNav(-1)">
            <svg fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="gal-lightbox-nav gal-lightbox-next" onclick="galNav(1)">
            <svg fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
        <img id="galLightboxImg" src="" alt="">
        <div class="gal-lightbox-info">
            <div class="gal-lightbox-title font-HellixSB" id="galLightboxTitle"></div>
            <div class="gal-lightbox-cat font-HellixR" id="galLightboxCat"></div>
        </div>
    </div>
</div>

<script>
// ===== GALLERY DATA =====
// To add new photos: just add an entry with image path, title, and category
var GALLERY_PHOTOS = [
    { image: 'assets/dice-1502706_640 (4).jpg', title: "Teacher's Day Celebration", category: 'celebrations', year: '2016' },
    { image: 'assets/65-500x300.jpg', title: "Children's Day Event", category: 'celebrations', year: '2016' },
    { image: 'assets/184-500x300.jpg', title: 'Annual Function', category: 'events', year: '2017' },
    { image: 'assets/591-500x300.jpg', title: 'Inauguration Ceremony', category: 'events', year: '2016' },
    { image: 'assets/dice-1502706_640 (4).jpg', title: 'Computer Lab Session', category: 'campus', year: '2018' },
    { image: 'assets/65-500x300.jpg', title: 'Student Award Ceremony', category: 'students', year: '2019' },
    { image: 'assets/184-500x300.jpg', title: 'Republic Day Celebration', category: 'celebrations', year: '2020' },
    { image: 'assets/591-500x300.jpg', title: 'Workshop on Web Design', category: 'events', year: '2021' },
    { image: 'assets/dice-1502706_640 (4).jpg', title: 'Practical Exam Day', category: 'students', year: '2022' },
    { image: 'assets/65-500x300.jpg', title: 'Smart Lab Tour', category: 'campus', year: '2023' },
    { image: 'assets/184-500x300.jpg', title: 'Independence Day', category: 'celebrations', year: '2023' },
    { image: 'assets/591-500x300.jpg', title: 'Coding Competition', category: 'events', year: '2024' },
    { image: 'assets/dice-1502706_640 (4).jpg', title: 'Batch Photo - DCA 2024', category: 'students', year: '2024' },
    { image: 'assets/65-500x300.jpg', title: 'Theory Classroom', category: 'campus', year: '2024' },
    { image: 'assets/184-500x300.jpg', title: 'Farewell Party', category: 'celebrations', year: '2024' },
    { image: 'assets/591-500x300.jpg', title: 'Certificate Distribution', category: 'events', year: '2025' },
];

var galFiltered = [];
var galCurrentIndex = 0;
var galBaseUrl = '{{ asset("") }}';

document.addEventListener('DOMContentLoaded', function() {
    galFilter('all');

    document.querySelectorAll('[data-gal-filter]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('[data-gal-filter]').forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            galFilter(btn.getAttribute('data-gal-filter'));
        });
    });
});

function galFilter(cat) {
    if (cat === 'all') {
        galFiltered = GALLERY_PHOTOS;
    } else {
        galFiltered = GALLERY_PHOTOS.filter(function(p) { return p.category === cat; });
    }
    document.getElementById('galCount').textContent = galFiltered.length;

    if (galFiltered.length === 0) {
        document.getElementById('galGrid').innerHTML = '';
        document.getElementById('galEmpty').style.display = 'block';
    } else {
        document.getElementById('galEmpty').style.display = 'none';
        renderGallery();
    }
}

function renderGallery() {
    var grid = document.getElementById('galGrid');
    grid.innerHTML = galFiltered.map(function(p, i) {
        var catLabel = p.category.charAt(0).toUpperCase() + p.category.slice(1);
        return '<div class="gal-item" onclick="openGalLightbox(' + i + ')" style="animation-delay:' + (i * 0.04) + 's;">' +
            '<img src="' + galBaseUrl + galEsc(p.image) + '" alt="' + galEsc(p.title) + '" loading="lazy">' +
            '<div class="gal-item-overlay">' +
                '<div class="gal-item-title font-HellixSB">' + galEsc(p.title) + '</div>' +
                '<div class="gal-item-cat font-HellixR">' + catLabel + (p.year ? ' &middot; ' + p.year : '') + '</div>' +
            '</div>' +
            '<div class="gal-item-zoom">' +
                '<svg fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>' +
            '</div>' +
        '</div>';
    }).join('');
}

function openGalLightbox(index) {
    galCurrentIndex = index;
    updateGalLightbox();
    document.getElementById('galLightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeGalLightbox() {
    document.getElementById('galLightbox').classList.remove('open');
    document.body.style.overflow = '';
}

function galNav(dir) {
    galCurrentIndex += dir;
    if (galCurrentIndex < 0) galCurrentIndex = galFiltered.length - 1;
    if (galCurrentIndex >= galFiltered.length) galCurrentIndex = 0;
    updateGalLightbox();
}

function updateGalLightbox() {
    var p = galFiltered[galCurrentIndex];
    if (!p) return;
    var catLabel = p.category.charAt(0).toUpperCase() + p.category.slice(1);
    document.getElementById('galLightboxImg').src = galBaseUrl + p.image;
    document.getElementById('galLightboxTitle').textContent = p.title;
    document.getElementById('galLightboxCat').textContent = catLabel + (p.year ? ' \u00B7 ' + p.year : '');
}

// Click outside to close
document.getElementById('galLightbox').addEventListener('click', function(e) {
    if (e.target === this) closeGalLightbox();
});

// Keyboard nav
document.addEventListener('keydown', function(e) {
    var lb = document.getElementById('galLightbox');
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') closeGalLightbox();
    if (e.key === 'ArrowLeft') galNav(-1);
    if (e.key === 'ArrowRight') galNav(1);
});

function galEsc(text) {
    if (!text) return '';
    var d = document.createElement('div');
    d.textContent = text;
    return d.innerHTML;
}
</script>
