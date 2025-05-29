# 🎫 Bilet Al: Laravel Tabanlı Konser Bileti Satış Sistemi



## 📌 Proje Özeti

**Bilet Al**, Laravel 10 framework’ü kullanılarak geliştirilen, konser biletlerinin satışını ve yönetimini sağlayan web tabanlı bir uygulamadır. Kullanıcılar konserleri görüntüleyip satın alabilir, admin kullanıcılar ise konser ve sipariş yönetimini gerçekleştirebilir. Uygulama, bakiye ve kredi kartı ödeme seçenekleri, PDF bilet oluşturma ve e-posta gönderimi gibi özelliklere sahiptir.

---

## 🚀 Özellikler

### Kullanıcı (User) Paneli
- Konser listeleme ve detay sayfaları
- Sepet yönetimi
- Bakiye veya kredi kartı ile ödeme
- Sipariş takibi ve durum görüntüleme
- PDF formatında bilet oluşturma
- E-posta ile bilet gönderimi

### Yönetici (Admin) Paneli
- Konser ekleme, düzenleme, silme
- Sipariş onaylama veya reddetme
- Reddedilen siparişler için otomatik bakiye iadesi
- Kullanıcı hesaplarını görüntüleme ve yönetme

# Rest Assured API Test Projesi

Bu proje, Yazılım Test Mühendisliği dersi kapsamında hazırlanmıştır. Amaç, **RESTful servisleri test etmek** için Java, Maven ve JUnit4 teknolojilerini kullanarak otomatik regresyon testleri gerçekleştirmektir.

## 🔧 Kullanılan Teknolojiler

- Java 8+
- Maven
- JUnit4
- Rest Assured

## 🧪 Test Senaryoları

### 1. Doğru Email ve Şifre ile Giriş (POST `/api/login`)
- ✅ Status code: 200
- ✅ JSON response içinde `durum = basarili` ve `mesaj` içinde "Giriş" kelimesi aranır
- ✅ Yanıt süresi 1 saniyenin altında olmalı

### 2. Yanlış Şifre ile Giriş (POST `/api/login`)
- ✅ Status code: 401
- ✅ JSON response içinde `durum = hata` ve `mesaj` içinde "hatalı" kelimesi aranır

### 3. Konserler Sayfası GET İsteği (GET `/konserler`)
- ✅ Status code: 200
- ✅ Yanıt süresi 1 saniyenin altında olmalı
- ✅ Yanıt içeriği boş olmamalı (`body.length > 50`)

## 🚀 Nasıl Çalıştırılır?

1. Laravel API'nin çalıştığından emin olun (`php artisan serve`)
2. Bu test projesi dizininde terminal açın ve aşağıdaki komutu çalıştırın:

```bash
mvn test


## Teknoloji ve Yapılar

| Teknoloji          | Açıklama |
|--------------------|----------|
| Laravel 10         | Backend geliştirme için |
| MySQL              | Veritabanı |
| Laravel Breeze     | Kimlik doğrulama (Auth) |
| Blade              | Frontend şablon motoru |
| Bootstrap 5        | Responsive arayüz |
| Gmail SMTP         | E-posta gönderimi |
| Laravel DomPDF     | PDF bilet oluşturma |
| Middleware         | Rol bazlı yetkilendirme |
| Session            | Sepet yönetimi |

---

## Veritabanı Tabloları

- `users`: Kullanıcı bilgileri (ad, e-posta, bakiye, rol, vb.)
- `concerts`: Konser bilgileri (başlık, tarih, stok, görsel, vb.)
- `orders`: Sipariş bilgileri (toplam tutar, ürünler, ödeme yöntemi)
- Laravel auth tabloları: `password_resets`, `personal_access_tokens`, vb.

---

##  Sayfa Listesi

| Sayfa Adı                         | Açıklama |
|----------------------------------|----------|
| `dashboard.blade.php`            | Kullanıcı ana sayfası |
| `konser-detay.blade.php`         | Konser detayları |
| `sepet.blade.php`                | Sepet sayfası |
| `odeme.blade.php`                | Ödeme ekranı |
| `siparislerim.blade.php`         | Sipariş takibi |
| `admin/dashboard.blade.php`      | Admin paneli |
| `admin/konser/*.blade.php`       | Konser yönetimi |
| `admin/siparis/index.blade.php`  | Sipariş yönetimi |
| `profilim.blade.php`             | Kullanıcı profili |

---

## 📧 PDF ve E-Posta Sistemi

- Sipariş onayı sonrası PDF bilet Laravel DomPDF ile oluşturulur.
- Gmail SMTP üzerinden otomatik e-posta gönderilir.
- E-posta içinde bilet PDF’i ek olarak yer alır.

---

##  Kaynaklar

- [Laravel Docs](https://laravel.com/docs)
- [Bootstrap 5](https://getbootstrap.com)
- [DomPDF GitHub](https://github.com/barryvdh/laravel-dompdf)
- [Google SMTP Bilgi](https://support.google.com/mail/answer/7126229?hl=en)
- [Laracasts Middleware](https://laracasts.com/discuss/channels/laravel/how-do-i-use-middleware-in-laravel)

---

##  Projeyi Çalıştırmak İçin

```bash
git clone https://github.com/kullaniciadi/bilet-al.git
cd bilet-al
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
