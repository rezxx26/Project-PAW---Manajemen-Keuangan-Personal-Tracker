<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions | FinTrack</title>

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
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: var(--background);
            color: var(--text);
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

        .nav-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .nav a {
            display: flex;
            align-items: center;
            min-height: 44px;
            padding: 12px 14px;
            border-radius: 9px;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 14px;
            transition: 0.2s;
        }

        .nav a:hover {
            background: #F0F7F9;
            color: var(--primary);
        }

        .nav a.active {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
        }

        .main {
            flex: 1;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 14px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            background: var(--primary);
            color: #FFFFFF;
            text-decoration: none;
            padding: 12px 17px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
        }

        .button:hover {
            background: var(--primary-dark);
        }

        .alert-success {
            padding: 12px 16px;
            background: var(--income-light);
            color: var(--income);
            border: 1px solid #9BD6BA;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 21px;
        }

        .summary-card p {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 13px;
        }

        .summary-card h2 {
            font-size: 22px;
        }

        .income { color: var(--income); }
        .expense { color: var(--expense); }

        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .panel-title { font-size: 17px; }

        .filters {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        input, select {
            padding: 11px 13px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            outline: none;
        }

        input { flex: 1; }

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            font-size: 12px;
            color: var(--text-muted);
            padding: 14px 12px;
            border-bottom: 1px solid #EDF2F4;
        }

        td {
            font-size: 13px;
            padding: 17px 12px;
            border-bottom: 1px solid #F0F4F5;
        }

        .category {
            background: #F0F6F8;
            padding: 6px 10px;
            border-radius: 6px;
            color: #536A74;
            font-size: 12px;
        }

        .income-text { color: var(--income); font-weight: bold; }
        .expense-text { color: var(--expense); font-weight: bold; }

        /* Style Tambahan untuk Tombol Aksi */
        .btn-action-group {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-edit {
            background: #EAB308;
            color: #FFFFFF;
            padding: 6px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-edit:hover { background: #CA8A04; }

        .btn-delete {
            background: #EF4444;
            color: #FFFFFF;
            padding: 6px 10px;
            border-radius: 6px;
            border: none;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-delete:hover { background: #DC2626; }
    </style>
</head>

<body>
<div class="layout">

    <aside class="sidebar">
        <div class="brand">
            <span class="brand-icon">F</span>
            <span>FinTrack</span>
        </div>

        <p class="nav-label">MENU UTAMA</p>

        <nav class="nav">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('transactions.index') }}" class="active">Transactions</a>
            <a href="{{ route('transactions.create') }}">Add Transaction</a>
        </nav>
    </aside>

    <main class="main">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <header class="topbar">
            <div>
                <h1>Transactions</h1>
                <p class="subtitle">Manage and review your income and expenses.</p>
            </div>

            <a class="button" href="{{ route('transactions.create') }}">+ Add Transaction</a>
        </header>

        <section class="summary">
            <div class="summary-card">
                <p>Total Transactions</p>
                <h2>{{ $transactions->count() }}</h2>
            </div>

            <div class="summary-card">
                <p>Total Income</p>
                <h2 class="income">Rp {{ number_format($totalIncome ?? 0, 0, ',', '.') }}</h2>
            </div>

            <div class="summary-card">
                <p>Total Expenses</p>
                <h2 class="expense">Rp {{ number_format($totalExpense ?? 0, 0, ',', '.') }}</h2>
            </div>
        </section>

        <section class="panel">
            <h2 class="panel-title">Find a transaction</h2>

            <div class="filters">
                <input type="text" id="searchInput" placeholder="Search transaction or category...">
                <select id="typeFilter">
                    <option value="all">All types</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>
        </section>

        <section class="panel">
            <div class="table-heading">
                <h2>All Transactions</h2>
                <span class="subtitle">{{ $transactions->count() }} records</span>
            </div>

            <div class="table-wrap">
                <table id="transactionsTable">
                    <thead>
                        <tr>
                            <th>TRANSACTION</th>
                            <th>CATEGORY</th>
                            <th>DATE</th>
                            <th>TYPE</th>
                            <th>AMOUNT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $item)
                            @php
                                $isIncome = strtolower($item->type) === 'income';
                                $amountClass = $isIncome ? 'income-text' : 'expense-text';
                                $sign = $isIncome ? '+' : '-';
                            @endphp
                            <tr data-type="{{ strtolower($item->type) }}" data-search="{{ strtolower($item->description . ' ' . ($item->category->name ?? 'umum')) }}">
                                <td>{{ $item->description }}</td>
                                <td><span class="category">{{ $item->category->name ?? 'Umum' }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                <td><strong>{{ ucfirst($item->type) }}</strong></td>
                                <td class="{{ $amountClass }}">
                                    {{ $sign }} Rp {{ number_format($item->amount, 0, ',', '.') }}
                                </td>
                                <td>
                                    <div class="btn-action-group">
                                        <a href="{{ route('transactions.edit', $item->id) }}" class="btn-edit">Edit</a>
                                        
                                        <form action="{{ route('transactions.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 20px;">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const tableRows = document.querySelectorAll('#transactionsTable tbody tr');

    function filterTable() {
        const query = searchInput.value.toLowerCase();
        const selectedType = typeFilter.value;

        tableRows.forEach(row => {
            const searchData = row.dataset.search || '';
            const rowType = row.dataset.type || '';

            const matchesSearch = searchData.includes(query);
            const matchesType = selectedType === 'all' || rowType === selectedType;

            if (matchesSearch && matchesType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    typeFilter.addEventListener('change', filterTable);
</script>
</body>
</html>
