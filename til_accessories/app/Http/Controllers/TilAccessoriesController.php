<?php

namespace App\Http\Controllers;

use App\Imports\TilAccessoriesImport;
use App\Jobs\ImportTilAccessories;
use App\Models\Item;
use App\Models\Buyer;
use App\Models\ItemUmo;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\TilAccessories;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TilAccessoriesStoreRequest;
use App\Http\Requests\TilAccessoriesUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class TilAccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', TilAccessories::class);

        $search = $request->get('search', '');

        if ($search) {
            $ALLtilAccessories = TilAccessories::latest()
                ->search($search)->orderBy('wo_date', 'desc')->paginate(10);
        } else {
            $ALLtilAccessories = TilAccessories::latest()->orderBy('wo_date', 'desc')
                ->paginate(10);
        }

        return view('app.til_accessories.index',
            compact('ALLtilAccessories', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', TilAccessories::class);

        $buyers = Buyer::pluck('name', 'id');
        $items = Item::pluck('name', 'id');
        $itemUmos = ItemUmo::pluck('name', 'id');

        return view(
            'app.til_accessories.create',
            compact('buyers', 'items', 'itemUmos')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TilAccessoriesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', TilAccessories::class);

        $validated = $request->validated();

        $tilAccessories = TilAccessories::create($validated);

        return redirect()
            ->route('til-accessories.edit', $tilAccessories)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, TilAccessories $tilAccessories): View
    {
        $this->authorize('view', $tilAccessories);

        return view('app.til_accessories.show', compact('tilAccessories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, TilAccessories $tilAccessories): View
    {
        $this->authorize('update', $tilAccessories);

        $buyers = Buyer::pluck('name', 'id');
        $items = Item::pluck('name', 'id');
        $itemUmos = ItemUmo::pluck('name', 'id');

        return view(
            'app.til_accessories.edit',
            compact('tilAccessories', 'buyers', 'items', 'itemUmos')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TilAccessoriesUpdateRequest $request,
        TilAccessories $tilAccessories
    ): RedirectResponse {
        $this->authorize('update', $tilAccessories);

        $validated = $request->validated();

        $tilAccessories->update($validated);

        return redirect()
            ->route('til-accessories.edit', $tilAccessories)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        TilAccessories $tilAccessories
    ): RedirectResponse {
        $this->authorize('delete', $tilAccessories);

        $tilAccessories->delete();

        return redirect()
            ->route('til-accessories.index')
            ->withSuccess(__('crud.common.removed'));
    }

    //upload excel file
    public function importExcel(): View
    {
        $this->authorize('create', TilAccessories::class);

        return view('app.til_accessories.excelUpload');
    }

    //update excel file
    //     public function updateExcel(Request $request): RedirectResponse
    //     {
    //         $this->authorize('update', TilAccessories::class);

    //         $request->validate(['file' => 'required|file|mimes:xlsx,xls']);

    //         // dd($request->file('file'));

    //         try {
    //             $file = $request->file('file');
    //             $file_name = $file->getClientOriginalName();

    //             // dd($file_name);
    //             // Ensure the directory exists
    //             if (!file_exists(public_path('backend_file/excel_file/'))) {
    //                 mkdir(public_path('backend_file/excel_file/'), 0755, true);
    //             }

    //             // Move the file
    //             if ($file->move(public_path('backend_file/excel_file/'), $file_name)) {
    //                 \Log::info('File moved successfully: ' . $file_name);
    //             } else {
    //                 \Log::error('File move failed.');
    //                 return redirect()->back()->withError('File move failed.');
    //             }
    //             // dd($file_name);

    //             // Get the full file path
    //             $filePath = public_path('backend_file/excel_file/' . $file_name);
    //             // dd($filePath);

    //             // Dispatch the job
    //             \Log::info('Dispatching job with file path: ' . $filePath);
    //              ini_set('memory_limit', '3355443200');
    //           $memory_limit = ini_get('memory_limit');
    //             //
    // // dd($filePath, $memory_limit);
    //             ImportTilAccessories::dispatch($filePath, $memory_limit);

    //             return redirect()->route('til-accessories.excelUpload')->withSuccess(__('crud.common.saved'));
    //         } catch (\Exception $e) {
    //             \Log::error('File upload error: ' . $e->getMessage());
    //             return redirect()->back()->withError('File upload failed: ' . $e->getMessage());
    //         }
    //     }

    public function updateExcel(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,xls']);

        try {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('backend_file/excel_file/'),
                $file_name
            );

            $filePath = public_path('backend_file/excel_file/' . $file_name);
            ImportTilAccessories::dispatch($filePath);

            return redirect()->route('til-accessories.index')->withSuccess('File uploaded successfully and processing in the background.');
        } catch (\Exception $e) {
            \Log::error('File upload error: ' . $e->getMessage());
            return redirect()->back()->withError('File upload failed: ' . $e->getMessage());
        }
    }
}
