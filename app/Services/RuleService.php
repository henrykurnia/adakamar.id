<?php

namespace App\Services;

use App\Models\Rule;
use App\Repositories\RuleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class RuleService
{
    protected RuleRepository $ruleRepository;

    public function __construct(RuleRepository $ruleRepository)
    {
        $this->ruleRepository = $ruleRepository;
    }

    /**
     * Ambil semua aturan dengan pagination.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->ruleRepository->getAll(
            $keyword,
            $perPage
        );
    }

    /**
     * Buat aturan baru.
     */
    public function create(array $data): Rule
    {
        return DB::transaction(function () use ($data) {

            $data['is_active'] = $data['is_active'] ?? true;

            return $this->ruleRepository->create($data);
        });
    }

    /**
     * Update aturan.
     */
    public function update(Rule $rule, array $data): Rule
    {
        return DB::transaction(function () use ($rule, $data) {

            if (!array_key_exists('is_active', $data)) {
                $data['is_active'] = $rule->is_active;
            }

            $this->ruleRepository->update($rule, $data);

            return $rule->fresh();
        });
    }

    /**
     * Hapus aturan.
     */
    public function delete(Rule $rule): bool
    {
        return DB::transaction(function () use ($rule) {
            return $this->ruleRepository->delete($rule);
        });
    }
}