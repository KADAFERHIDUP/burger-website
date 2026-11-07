// Nomor WhatsApp tujuan pesanan (format internasional, tanpa + dan tanpa 0 di depan)
const WHATSAPP_NUMBER = '6282276078880';

const waUrl = message => `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(message)}`;

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

// Ikon menu & cari bisa dibuka dengan keyboard (Enter / Spasi)
[searchBtn, menuBtn].forEach(btn => btn.addEventListener('keydown', e => {
   if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); btn.click(); }
}));

// Tutup menu setelah link navigasi diklik (di HP)
navbar.querySelectorAll('a').forEach(a => a.addEventListener('click', closeAll));

// Tutup menu saat halaman di-scroll, kecuali sedang mengetik di kotak pencarian
window.onscroll = () => {
   if (document.activeElement === searchBox) return;
   closeAll();
};

// ---------- Pencarian menu ----------
const menuBoxes = [...document.querySelectorAll('.menu .box')];
const noResult = document.querySelector('#no-result');

const filterMenu = query => {
   const q = query.trim().toLowerCase();
   let shown = 0;
   menuBoxes.forEach(box => {
      const name = box.querySelector('h3').textContent.toLowerCase();
      const match = !q || name.includes(q);
      box.style.display = match ? '' : 'none';
      if (match) shown++;
   });
   noResult.hidden = shown > 0;
};

searchBox.addEventListener('input', () => filterMenu(searchBox.value));

searchForm.addEventListener('submit', e => {
   e.preventDefault();
   filterMenu(searchBox.value);
   closeAll();
   searchBox.blur();
   document.querySelector('#menu').scrollIntoView({ behavior: 'smooth' });
});

// ---------- Pesan lewat WhatsApp ----------
document.querySelectorAll('.order-btn').forEach(btn => {
   const message = `Halo, saya mau pesan ${btn.dataset.item} (${btn.dataset.price}).\nJumlah: 1\nAlamat: `;
   btn.href = waUrl(message);
   btn.target = '_blank';
   btn.rel = 'noopener';
});

document.querySelectorAll('.wa-link').forEach(link => {
   link.href = waUrl(link.dataset.message || 'Halo!');
   link.target = '_blank';
   link.rel = 'noopener';
});

// ---------- Form kontak -> WhatsApp ----------
const contactForm = document.querySelector('#contact-form');
const formNote = document.querySelector('#form-note');

contactForm.addEventListener('submit', e => {
   e.preventDefault();
   const data = new FormData(contactForm);
   const name = (data.get('name') || '').trim();
   const message = (data.get('message') || '').trim();
   if (!name || !message) {
      formNote.textContent = 'Isi nama dan pesan dulu, ya.';
      return;
   }
   const lines = [`Halo, saya ${name}.`];
   if (data.get('email')) lines.push(`Email: ${data.get('email')}`);
   if (data.get('phone')) lines.push(`No. HP: ${data.get('phone')}`);
   lines.push('', message);
   window.open(waUrl(lines.join('\n')), '_blank', 'noopener');
   formNote.textContent = 'WhatsApp sudah dibuka. Tekan Kirim di sana untuk mengirim pesanmu.';
   contactForm.reset();
});

// ---------- Tahun di footer ----------
document.querySelector('#year').textContent = new Date().getFullYear();

// ---------- Animasi scroll (AOS) ----------
if (window.AOS) {
   AOS.init({ duration: 800, once: true });
} else {
   // Jika CDN AOS gagal dimuat, tampilkan semua elemen tanpa animasi
   document.querySelectorAll('[data-aos]').forEach(el => el.removeAttribute('data-aos'));
}
