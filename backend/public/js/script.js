let searchBtn = document.querySelector('#search-btn');
let searchForm = document.querySelector('.header .search-form');
let searchBox = document.querySelector('#search-box');
let menuBtn = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

const closeAll = () => {
   searchBtn.classList.remove('fa-times');
   searchForm.classList.remove('active');
   menuBtn.classList.remove('fa-times');
   navbar.classList.remove('active');
};

searchBtn.onclick = () => {
   searchBtn.classList.toggle('fa-times');
   searchForm.classList.toggle('active');
   menuBtn.classList.remove('fa-times');
   navbar.classList.remove('active');
   if (searchForm.classList.contains('active')) searchBox.focus();
};

menuBtn.onclick = () => {
   menuBtn.classList.toggle('fa-times');
   navbar.classList.toggle('active');
   searchBtn.classList.remove('fa-times');
   searchForm.classList.remove('active');
};

[searchBtn, menuBtn].forEach(btn => btn.addEventListener('keydown', e => {
   if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
}));

navbar.querySelectorAll('a').forEach(a => a.addEventListener('click', closeAll));

window.onscroll = () => {
   if (document.activeElement === searchBox) return;
   closeAll();
};

// Saring menu langsung saat mengetik (di halaman utama). Tekan Enter untuk cari lewat server.
const menuBoxes = [...document.querySelectorAll('.menu .box')];
const noResult = document.querySelector('#no-result');

if (menuBoxes.length && noResult) {
   searchBox.addEventListener('input', () => {
      const q = searchBox.value.trim().toLowerCase();
      let shown = 0;
      menuBoxes.forEach(box => {
         const match = !q || box.textContent.toLowerCase().includes(q);
         box.style.display = match ? '' : 'none';
         if (match) shown++;
      });
      noResult.hidden = shown > 0;
   });
}

// Notifikasi hilang sendiri setelah 6 detik
const flash = document.querySelector('#flash');
if (flash) setTimeout(() => flash.remove(), 6000);

// Animasi scroll (AOS); jika CDN gagal, tampilkan semua elemen tanpa animasi
if (window.AOS) {
   AOS.init({ duration: 800, once: true });
} else {
   document.querySelectorAll('[data-aos]').forEach(el => el.removeAttribute('data-aos'));
}
