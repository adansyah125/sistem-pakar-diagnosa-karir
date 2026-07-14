# Teori Sistem Pakar — Forward Chaining & Certainty Factor

## A. Sistem Pakar (Expert System)

Sistem pakar adalah program komputer yang meniru kemampuan pengambilan
keputusan seorang pakar manusia. Sistem pakar terdiri dari tiga komponen
utama:

1.  **Knowledge Base (Basis Pengetahuan)** — kumpulan aturan (rules)
    berupa IF-THEN yang merepresentasikan pengetahuan pakar.
2.  **Inference Engine (Mesin Inferensi)** — mekanisme yang memproses
    aturan dan fakta untuk menghasilkan kesimpulan.
3.  **Working Memory (Memori Kerja)** — tempat penyimpanan fakta
    sementara selama proses inferensi berlangsung.

## B. Forward Chaining (Penalaran Maju)

Forward Chaining adalah strategi inferensi yang **berawal dari fakta**
(input user) menuju **kesimpulan**. Disebut juga *data-driven reasoning*
karena data yang tersedia menentukan kesimpulan apa yang dihasilkan.

### Alur Forward Chaining:

```
Fakta (jawaban user) → Cocokkan dengan IF dari aturan → Rule Fire
→ Tambahkan fakta baru → Ulangi hingga tidak ada rule yang fire
→ Kesimpulan akhir
```

### Contoh:

```
Rule 1: IF suka_ngoding THEN cocok_jadi_programmer
Rule 2: IF cocok_jadi_programmer AND suka_frontend THEN cocok_jadi_frontend

Fakta: suka_ngoding = true, suka_frontend = true

Proses:
1. Rule 1 fire → fakta baru: cocok_jadi_programmer = true
2. Rule 2 fire (karena cocok_jadi_programmer AND suka_frontend terpenuhi)
   → kesimpulan: cocok_jadi_frontend = true
```

### Kelebihan Forward Chaining:

- Cocok untuk masalah dengan banyak input (fakta) menuju sedikit
  kesimpulan
- Natural untuk sistem diagnosis dan klasifikasi
- User tidak perlu menentukan tujuan/hipotesis di awal

## C. Certainty Factor (Faktor Kepastian)

Certainty Factor adalah metode untuk menangani **ketidakpastian** dalam
sistem pakar. Dikembangkan oleh Shortliffe dan Buchanan untuk sistem
MYCIN. CF merepresentasikan tingkat keyakinan pakar terhadap suatu
aturan.

### 1. Representasi CF

CF bernilai antara **0 sampai 1** (dalam implementasi ini):

| Nilai CF | Interpretasi |
|----------|--------------|
| 1.0      | Sangat Yakin |
| 0.8      | Yakin        |
| 0.6      | Cukup Yakin  |
| 0.4      | Agak Yakin   |
| 0.2      | Kurang Yakin |
| 0        | Tidak Tahu   |

### 2. CF pada Aturan (Rule)

Setiap aturan dalam sistem pakar memiliki CF yang menunjukkan seberapa
kuat aturan tersebut mendukung kesimpulan:

```
IF kondisi THEN kesimpulan CF = 0.8
```

Artinya: pakar 80% yakin bahwa jika kondisi terpenuhi, maka kesimpulan
tersebut benar.

### 3. CF pada Evidence (Fakta/Jawaban)

Jawaban user juga memiliki tingkat keyakinan. Dalam implementasi ini,
skor jawaban (0–3) dipetakan ke CF evidence:

```
Skor 0 → CF = 0.0  (Tidak bisa / Tidak yakin)
Skor 1 → CF = 0.33 (Dasar / Kurang yakin)
Skor 2 → CF = 0.66 (Mahir / Cukup yakin)
Skor 3 → CF = 1.0  (Sangat mahir / Sangat yakin)
```

### 4. Kombinasi CF (Dua Rule atau Lebih)

Jika ada dua rule atau lebih yang mendukung kesimpulan yang sama, CF
mereka dikombinasikan dengan rumus:

```
CF_combined = CF_lama + CF_baru × (1 - CF_lama)
```

**Contoh:**

```
Rule A: IF suka_ngoding THEN programmer CF = 0.8
Rule B: IF suka_matematika THEN programmer CF = 0.6

CF_combined = 0.8 + 0.6 × (1 - 0.8)
            = 0.8 + 0.6 × 0.2
            = 0.8 + 0.12
            = 0.92
```

Setelah dua rule dikombinasikan, keyakinan meningkat dari 0.8 menjadi
0.92.

### 5. Kontribusi CF per Rule

Kontribusi sebuah rule dihitung dengan:

```
CF_kontribusi = CF_evidence × CF_rule
```

Dimana:

- `CF_evidence` = keyakinan jawaban user (= skor / 3)
- `CF_rule` = keyakinan aturan dari pakar

