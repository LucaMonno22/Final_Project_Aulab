<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // <--- 1. AGGIUNGI QUESTO IMPORT

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function byCategory(Category $category)
    {
        $announcements = $category->announcements->where('is_accepted', true);

        return view('announcements.byCategory', compact('announcements', 'category'));
    }

    public function category(Request $request, Category $category)
    {
        $sort = $request->query('sort', 'desc');

        $announcements = $category->announcements()
            ->where(function ($query) {
                $query->where('is_accepted', true)
                    ->orWhereNull('is_accepted');
            })
            ->with(['user', 'category'])
            ->orderBy('created_at', $sort)
            ->paginate(9)
            ->withQueryString();

        return view('announcements.category', compact('announcements', 'category', 'sort'));
    }

    // METODO PER MOSTRARE LA VISTA DI MODIFICA
    public function edit(Announcement $announcement)
    {
        // 2. CAMBIA $this->authorize in Gate::authorize
        Gate::authorize('update', $announcement);

        return view('announcements.edit', compact('announcement'));
    }

    // METODO PER ELIMINARE FISICAMENTE L'ARTICOLO
    public function destroy(Announcement $announcement)
    {
        // 3. CAMBIA ANCHE QUI $this->authorize in Gate::authorize
        Gate::authorize('delete', $announcement);
        
        $announcement->delete();
        
        return redirect()->to(route('index'). '#articles-section')->with('success', __('ui.announcementDeleted'));
    }
}