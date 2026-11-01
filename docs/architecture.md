
flowchart TD
    A[User membuka aplikasi] --> B{Sudah login?}
    B -- Tidak --> C[Halaman Login]
    C --> D[AuthController]
    D --> E{Kredensial valid?}
    E -- Tidak --> C
    E -- Ya --> F[Session dibuat]
    B -- Ya --> G[Dashboard]
    F --> G

    G --> H{Pilih fitur}
    H --> I[Produk]
    H --> J[Kategori]
    H --> K[Supplier]
    H --> L[Pergerakan Stok]

    I --> M[ProductController]
    J --> N[CategoryController]
    K --> O[SupplierController]
    L --> P[StockMovementController]

    M --> Q[Validasi dan Model Eloquent]
    N --> Q
    O --> Q
    P --> Q

    Q --> R[(Database MySQL)]
    R --> S[Controller mengirim hasil]
    S --> T[View Blade]
    T --> U[Response ke Browser]