### 6. Alur Lengkap CF + Forward Chaining

```
1. User menjawab pertanyaan dengan skor 0-3
2. Setiap skor dikonversi ke CF_evidence
3. Untuk setiap rule di knowledge base:
   a. Cek apakah jawaban user >= min_score rule
   b. Jika ya (rule fire):
      - Hitung CF_kontribusi = CF_evidence × CF_rule
      - Gabungkan ke CF_karir:
        CF_karir = CF_karir + CF_kontribusi × (1 - CF_karir)
4. Hasil: daftar karir dengan nilai CF masing-masing
5. Karir dengan CF ≥ 0.8 (Sangat Sesuai) akan ditampilkan roadmap-nya
```

### Contoh Perhitungan Lengkap

Seorang user menjawab 10 soal untuk **Frontend Developer** dengan skor:
[3, 3, 2, 3, 2, 2, 3, 3, 2, 3]

Aturan untuk **Frontend** dari 10 soal tersebut:

| Soal | Skor | CF_evidence | CF_rule | CF_kontribusi | CF_akumulasi |
|------|------|-------------|---------|---------------|--------------|
| 1    | 3    | 1.0         | 0.9     | 0.900         | 0.900        |
| 2    | 3    | 1.0         | 0.8     | 0.800         | 0.980        |
| 3    | 2    | 0.66        | 0.7     | 0.462         | 0.989        |
| 4    | 3    | 1.0         | 0.5     | 0.500         | 0.995        |
| 5    | 2    | 0.66        | 0.5     | 0.330         | 0.996        |
| 6    | 2    | 0.66        | 0.6     | 0.396         | 0.998        |
| 7    | 3    | 1.0         | 0.7     | 0.700         | 0.999        |
| 8    | 3    | 1.0         | 0.6     | 0.600         | 1.000        |
| 9    | 2    | 0.66        | 0.5     | 0.330         | 1.000        |
| 10   | 3    | 1.0         | 0.8     | 0.800         | 1.000        |

CF akhir untuk Frontend = **1.000** (Sangat Sesuai)

Rumus akumulasi setiap baris:

```
CF_baru = CF_sebelumnya + (CF_evidence × CF_rule) × (1 - CF_sebelumnya)
```

Misalnya baris ke-2:
```
CF = 0.900 + (1.0 × 0.8) × (1 - 0.900)
   = 0.900 + 0.8 × 0.1
   = 0.900 + 0.080
   = 0.980
```

## D. Interpretasi Hasil CF

| Rentang CF    | Kesimpulan      | Tampilkan Roadmap |
|---------------|-----------------|-------------------|
| 0.8 – 1.0     | Sangat Sesuai   | ✅ Ya             |
| 0.6 – 0.79    | Sesuai          | ✅ Ya             |
| 0.4 – 0.59    | Cukup Sesuai    | ✅ Ya             |
| 0 – 0.39      | Kurang Sesuai   | ❌ Tidak          |

*Catatan: Roadmap hanya ditampilkan untuk karir dengan kategori **Sangat Sesuai** (CF ≥ 0.8).*

## E. Struktur Knowledge Base (Rules)

Knowledge base terdiri dari aturan-aturan yang menghubungkan jawaban
pertanyaan dengan kesimpulan karir.

### Format Rule:

```
JIKA jawaban_soal_X >= min_score
MAKA mendukung_karir_Y
DENGAN_CF = nilai_cf
```

### Contoh Rule dalam Database:

| question_id | career_id | min_score | cf    |
|-------------|-----------|-----------|-------|
| 1           | 1         | 2         | 0.90  |
| 1           | 3         | 2         | 0.60  |
| 1           | 6         | 1         | 0.30  |
| 2           | 1         | 2         | 0.80  |
| 2           | 3         | 2         | 0.70  |

Artinya:

- Soal#1 (HTML/CSS): jika skor ≥ 2, mendukung Frontend (CF=0.9),
  Fullstack (CF=0.6), UI/UX (CF=0.3)
- Soal#2 (JavaScript framework): jika skor ≥ 2, mendukung Frontend
  (CF=0.8), Fullstack (CF=0.7)

## F. Kesimpulan

Forward Chaining + Certainty Factor adalah kombinasi yang tepat untuk
sistem pemetaan karir karena:

1.  **FC** memungkinkan sistem menarik kesimpulan dari fakta (jawaban
    user) tanpa user harus menentukan tujuan di awal
2.  **CF** menangani ketidakpastian alami dalam penilaian minat dan
    kemampuan — tidak ada jawaban yang "mutlak benar"
3.  Kombinasi keduanya menghasilkan rekomendasi karir yang lebih akurat
    dan informatif dengan tingkat keyakinan yang transparan
