import java.util.ArrayList;
import java.util.Scanner;

public class Main { // Kelas utama untuk menjalankan aplikasi PetShop
    public static void main(String[] args) {
        PetShop petShop = new PetShop();
        Scanner scanner = new Scanner(System.in); // Membuat objek Scanner untuk membaca input dari pengguna
        int pilihan;

        do { // Memulai loop utama untuk menampilkan menu dan memproses input pengguna
            System.out.println("+=============================+");
            System.out.println("| Ayo dipilih menu - menunya: |");
            System.out.println("+=============================+");
            System.out.println("| 1 | Tampilkan (show)        |");
            System.out.println("| 2 | Tambah (add)            |");
            System.out.println("| 3 | Ubah (change)           |");
            System.out.println("| 4 | Hapus (delete)          |");
            System.out.println("| 5 | Cari (search)           |");
            System.out.println("| 0 | Keluar (exit)           |");
            System.out.println("+=============================+");
            System.out.print("=> Pilihan: ");
            
            pilihan = scanner.nextInt();
            scanner.nextLine();
            
            switch (pilihan) {
                case 1:
                    tampilkanData(petShop); // Memanggil metode untuk menampilkan data produk
                    break;
                case 2:
                    tambahData(petShop, scanner); // Memanggil metode untuk menambahkan produk baru
                    break;
                case 3:
                    ubahData(petShop, scanner); // Memanggil metode untuk mengubah data produk berdasarkan ID
                    break;
                case 4:
                    hapusData(petShop, scanner); // Memanggil metode untuk menghapus data produk berdasarkan ID
                    break;
                case 5:
                    cariData(petShop, scanner); // Memanggil metode untuk mencari produk berdasarkan nama
                    break;
                case 0:
                    System.out.println("+============================+");
                    System.out.println("|    Program dah selesai.    |");
                    System.out.println("+============================+");
                    break;
                default:
                    System.out.println("+============================+");
                    System.out.println("|  Pilihan kamu tidak valid  |");
                    System.out.println("+============================+");
            }
        } while (pilihan != 0);

        scanner.close();
    }

    private static void tampilkanData(PetShop petShop) {
        ArrayList<PetShop.Product> products = petShop.getProducts(); // Mengambil semua produk yang ada di PetShop
        if (products.isEmpty()) { // Mengecek apakah daftar produk kosong
            System.out.println("\nTidak ada data produk yang tersedia.");
            return;
        }
        for (PetShop.Product product : products) {  // Mengiterasi semua produk untuk ditampilkan
            System.out.println("+------------------------------+");
            System.out.println("ID: " + product.getId());
            System.out.println("Nama: " + product.getNama());
            System.out.println("Kategori: " + product.getKategori());
            System.out.println("Harga: Rp " + product.getHarga());
            System.out.println("+------------------------------+\n");
        }
    }

    private static void tambahData(PetShop petShop, Scanner scanner) { // Menambahkan produk baru ke dalam PetShop
        System.out.print("ID: ");
        String id = scanner.nextLine();
        // Cek apakah ID sudah ada
        for (PetShop.Product product : petShop.getProducts()) {
            if (product.getId().equals(id)) {
                System.out.println("+------------------------------+");
                System.out.println("|      ID sudah digunakan!     |");
                System.out.println("+------------------------------+\n");
                return;
            }
        }
        System.out.print("Nama: ");
        String nama = scanner.nextLine();
        System.out.print("Kategori: ");
        String kategori = scanner.nextLine();
        System.out.print("Harga: ");
        double harga = scanner.nextDouble();
        scanner.nextLine();
        petShop.addProduct(new PetShop.Product(id, nama, kategori, harga));
        System.out.println("+------------------------------+");
        System.out.println("| Produk berhasil ditambahkan! |");
        System.out.println("+------------------------------+\n");
    }

    private static void ubahData(PetShop petShop, Scanner scanner) { // Mencari produk berdasarkan ID dalam metode ubahData
        System.out.print("Masukkan ID produk yang akan diubah: ");
        String searchId = scanner.nextLine();
        for (PetShop.Product product : petShop.getProducts()) {
            if (product.getId().equals(searchId)) {
                System.out.print("Nama baru: ");
                product.setNama(scanner.nextLine());
                System.out.print("Kategori baru: ");
                product.setKategori(scanner.nextLine());
                System.out.print("Harga baru: ");
                product.setHarga(scanner.nextDouble());
                scanner.nextLine();
                System.out.println("+------------------------------+");
                System.out.println("|   Produk berhasil diubah!!   |");
                System.out.println("+------------------------------+\n");
                return;
            }
        }
        System.out.println("+------------------------------+");
        System.out.println("|  ID produk nggaa ditemukan!  |");
        System.out.println("+------------------------------+\n");
    }

    private static void hapusData(PetShop petShop, Scanner scanner) { // Menghapus produk berdasarkan ID menggunakan metode PetShop
        System.out.print("Masukkan ID produk yang akan dihapus: ");
        String searchId = scanner.nextLine();
        if (petShop.removeProduct(searchId)) {
            System.out.println("+------------------------------+");
            System.out.println("|   Produk berhasil dihapus!   |");
            System.out.println("+------------------------------+\n");
        } else {
            System.out.println("+------------------------------+");
            System.out.println("|  ID produk nggaa ditemukan!  |");
            System.out.println("+------------------------------+\n");
        }
    }

    private static void cariData(PetShop petShop, Scanner scanner) { // Mencari produk berdasarkan nama dalam metode cariData
        System.out.print("Masukkan nama produk yang dicari: ");
        String searchNama = scanner.nextLine().toLowerCase();
        boolean found = false;
        for (PetShop.Product product : petShop.getProducts()) {
            if (product.getNama().toLowerCase().contains(searchNama)) {
                System.out.println("+------------------------------+");
                System.out.println("ID: " + product.getId());
                System.out.println("Nama: " + product.getNama());
                System.out.println("Kategori: " + product.getKategori());
                System.out.println("Harga: Rp " + product.getHarga());
                System.out.println("+------------------------------+\n");
                found = true;
            }
        }
        if (!found) {
            System.out.println("+------------------------------+");
            System.out.println("|   Produk nggaa ditemukan!!   |");
            System.out.println("+------------------------------+\n");
        }
    }
}
