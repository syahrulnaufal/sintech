let mahasiswa = {
    nama: "Syahrul",
    umur: 18,
    alamat: "Semarang",
    isPerempuan: false,
    hobi: ["Bersepeda", "Melukis", "Nonton Film"],
    isMahasiswa: true,
}

function perkenalan() {
    console.log("Hi, nama saya " + this.nama);
    console.log("hobi saya " + this.hobi[0]);
}

perkenalan.call(mahasiswa);