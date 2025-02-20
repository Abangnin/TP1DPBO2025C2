from PetShop import PetShop

def tampilkan_data(pet_shop):
    
    # Menampilkan semua data produk yang ada di pet shop
    products = pet_shop.get_products()
    if not products:
        print("\nTidak ada data produk yang tersedia.")
        return
    
    for product in products:
        print("+------------------------------+")
        print(f"ID: {product.id}")
        print(f"Nama: {product.nama}")
        print(f"Kategori: {product.kategori}")
        print(f"Harga: Rp {product.harga}")
        print("+------------------------------+\n")

def tambah_data(pet_shop):
   
    # Menambahkan produk baru ke pet shop
    
    id_produk = input("ID: ")
    # Cek apakah ID sudah ada
    for product in pet_shop.get_products():
        if product.id == id_produk:
            print("+------------------------------+")
            print("|      ID sudah digunakan!     |")
            print("+------------------------------+\n")
            return
    
    nama = input("Nama: ")
    kategori = input("Kategori: ")
    while True:
        try:
            harga = float(input("Harga: "))
            break
        except ValueError:
            print("Masukkan harga yang valid!")
    
    pet_shop.add_product(id_produk, nama, kategori, harga)
    print("+------------------------------+")
    print("| Produk berhasil ditambahkan! |")
    print("+------------------------------+\n")

def ubah_data(pet_shop):

    #Mengubah data produk yang sudah ada di pet shop
    
    search_id = input("Masukkan ID produk yang akan diubah: ")
    nama_baru = input("Nama baru: ")
    kategori_baru = input("Kategori baru: ")
    
    while True:
        try:
            harga_baru = float(input("Harga baru: "))
            break
        except ValueError:
            print("Masukkan harga yang valid!")
    
    if pet_shop.update_product(search_id, nama_baru, kategori_baru, harga_baru):
        print("+------------------------------+")
        print("|   Produk berhasil diubah!    |")
        print("+------------------------------+\n")
    else:
        print("+------------------------------+")
        print("|  ID produk nggaa ditemukan!  |")
        print("+------------------------------+\n")

def hapus_data(pet_shop):
    
    # Menghapus produk dari pet shop berdasarkan ID.
    search_id = input("Masukkan ID produk yang akan dihapus: ")
    if pet_shop.remove_product(search_id):
        print("+------------------------------+")
        print("|   Produk berhasil dihapus!   |")
        print("+------------------------------+\n")
    else:
        print("+------------------------------+")
        print("|  ID produk nggaa ditemukan!  |")
        print("+------------------------------+\n")

def cari_data(pet_shop):
    
    # Mencari produk berdasarkan namanya
    search_nama = input("Masukkan nama produk yang dicari: ").lower()
    found = False
    
    for product in pet_shop.get_products():
        if search_nama in product.nama.lower():
            print("+------------------------------+")
            print(f"ID: {product.id}")
            print(f"Nama: {product.nama}")
            print(f"Kategori: {product.kategori}")
            print(f"Harga: Rp {product.harga}")
            print("+------------------------------+\n")
            found = True
    
    if not found:
        print("+------------------------------+")
        print("|   Produk nggaa ditemukan!!   |")
        print("+------------------------------+\n")

def main():
    # Inisialisasi objek PetShop
    pet_shop = PetShop()
    
    # Loop utama program
    while True:
        # Menampilkan menu
        print("+=============================+")
        print("| Ayo bisa pilih menunya nih: |")
        print("+=============================+")
        print("| 1 | Tampilkan (show)        |")
        print("| 2 | Tambah (add)            |")
        print("| 3 | Ubah (change)           |")
        print("| 4 | Hapus (delete)          |")
        print("| 5 | Cari (search)           |")
        print("| 0 | Keluar (exit)           |")
        print("+=============================+")
        
        # Meminta dan memvalidasi input pilihan menu
        try:
            pilihan = int(input("=> Pilihhh: "))
        except ValueError:
            print("+============================+")
            print("|  Pilihan kamu tidak valid  |")
            print("+============================+\n")
            continue

        # Menjalankan fungsi sesuai pilihan
        if pilihan == 1:
            tampilkan_data(pet_shop) # Untuk menampilkan data
        elif pilihan == 2:
            tambah_data(pet_shop) # Untuk menambahkan data
        elif pilihan == 3:
            ubah_data(pet_shop) # Untuk mengubah data
        elif pilihan == 4:
            hapus_data(pet_shop) # Untuk hapus data
        elif pilihan == 5:
            cari_data(pet_shop) # Untuk mencari data
        elif pilihan == 0: # Untuk exit
            print("+============================+")
            print("|    Program dah selesai.    |")
            print("+============================+")
            break
        else:
            print("+============================+")
            print("|  Pilihan kamu tidak valid  |")
            print("+============================+")

if __name__ == "__main__":
    main()