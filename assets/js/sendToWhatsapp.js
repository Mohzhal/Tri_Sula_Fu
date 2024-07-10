function sendMesssageToWhatsapp(){
    const urlToWhatsapp = `https://wa.me/6285217336259?text=Nama Saya ${nama.value},
    Email : ${email.value} 
    ${pesan.value}`
    window.open(urlToWhatsapp, "_blank")
   }