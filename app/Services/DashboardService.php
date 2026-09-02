<?php

namespace App\Services;

use App\Repositories\Interfaces\AkomodasiRepositoryInterface;
use App\Repositories\Interfaces\KategoriRepositoryInterface;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class DashboardService
{
    protected $akomodasiRepository;
    protected $kategoriRepository;

    protected $articleRepository;

    public function __construct(
        AkomodasiRepositoryInterface $akomodasiRepository,
        KategoriRepositoryInterface $kategoriRepository,
        ArticleRepositoryInterface $articleRepository
    ) {
        $this->akomodasiRepository = $akomodasiRepository;
        $this->kategoriRepository = $kategoriRepository;
        $this->articleRepository = $articleRepository;

    }

    public function getDashboardData()
{
    $kategori = $this->kategoriRepository->getAll();
    $akomodasis = $this->akomodasiRepository->getAll();
    $artikel = $this->articleRepository->getArtikelTerbaru();
     $artikelTerbit = $this->articleRepository->getArtikelTerbit();
    return [
        'kategori' => $kategori,
        'akomodasis' => $akomodasis,

        'artikel' => $artikel,

        'artikelTerbit' => $artikelTerbit,
        'akomodasiTerbaru' => $akomodasis->sortByDesc('created_at')->take(5),
        
    ];
}
}