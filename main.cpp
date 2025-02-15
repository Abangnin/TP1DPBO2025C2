#include "petshop.cpp"

int main() {
    petshop ps;
    int pilihan;

    //Loop utama program
    do {
        //Menampilkan menu pilihan
        cout << "\nMangga dipilih mau yang manaa\n";
        cout << "1. Tampilkan Data\n";
        cout << "2. Tambah Data\n";
        cout << "3. Ubah Data\n";
        cout << "4. Hapus Data\n";
        cout << "5. Cari Data\n";
        cout << "0. Keluar\n";
        cout << "Pilihan: ";
        //Menerima input pilihan dari user
        cin >> pilihan;

        //Memproses pilihan menu menggunakan switch-case
        switch (pilihan) {
            case 1:
                ps.tampilkanData(); //Untuk menampilkan data
                break;
            case 2:
                ps.tambahData(); //Untuk menambah data
                break;
            case 3:
                ps.ubahData(); //Untuk mengubah data
                break;
            case 4:
                ps.hapusData(); //Untuk menghapus data
                break;
            case 5:
                ps.cariData(); //Untuk mencari data
                break;
            case 0:
                cout << "Program dah beresss.\n"; //Pesan keluar program
                break;
            default:
                cout << "Pilihan tidak adaa\n"; //Pesan untuk pilihan tidak valid
        }
    } while (pilihan != 0); //Program akan terus berjalan sampai user memilih 0 (keluar)

    return 0;
}