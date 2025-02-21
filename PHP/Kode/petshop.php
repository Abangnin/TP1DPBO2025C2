<?php
// Deklarasi class PetShop
class PetShop {
    // Deklarasi property untuk menyimpan data produk
    private $ids = array();         // Menyimpan ID produk
    private $names = array();       // Menyimpan nama produk
    private $categories = array();  // Menyimpan kategori produk
    private $prices = array();      // Menyimpan harga produk
    private $photos = array();      // Menyimpan foto produk

    // Method untuk menambah produk baru
    public function addProduct($name, $category, $price, $photo) {
        // Generate ID baru berdasarkan jumlah produk yang ada
        $id = count($this->ids) + 1;

        // Simpan data produk ke dalam array yang sesuai
        $this->ids[] = $id;
        $this->names[] = $name;
        $this->categories[] = $category;
        $this->prices[] = $price;
        $this->photos[] = $photo;
    }

    // Method untuk mendapatkan semua ID produk
    public function getIds() {
        return $this->ids;
    }

    // Method untuk mendapatkan semua nama produk
    public function getNames() {
        return $this->names;
    }

    // Method untuk mendapatkan semua kategori produk
    public function getCategories() {
        return $this->categories;
    }

    // Method untuk mendapatkan semua harga produk
    public function getPrices() {
        return $this->prices;
    }

    // Method untuk mendapatkan semua foto produk
    public function getPhotos() {
        return $this->photos;
    }

    // Method untuk menghapus produk berdasarkan ID
    public function deleteProduct($id) {
        // Cari index produk berdasarkan ID
        $index = array_search($id, $this->ids);

        // Jika produk ditemukan, hapus data pada semua array
        if ($index !== false) {
            unset($this->ids[$index]);
            unset($this->names[$index]);
            unset($this->categories[$index]);
            unset($this->prices[$index]);
            unset($this->photos[$index]);

            // Reindex array agar urutannya rapih kembali
            $this->ids = array_values($this->ids);
            $this->names = array_values($this->names);
            $this->categories = array_values($this->categories);
            $this->prices = array_values($this->prices);
            $this->photos = array_values($this->photos);
        }
    }

    // Method untuk mengubah data produk berdasarkan ID
    public function editProduct($id, $name, $category, $price) {
        // Cari index produk berdasarkan ID
        $index = array_search($id, $this->ids);

        // Jika produk ditemukan, update data produk
        if ($index !== false) {
            $this->names[$index] = $name;
            $this->categories[$index] = $category;
            $this->prices[$index] = $price;
        }
    }
}
?>
