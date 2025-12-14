<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\QuickFact;
use App\Models\ContactMessage;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\Auth;
use App\Models\about_us;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard with specific page_type
     */
    public function index(Request $request)
    {
        $pageType = $request->get('page_type', 'faq');

        $items = collect();
        $questions = null;

        switch ($pageType) {

            case 'faq':
                $items = Faq::orderBy('order')->orderBy('id')->paginate(10);
                break;

            case 'quick-facts':
                $items = QuickFact::orderBy('order')->orderBy('id')->paginate(10);
                break;

            case 'questions':
                $questions = ContactMessage::orderByDesc('created_at')->paginate(6);
                break;

            case 'contact_info':
                $items = ContactInfo::first();
                break;

            default:
                abort(404);
        }

        return view('admin.dashboard', compact(
            'pageType',
            'items',
            'questions'
        ));
    }

    /**
     * Store a new resource
     */
    public function store(Request $request, $resource)
    {
        switch ($resource) {

            case 'faq':
                $request->validate([
                    'question'  => 'required|string|max:255',
                    'answer'    => 'required|string',
                    'order'     => 'nullable|integer',
                    'is_active' => 'nullable|boolean',
                ]);

                Faq::create([
                    'question'  => $request->question,
                    'answer'    => $request->answer,
                    'order'     => $request->order ?? 0,
                    'is_active' => $request->has('is_active'),
                ]);
                break;

            case 'quick-facts':
                $request->validate([
                    'text'      => 'required|string|max:500',
                    'order'     => 'nullable|integer',
                    'is_active' => 'nullable|boolean',
                ]);

                QuickFact::create([
                    'text'      => $request->text,
                    'order'     => $request->order ?? 0,
                    'is_active' => $request->has('is_active'),
                ]);
                break;

            default:
                abort(404);
        }

        return redirect()->route('kontrolni-panel', ['page_type' => $resource])
                         ->with('status', ucfirst($resource) . ' uspešno dodat!');
    }

    /**
     * Update a resource
     */
    public function update(Request $request, $resource, $id)
    {
        switch ($resource) {

            case 'faq':
                $item = Faq::findOrFail($id);
                $request->validate([
                    'question'  => 'required|string|max:255',
                    'answer'    => 'required|string',
                    'order'     => 'nullable|integer',
                    'is_active' => 'nullable|boolean',
                ]);
                $item->update([
                    'question'  => $request->question,
                    'answer'    => $request->answer,
                    'order'     => $request->order ?? 0,
                    'is_active' => $request->has('is_active'),
                ]);
                break;

            case 'quick-facts':
                $item = QuickFact::findOrFail($id);
                $request->validate([
                    'text'      => 'required|string|max:500',
                    'order'     => 'nullable|integer',
                    'is_active' => 'nullable|boolean',
                ]);
                $item->update([
                    'text'      => $request->text,
                    'order'     => $request->order ?? 0,
                    'is_active' => $request->has('is_active'),
                ]);
                break;

            case 'questions':
                $item = ContactMessage::findOrFail($id);
                $request->validate([
                    'comment' => 'nullable|string',
                ]);
                $item->update([
                    'comment' => $request->comment,
                ]);
                break;

            case 'contact_info':
                $item = ContactInfo::findOrFail($id);
                $request->validate([
                    'title'       => 'required|string|max:255',
                    'subtitle'    => 'nullable|string|max:255',
                    'phone_label' => 'nullable|string|max:50',
                    'phone_value' => 'nullable|string|max:50',
                    'email_label' => 'nullable|string|max:50',
                    'email_value' => 'nullable|string|max:50',
                    'hours_label' => 'nullable|string|max:50',
                    'hours_value' => 'nullable|string',
                ]);
                $item->update($request->only([
                    'title', 'subtitle', 'phone_label', 'phone_value',
                    'email_label', 'email_value', 'hours_label', 'hours_value'
                ]));
                break;

            default:
                abort(404);
        }

        return redirect()->route('kontrolni-panel', ['page_type' => $resource])
                         ->with('status', ucfirst($resource) . ' uspešno izmenjen!');
    }

{
    $page = $request->query('page_type', 'products');


    $productsQuery = Product::with('category');

    if ($request->filled('search')) {
        $search = $request->input('search');
        $productsQuery->where(function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }

    if ($request->filled('category')) {
        $productsQuery->where('product_categories_id', $request->input('category'));
    }

    $products = $productsQuery->orderBy('created_at', 'desc')
                              ->paginate(6)
                              ->appends($request->query());


    $categoriesQuery = ProductCategory::withCount('products');

    if ($request->filled('category_search')) {
        $search = $request->input('category_search');
        $categoriesQuery->where('name', 'like', "%{$search}%");
    }

    $categories = $categoriesQuery->orderBy('name')
                                  ->paginate(12, ['*'], 'categories_page')
                                  ->appends($request->query());

    $allCategories = ProductCategory::orderBy('name')->get();

    $about = about_us::first();

    return view("admin.index", compact('page', 'products', 'categories', 'allCategories','about'));
}


    public function destroy(Request $request)
    {
        switch ($resource) {

            case 'faq':
                Faq::findOrFail($id)->delete();
                break;

            case 'quick-facts':
                QuickFact::findOrFail($id)->delete();
                break;

            case 'questions':
                ContactMessage::findOrFail($id)->delete();
                break;
            

            default:
                abort(404);
        }

        return redirect()->route('kontrolni-panel', ['page_type' => $resource])
                         ->with('status', ucfirst($resource) . ' je obrisan.');
    }
}
