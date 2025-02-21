<?php
// Memeriksa apakah ada action yang dikirim melalui POST
if (isset($_POST['action'])) {
    switch ($_POST['action']) {

        // Menambah produk baru
        case 'add':
            // Memastikan semua data yang diperlukan tersedia
            if (isset($_POST['name'], $_POST['category'], $_POST['price'], $_FILES['photo'])) {
                // Membaca data produk dari file JSON, jika tidak ada buat array kosong
                $products = file_exists('products.json') ? json_decode(file_get_contents('products.json'), true) : [];

                // Mendapatkan ID terakhir dan menambahkannya untuk ID produk baru
                $lastId = end($products)['id'] ?? 0;
                $newId = $lastId + 1;

                // Menentukan nama file foto dan memindahkan foto ke folder uploads
                $photoName = 'uploads/' . time() . '_' . $_FILES['photo']['name'];
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoName);

                // Menambahkan produk baru ke dalam array produk
                $products[] = [
                    'id' => $newId,
                    'name' => $_POST['name'],
                    'category' => $_POST['category'],
                    'price' => $_POST['price'],
                    'photo' => $photoName
                ];

                // Menyimpan kembali data produk ke dalam file JSON
                file_put_contents('products.json', json_encode($products));
            }
            break;
        
        // Menghapus produk berdasarkan ID
        case 'delete':
            if (isset($_POST['id'])) {
                // Membaca data produk dari file JSON
                $products = json_decode(file_get_contents('products.json'), true);

                // Filter produk untuk menghapus produk yang sesuai dengan ID yang diberikan
                $products = array_filter($products, function ($product) {
                    return $product['id'] != $_POST['id'];
                });

                // Menyimpan kembali data produk yang sudah difilter
                file_put_contents('products.json', json_encode($products));
            }
            break;
        
        // Mengedit data produk berdasarkan ID
        case 'edit':
            if (isset($_POST['id'], $_POST['name'], $_POST['category'], $_POST['price'])) {
                // Membaca data produk dari file JSON
                $products = json_decode(file_get_contents('products.json'), true);

                // Mencari dan memperbarui data produk yang sesuai dengan ID
                foreach ($products as &$product) {
                    if ($product['id'] == $_POST['id']) {
                        $product['name'] = $_POST['name'];
                        $product['category'] = $_POST['category'];
                        $product['price'] = $_POST['price'];
                        
                        // Jika ada file foto baru, maka ganti foto lama
                        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                            $photoName = 'uploads/' . time() . '_' . $_FILES['photo']['name'];
                            move_uploaded_file($_FILES['photo']['tmp_name'], $photoName);
                            $product['photo'] = $photoName;
                        }
                    }
                }

                // Menyimpan kembali data produk yang sudah diperbarui
                file_put_contents('products.json', json_encode($products));
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pet Shop Abangnien</title>
</head>
<body>
    <h1>Welcome to Pet Shop Abangnien</h1>

    <!-- Form untuk menambah produk baru -->
    <h2>Menambah Data Produk</h2>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr><td>Nama Produk:</td><td><input type="text" name="name" required></td></tr>
            <tr><td>Kategori:</td><td><input type="text" name="category" required></td></tr>
            <tr><td>Harga:</td><td><input type="number" name="price" required></td></tr>
            <tr><td>Foto:</td><td><input type="file" name="photo" required></td></tr>
            <tr><td colspan="2"><button type="submit" name="action" value="add">Tambah Produk</button></td></tr>
        </table>
    </form>

    <!-- Form untuk mencari produk berdasarkan ID -->
    <h2>Mencari Daftar Produk</h2>
    <form method="get" style="margin-bottom: 10px;">
        <input type="text" name="search" placeholder="Cari ID Produk..." value="<?= $_GET['search'] ?? '' ?>">
        <button type="submit">Cari</button>
    </form>

    <h2>Tampilan Daftar Produk Pet Shop</h2>
    <h3>(Bisa Edit & Hapus di bagian Aksi)</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; text-align: center; width: 100%; background-color: #f2f2f2;">
        <tr style="background-color: #ccc;">
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Membaca data produk dari file JSON
        $products = file_exists('products.json') ? json_decode(file_get_contents('products.json'), true) : [];
        $search = $_GET['search'] ?? '';
        
        // Filter produk berdasarkan ID yang dicari
        $filteredProducts = array_filter($products, function ($product) use ($search) {
            // Jika ID kosong atau cocok, tampilkan produk tersebut
            return $search === '' || $product['id'] == (int)$search;
        });
        
        if (!is_array($filteredProducts)) {
            $filteredProducts = [];
        }
        
        // Menampilkan daftar produk
        if (count($filteredProducts) > 0) {
            foreach ($filteredProducts as $product) {
                echo "<tr>";
                echo "<td>{$product['id']}</td>";
                echo "<td>{$product['name']}</td>";
                echo "<td>{$product['category']}</td>";
                echo "<td>{$product['price']}</td>";
                echo "<td><img src='{$product['photo']}' width='100'></td>";
                echo "<td>";
                // Form untuk edit produk
                echo "<form method='post' enctype='multipart/form-data' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='{$product['id']}'>";
                echo "<input type='text' name='name' value='{$product['name']}' required>";
                echo "<input type='text' name='category' value='{$product['category']}' required>";
                echo "<input type='number' name='price' value='{$product['price']}' required>";
                echo "<input type='file' name='photo'>";
                echo "<button type='submit' name='action' value='edit'>Ubah</button>";
                echo "</form>";
                // Form untuk hapus produk
                echo "<form method='post' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='{$product['id']}'>";
                echo "<button type='submit' name='action' value='delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data produk abangkuu.</td></tr>";
        }
        ?>
    </table>
</body>
</html>