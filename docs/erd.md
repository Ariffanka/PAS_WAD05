erDiagram
    USERS ||--o{ STOCK_MOVEMENTS : records
    CATEGORIES ||--o{ PRODUCTS : contains
    SUPPLIERS ||--o{ PRODUCTS : supplies
    PRODUCTS ||--o{ STOCK_MOVEMENTS : has

    USERS {
        bigint id PK
        string name
        string email
        string password
        string role
    }

    CATEGORIES {
        bigint id PK
        string name
        text description
    }

    SUPPLIERS {
        bigint id PK
        string name
        string phone
        string address
    }

    PRODUCTS {
        bigint id PK
        bigint category_id FK
        bigint supplier_id FK
        string name
        string description
        decimal price
        int stock
    }

    STOCK_MOVEMENTS {
        bigint id PK
        bigint product_id FK
        bigint user_id FK
        enum type
        int quantity
        text description
        timestamp created_at
    }
