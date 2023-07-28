<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Header</title>
  <style>
    /* Reset CSS untuk menghilangkan margin dan padding default */
    body, h1, p, img {
      margin: 0;
      padding: 0;
    }

    /* Ganti warna background dan warna teks pada footer */
    footer {
      background-color: #EFF6DC;
      color: #333;
      padding: 20px;
      display: flex;
      flex-wrap: wrap; /* Menyusun elemen-elemen secara wrap jika lebar layar tidak cukup */
      justify-content: center;
      gap: 200px;
      font-size: 30px;
      border-top-left-radius: 25px;
  border-top-right-radius: 25px;
    }

    /* Gaya untuk container logo */
    .logo-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Tambahkan gaya untuk logo */
    .logo {
      width: 150px;
      height: auto;
    }

    /* Gaya untuk paragraf lainnya di footer */
    .footer-content {
      text-align: center;
      font-size: 16px;
    }

    .foot {
      background: seagreen;
      padding: 50px;
    }
  </style>
</head>
<body>
  <footer>
    <div class="logo-container">
      <img src="../image_nextstep/logo_nextstep.png" alt="NextStep Logo" class="logo">
    </div>
    <div class="footer-content">
      <p>Features</p>
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
    </div>
    <div class="footer-content">
      <p>Partnership</p>
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
    </div>
    <div class="footer-content">
      <p>Contact us</p>
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
    </div>
   
  
  </footer>
   <div class="foot">
     <p>&copy; 2023 NextStep. All rights reserved.</p>
   </div>
</body>
</html>
