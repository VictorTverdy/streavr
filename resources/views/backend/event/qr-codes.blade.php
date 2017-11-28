    @foreach($codes as $qrCode)
      <?php  echo DNS2D::getBarcodeHTML($qrCode->qr_code,'QRCODE',5,5).'<br><br>'; ?>
    @endforeach
