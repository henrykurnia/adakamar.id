<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Services\RuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class RuleController extends Controller
{
    protected RuleService $ruleService;

    public function __construct(RuleService $ruleService)
    {
        $this->ruleService = $ruleService;
    }

    /**
     * Menampilkan daftar aturan.
     */
    public function index(Request $request): View
    {
        $rules = $this->ruleService->getAll(
            $request->get('keyword')
        );

        return view('example.content.accomodation.aturan', compact('rules'));
    }

    /**
     * Menyimpan aturan baru.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        try {
            $this->ruleService->create($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Aturan berhasil ditambahkan.',
                ]);
            }

            return redirect()
                ->route('rules.index')
                ->with('success', 'Aturan berhasil ditambahkan.');
        } catch (Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan aturan.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan aturan.');
        }
    }

    /**
     * Mengambil data aturan untuk modal edit.
     */
    public function edit(Rule $rule): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $rule,
        ]);
    }

    /**
     * Update aturan.
     */
    public function update(
        Request $request,
        Rule $rule
    ): JsonResponse|RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        try {
            $this->ruleService->update($rule, $validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Aturan berhasil diperbarui.',
                ]);
            }

            return redirect()
                ->route('rules.index')
                ->with('success', 'Aturan berhasil diperbarui.');
        } catch (Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui aturan.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui aturan.');
        }
    }

    /**
     * Hapus aturan.
     */
    public function destroy(
        Request $request,
        Rule $rule
    ): JsonResponse|RedirectResponse {
        try {
            $this->ruleService->delete($rule);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Aturan berhasil dihapus.',
                ]);
            }

            return redirect()
                ->route('rules.index')
                ->with('success', 'Aturan berhasil dihapus.');
        } catch (Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus aturan.',
                    'error' => $e->getMessage(),
                ], 500);
            }

            return back()
                ->with('error', 'Gagal menghapus aturan.');
        }
    }
}