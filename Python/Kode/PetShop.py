class PetShop:
    def __init__(self):
        self._ids = []
        self._names = []
        self._categories = []
        self._prices = []
    
    # Getter untuk mendapatkan semua data dalam format yang sesuai
    def get_products(self):
        products = []
        for i in range(len(self._ids)):
            product = type('Product', (), {
                'id': self._ids[i],
                'nama': self._names[i],
                'kategori': self._categories[i],
                'harga': self._prices[i]
            })
            products.append(product)
        return products
    
    # Getter untuk masing-masing list
    def get_ids(self):
        return self._ids
    
    def get_names(self):
        return self._names
    
    def get_categories(self):
        return self._categories
    
    def get_prices(self):
        return self._prices
    
    # Setter untuk mengubah data berdasarkan index
    def set_name(self, index, value):
        if 0 <= index < len(self._names):
            self._names[index] = value
    
    def set_category(self, index, value):
        if 0 <= index < len(self._categories):
            self._categories[index] = value
    
    def set_price(self, index, value):
        if 0 <= index < len(self._prices):
            self._prices[index] = value
    
    # Method untuk menambah produk
    def add_product(self, id, nama, kategori, harga):
        self._ids.append(id)
        self._names.append(nama)
        self._categories.append(kategori)
        self._prices.append(harga)
    
    # Method untuk menghapus produk
    def remove_product(self, id):
        for i in range(len(self._ids)):
            if self._ids[i] == id:
                self._ids.pop(i)
                self._names.pop(i)
                self._categories.pop(i)
                self._prices.pop(i)
                return True
        return False
    
    # Method untuk mengubah data produk
    def update_product(self, id, nama, kategori, harga):
        for i in range(len(self._ids)):
            if self._ids[i] == id:
                self._names[i] = nama
                self._categories[i] = kategori
                self._prices[i] = harga
                return True
        return False