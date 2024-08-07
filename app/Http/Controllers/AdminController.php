<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CategoryRequest;

class AdminController extends Controller
{
    public function index()
    {
        try {
            //Related to transactions
            $transactions_today = 0;
            $transactions_weekly = 0;
            $transactions_monthly = 0;
            $transactions_yearly = 0;

            //Related to users
            $users_today = 0;
            $users_weekly = 0;
            $users_monthly = 0;
            $users_yearly = 0;

            //Companies
            $total_companies = 0;
            $total_users = 0;
            $total_packages = 0;
            $total_transactions = 0;

            return view('admin.index', compact(
                'transactions_today',
                'transactions_weekly',
                'transactions_monthly',
                'transactions_yearly',
                'users_today',
                'users_weekly',
                'users_monthly',
                'users_yearly',
                'total_companies',
                'total_users',
                'total_packages',
                'total_transactions'

            ));
        } catch (\Exception $exception) {
            toastr()->error('Something went wrong, try again');
            return back();
        }
    }

    public function categoriesList()
    {
        $categories = Category::latest()->get();
        return view('admin.Category.index', compact('categories'));
    }

    public function categorySave(CategoryRequest $request)
    {
        try {
            $savecategory = new Category();
            $savecategory->title = $request->title;
            $savecategory->description = $request->description;
            $savecategory->save();

            return back()->with('success', 'Category Saved Successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function categoryDestroy($id)
    {
        try {
            Category::findOrFail($id)->delete();
            return back()->with('success', 'Category deleted successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function categoryEdit(Category $category)
    {
        return response()->json($category);
    }

    public function categoryUpdate(CategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());
            return redirect()->route('categories')->with('success', 'Category updated successfully.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('categories')->with('error', 'Something went wrong.');
        }
    }
}
