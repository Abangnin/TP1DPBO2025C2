import java.util.ArrayList;

public class PetShop {
    // Inner class untuk menyimpan data produk
    public static class Product {
        private String id;
        private String nama;
        private String kategori;
        private double harga;

        // Constructor
        public Product(String id, String nama, String kategori, double harga) {
            this.id = id;
            this.nama = nama;
            this.kategori = kategori;
            this.harga = harga;
        }

        // Getters
        public String getId() { return id; }
        public String getNama() { return nama; }
        public String getKategori() { return kategori; }
        public double getHarga() { return harga; }

        // Setters
        public void setNama(String nama) { this.nama = nama; }
        public void setKategori(String kategori) { this.kategori = kategori; }
        public void setHarga(double harga) { this.harga = harga; }
    }

    // List untuk menyimpan produk
    private ArrayList<Product> products;

    // Constructor
    public PetShop() {
        products = new ArrayList<>();
    }

    // Method untuk mengakses produk
    public ArrayList<Product> getProducts() {
        return products;
    }

    // Method untuk menambahkan produk baru
    public void addProduct(Product product) {
        products.add(product);
    }

    // Method untuk menghapus produk berdasarkan ID
    public boolean removeProduct(String id) {
        for (int i = 0; i < products.size(); i++) {
            if (products.get(i).getId().equals(id)) {
                products.remove(i);
                return true;
            }
        }
        return false;
    }
}
