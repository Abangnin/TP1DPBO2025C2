#include <iostream>
#include <string>
using namespace std;

class petshop {
private:
    //Untuk membatasi jumlah maksimal produk yang dapat disimpan
    static const int maksimal_produk = 100;  
    
    // Deklarasi array untuk menyimpan data produk
    string id[maksimal_produk];        // Array untuk menyimpan ID produk
    string nama[maksimal_produk];      // Array untuk menyimpan nama produk
    string kategori[maksimal_produk];  // Array untuk menyimpan kategori produk
    double harga[maksimal_produk];     // Array untuk menyimpan harga produk

    // Variabel untuk menghitung jumlah produk yang tersimpan
    int jumlahProduk = 0;  

public:
    //Untuk menampilkan semua data produk yang tersimpan
    void tampilkanData() {
        cout << "\nDaftar Produk PetShop:\n";
        
        // Loop untuk menampilkan setiap produk
        for (int i = 0; i < jumlahProduk; i++) {
            cout << "ID       : " << id[i] << endl;
            cout << "Nama     : " << nama[i] << endl;
            cout << "Kategori : " << kategori[i] << endl;
            cout << "Harga    : Rp " << harga[i] << endl;
            cout << "---------------------------------" << endl;
        }
    }

    //Untuk menambahkan data produk baru
    void tambahData() {
        cout << "\nMasukkan data produk baru:\n";
        cout << "ID: ";
        cin >> id[jumlahProduk];
        
        // Validasi ID produk untuk menghindari duplikasi
        for (int i = 0; i < jumlahProduk; i++) {
            if (id[i] == id[jumlahProduk]) {
                cout << "ID sudah digunakan!\n";
                return;
            }
        }
        
        // Input data produk baru
        cout << "Nama: ";
        cin.ignore();
        getline(cin, nama[jumlahProduk]);
        
        cout << "Kategori: ";
        getline(cin, kategori[jumlahProduk]);
        
        cout << "Harga: ";
        cin >> harga[jumlahProduk];

        // Increment jumlah produk setelah penambahan berhasil
        jumlahProduk++;
        cout << "\nData Produk berhasil ditambahkan!\n";
    }

    //Untuk mengubah data produk yang sudah ada
    void ubahData() {
        string searchId;
        cout << "\nMasukkan ID produk yang akan diubah: ";
        cin >> searchId;

        // Mencari produk berdasarkan ID
        for (int i = 0; i < jumlahProduk; i++) {
            if (id[i] == searchId) {
                // Input data baru untuk produk yang akan diubah
                cout << "Masukkan data baru:\n";
                cout << "Nama (" << nama[i] << "): ";
                cin.ignore();
                getline(cin, nama[i]);
                
                cout << "Kategori (" << kategori[i] << "): ";
                getline(cin, kategori[i]);
                
                cout << "Harga (" << harga[i] << "): ";
                cin >> harga[i];

                cout << "\nData produk berhasil diubah!\n";
                return;
            }
        }
        cout << "ID produk tidak ditemukan!\n";
    }

    //Untuk menghapus data produk
    void hapusData() {
        string searchId;
        cout << "\nMasukkan ID produk yang akan dihapus: ";
        cin >> searchId;

        // Mencari produk berdasarkan ID
        for (int i = 0; i < jumlahProduk; i++) {
            if (id[i] == searchId) {
                // Menggeser data setelah indeks yang dihapus
                for (int j = i; j < jumlahProduk - 1; j++) {
                    id[j] = id[j + 1];
                    nama[j] = nama[j + 1];
                    kategori[j] = kategori[j + 1];
                    harga[j] = harga[j + 1];
                }
                // Mengurangi jumlah produk setelah penghapusan
                jumlahProduk--;
                cout << "Data produk berhasil dihapus!\n";
                return;
            }
        }
        cout << "ID tidak ditemukan!\n";
    }

    //Untuk mencari data produk berdasarkan ID
    void cariData() {
        string searchID;
        cout << "\nMasukkan ID produk yang dicari: ";
        cin.ignore();
        getline(cin, searchID);

        bool found = false;
        cout << "\nHasil pencarian:\n";
        cout << "----------------------------------------\n";
        
        // Mencari produk yang ID-nya mengandung string pencarian
        for (int i = 0; i < jumlahProduk; i++) {
            if (id[i].find(searchID) != string::npos) {
                // Menampilkan data produk yang ditemukan
                cout << "ID: " << id[i] << endl;
                cout << "Nama: " << nama[i] << endl;
                cout << "Kategori: " << kategori[i] << endl;
                cout << "Harga: " << harga[i] << endl;
                cout << "----------------------------------------\n";
                found = true;
            }
        }

        // Pesan jika produk tidak ditemukan
        if (!found) {
            cout << "ID produk tidak ditemukan!\n";
        }
    }
};