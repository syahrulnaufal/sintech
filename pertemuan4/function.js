let user = {
    nama: 'Syahrul',
    usia: 18,
}

function greeting(user) {
    console.log('Halo, ' + user.nama + "! Kamu berusia " + user.usia + " tahun");
}

function bagi(angka1, angka2){
    return angka1 / angka2;
}

greeting(user);
console.log(bagi(10, 2));
