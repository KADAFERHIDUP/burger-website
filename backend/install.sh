#!/usr/bin/env bash
set -e
cd "$(dirname "$0")"

command -v composer >/dev/null || { echo "Composer belum terpasang: https://getcomposer.org/download/"; exit 1; }

if [ ! -d vendor/codeigniter4/framework ]; then
  echo "[1/3] Mengunduh CodeIgniter 4..."
  composer create-project codeigniter4/appstarter _ci4_base --no-interaction
  echo "[2/3] Menggabungkan file framework. File project ini tidak ditimpa..."
  cp -rn _ci4_base/. . 2>/dev/null || true
  rm -rf _ci4_base
else
  echo "CodeIgniter sudah terpasang, lewati unduhan."
fi

[ -f .env ] || { echo "[3/3] Membuat file .env..."; cp .env.example .env; }

cat <<'MSG'

Selesai! Langkah berikutnya:
  1. Nyalakan MySQL
  2. php spark db:create burger_db
  3. php spark migrate
  4. php spark db:seed DatabaseSeeder
  5. php spark serve   lalu buka http://localhost:8080
MSG
