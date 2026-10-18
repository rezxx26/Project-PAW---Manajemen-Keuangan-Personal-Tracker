<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller {
    public function index() {
        $transactions = Transaction::with('category') -> latest('date') -> get();
        
        $totalIncome = Transaction::where('type', 'income') -> sum('amount');
        $totalExpense = Transaction::where('type', 'expense') -> sum('amount');

        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpense'));
    }

    public function create() {
        $incomeCategories = Category::where('type', 'income') -> get();
        $expenseCategories = Category::where('type', 'expense') -> get();

        return view('transactions.create', compact('incomeCategories', 'expenseCategories'));
    }

    public function store(Request $request) {
        $validated = $request -> validate([
            'tanggal' => 'required|date',
            'type' => 'required|in:income,expense',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
        ]);

        $userId = auth() -> id() ?? User::value('id');
        if (!$userId) {
            $user = User::create([
                'name' => 'User Demo',
                'email' => 'user@fintrack.com',
                'password' => bcrypt('password'),
            ]);
            $userId = $user -> id;
        }

        $category = Category::where('name', $validated['category'])  ->  first();
        if ($category) {
            $categoryId = $category -> id;
        } else {
            $category = Category::create([
                'name' => $validated['category'],
                'type' => $validated['type'],
            ]);
            $categoryId = $category -> id;
        }

        Transaction::create([
            'user_id' => $userId,
            'category_id' => $categoryId,
            'amount' => $validated['amount'],
            'type' => $validated['type'],
            'date' => $validated['tanggal'],
            'description' => $validated['name'],
            'payment_method' => 'Cash',
            'note' => null,
        ]);

        return redirect() -> route('transactions.index') -> with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id) {
        $transaction = Transaction::findOrFail($id);
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, $id) {
    $request -> validate([
        'description' => 'required|string|max:255',
        'amount' => 'required|numeric',
        'type' => 'required|in:income,expense',
        'category_id' => 'required|exists:categories,id',
        'date' => 'required|date',
    ]);

    $transaction = Transaction::findOrFail($id);
    
    $transaction -> update([
        'description' => $request -> description,
        'amount' => $request -> amount,
        'type' => $request -> type,
        'category_id' => $request -> category_id,
        'date' => $request -> date,
    ]);

    return redirect() -> route('transactions.index') -> with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id) {
        $transaction = Transaction::findOrFail($id);
        $transaction -> delete();

        return redirect() -> route('transactions.index') -> with('success', 'Transaksi berhasil dihapus!');
    }
}
