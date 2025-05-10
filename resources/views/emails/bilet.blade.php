<p>Merhaba {{ $siparis->user->name }},</p>

<p>Siparişiniz onaylanmıştır. Konser biletinize ait bilgiler aşağıda yer almaktadır. Ayrıca ektedir.</p>

<p>Toplam Tutar: <strong>{{ number_format($siparis->toplam_tutar, 2) }} ₺</strong></p>
<p>Ödeme Yöntemi: <strong>{{ strtoupper($siparis->odeme_yontemi) }}</strong></p>

<p>📎 Bilet PDF'i ekte yer almaktadır. Etkinlikte görüşmek üzere!</p>

<p>— Konser Bilet Ekibi</p>