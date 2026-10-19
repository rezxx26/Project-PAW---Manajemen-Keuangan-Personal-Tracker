<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction | FinTrack</title>

    <style>
        :root {
            --primary: #155E75;
            --primary-dark: #164E63;
            --primary-light: #DDF3F7;
            --background: #F4F8FA;
            --surface: #FFFFFF;
            --text: #20343D;
            --text-muted: #71818A;
            --border: #DCE7EB;
            --income: #16805D;
            --income-light: #E5F5ED;
            --expense: #C24141;
            --expense-light: #FCEAEA;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: var(--background);
            color: var(--text);
        }

        button, input, select, textarea {
            font: inherit;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 245px;
            flex-shrink: 0;
            background: var(--surface);
            border-right: 1px solid var(--border);
            padding: 28px 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 34px;
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: #FFFFFF;
            border-radius: 10px;
            font-size: 22px;
            font-weight: 700;
        }

        .menu-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #71818A;
            margin-bottom: 12px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .menu a {
            text-decoration: none;
            color: var(--text-muted);
            padding: 13px 14px;
            border-radius: 9px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #F0F7F9;
            color: var(--primary);
        }

        .menu a.active {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
        }

        .main {
            flex: 1;
            padding: 38px;
        }

        .content {
            max-width: 900px;
            margin: 0 auto;
        }

        .breadcrumb {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 17px;
        }

        h1 {
            font-size: 29px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .section-description {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 22px;
        }

        .transaction-type {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 30px;
        }

        .type-option {
            padding: 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
            text-align: center;
        }

        .type-option:hover {
            border-color: var(--primary);
        }

        .type-option.active[data-type="expense"] {
            background: var(--expense-light);
            color: var(--expense);
            border-color: #E9AAAA;
        }

        .type-option.active[data-type="income"] {
            background: var(--income-light);
            color: var(--income);
            border-color: #9BD6BA;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 13px;
            font-weight: 700;
        }

        .field-hint {
            font-size: 12px;
            color: var(--text-muted);
        }

        input, select {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: 9px;
            font-size: 14px;
            outline: none;
        }

        input:focus, select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(21, 94, 117, 0.10);
        }

        .amount-wrapper {
            display: flex;
            border: 1px solid var(--border);
            border-radius: 9px;
            overflow: hidden;
        }

        .amount-prefix {
            padding: 13px 15px;
            background: #F0F6F8;
            color: var(--primary);
            font-weight: 700;
            border-right: 1px solid var(--border);
        }

        .amount-wrapper input {
            border: none;
            border-radius: 0;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid #EDF2F4;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 9px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border: 1px solid transparent;
        }

        .btn-cancel {
            background: white;
            border-color: var(--border);
            color: var(--text-muted);
        }

        .btn-save {
            background: var(--primary);
            color: white;
        }
    </style>
</head>

<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="brand">
                <span class="brand-icon">F</span>
                <span>FinTrack</span>
            </div>

            <p class="menu-label">MENU UTAMA</p>

            <nav class="menu" aria-label="Navigasi utama">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('transactions.index') }}">Transactions</a>
                <a href="{{ route('transactions.create') }}" class="active">Add Transaction</a>
            </nav>
        </aside>

        <main class="main">
            <div class="content">

                <div class="breadcrumb">Transactions / Add Transaction</div>

                <h1>Add Transaction</h1>
                <p class="subtitle">Catat pemasukan dan pengeluaran untuk memantau kondisi keuanganmu.</p>

                <section class="form-card">
                    <h2 class="section-title">Transaction Details</h2>
                    <p class="section-description">Lengkapi informasi transaksi di bawah ini.</p>

                    <form id="transactionForm" action="{{ route('transactions.store') }}" method="POST">
                        @csrf

                        <div class="transaction-type">
                            <button type="button" class="type-option active" data-type="expense">Pengeluaran</button>
                            <button type="button" class="type-option" data-type="income">Pemasukan</button>
                        </div>

                        <input type="hidden" id="type" name="type" value="expense">

                        <div class="form-grid">

                            <div class="form-group full-width">
                                <label for="name">Nama Transaksi</label>
                                <input type="text" id="name" name="name" placeholder="Contoh: Makan siang" required>
                            </div>

                            <div class="form-group">
                                <label for="amount">Nominal</label>
                                <div class="amount-wrapper">
                                    <span class="amount-prefix">Rp</span>
                                    <input type="number" id="amount" name="amount" placeholder="Contoh: 150000" required>
                                </div>
                                <span class="field-hint">Masukkan angka murni tanpa titik atau koma.</span>
                            </div>

                            <div class="form-group">
                                <label for="category">Kategori</label>
                                <select id="category" name="category" required>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" id="date" name="tanggal" value="{{ date('Y-m-d') }}" required>
                            </div>

                        </div>

                        <div class="actions">
                            <a href="{{ route('transactions.index') }}" class="btn btn-cancel">Batal</a>
                            <button type="submit" class="btn btn-save">Simpan Transaksi</button>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>

    <script>
        const typeButtons = document.querySelectorAll('.type-option');
        const typeInput = document.getElementById('type');
        const categorySelect = document.getElementById('category');

        const categories = {
            expense: ['Makanan & Minuman', 'Transportasi', 'Belanja', 'Tagihan', 'Hiburan', 'Lainnya'],
            income: ['Gaji', 'Bonus', 'Freelance', 'Investasi', 'Lainnya']
        };

        function updateCategories(type) {
            categorySelect.innerHTML = '';
            categories[type].forEach(cat => {
                const opt = document.createElement('option');
                opt.value = cat;
                opt.textContent = cat;
                categorySelect.appendChild(opt);
            });
        }

        typeButtons.forEach(button => {
            button.addEventListener('click', () => {
                typeButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                const selectedType = button.dataset.type;
                typeInput.value = selectedType;
                updateCategories(selectedType);
            });
        });
        updateCategories('expense');
    </script>
</body>
</html>
